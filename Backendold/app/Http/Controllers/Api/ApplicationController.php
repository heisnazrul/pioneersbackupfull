<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Application;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'nationality' => 'nullable|string',
                'destinationInterest' => 'nullable|array',
            ]);

            $applicationId = mt_rand(1000, 9999) . '0042';
            $userId = $request->user() ? $request->user()->id : null;

            $application = Application::create([
                'application_id' => $applicationId,
                'user_id' => $userId,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'citizenship' => $request->citizenship ?? null,
                'nationality' => $request->nationality,
                'nationality_other' => $request->nationalityOther ?? null,
                'highest_education' => $request->highestEducation,
                'grade_average' => $request->gradeAverage,
                'has_english_test' => $request->hasEnglishTest ?? false,
                'english_test_type' => $request->englishTestType ?? null,
                'english_test_score' => $request->englishTestScore ?? null,
                'destination_interest' => $request->destinationInterest ?? [],
                'destinations_other' => $request->destinationsOther ?? null,
                'preferred_intake' => $request->preferredIntake,
                'budget_range' => $request->budgetRange,
                'status' => 'submitted',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully.',
                'application_id' => $applicationId
            ], 201);

        } catch (\Exception $e) {
            Log::error('Application submission error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit application. ' . $e->getMessage()
            ], 500);
        }
    }

    public function myApplications(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // 1. Fetch General Applications
        $generalApps = Application::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('email', $user->email);
        })->get();

        $formattedGeneralApps = $generalApps->map(function ($app) {
            return [
                'id' => $app->id,
                'application_id' => $app->application_id,
                'first_name' => $app->first_name,
                'last_name' => $app->last_name,
                'highest_education' => $app->highest_education,
                'status' => $app->status,
                'created_at' => $app->created_at,
                'destination_interest' => $app->destination_interest ?? [],
                'type' => 'general'
            ];
        });

        // 2. Fetch University Applications
        $uniApps = \App\Models\UniApplication::with(['course.university'])
            ->where('email', $user->email)
            ->get();

        $formattedUniApps = $uniApps->map(function ($app) {
            $courseName = $app->course->name ?? 'University Course';
            $universityName = $app->course->university->name ?? '';
            $location = $app->course->university->country ?? ($app->course->location ?? 'Global');

            return [
                'id' => $app->id, // Keeping original ID, collision unlikely to matter for display unique key if distinct types, but frontend uses key=id. Ideally should be unique.
                'application_id' => 'UNI-' . str_pad($app->id, 4, '0', STR_PAD_LEFT),
                'first_name' => explode(' ', $app->name)[0],
                'last_name' => explode(' ', $app->name)[1] ?? '',
                'highest_education' => $courseName . ($universityName ? " at $universityName" : ""), // Mapping Course Name here
                'status' => $app->status ?? 'submitted', // Default to submitted if null
                'created_at' => $app->created_at,
                'destination_interest' => [is_string($location) ? $location : 'Global'], // Map to array, ensure string
                'type' => 'university'
            ];
        });

        // 3. Merge and Sort
        $merged = $formattedGeneralApps->merge($formattedUniApps)->sortByDesc('created_at')->values();

        return response()->json([
            'success' => true,
            'data' => $merged
        ]);
    }
}
