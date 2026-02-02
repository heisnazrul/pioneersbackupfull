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

        $applications = Application::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('email', $user->email);
        })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $applications
        ]);
    }
}
