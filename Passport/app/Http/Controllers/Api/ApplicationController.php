<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    /**
     * Store a new application.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'citizenship' => 'nullable|string',
            'nationality' => 'nullable|string',
            'highestEducation' => 'required|string',
            'destinationInterest' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            // Generate Application ID
            $appId = mt_rand(1000, 9999) . '0042'; // Mock ID logic from frontend request

            // Map frontend payload to database columns
            $application = Application::create([
                'application_id' => $appId,
                'user_id' => $request->user() ? $request->user()->id : null, // If authenticated
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'citizenship' => $request->citizenship,
                'nationality' => $request->nationality,
                'nationality_other' => $request->nationalityOther,
                'highest_education' => $request->highestEducation,
                'grade_average' => $request->gradeAverage,
                'has_english_test' => $request->hasEnglishTest ?? false,
                'english_test_type' => $request->englishTestType,
                'english_test_score' => $request->englishTestScore,
                'destination_interest' => $request->destinationInterest,
                'destinations_other' => $request->destinationsOther,
                'preferred_intake' => $request->preferredIntake,
                'budget_range' => $request->budgetRange,
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully',
                'application_id' => $appId
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Application submission failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Server error'], 500);
        }
    }

    /**
     * List applications for the authenticated user.
     */
    public function myApplications(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        \Log::info("Fetching applications for user: {$user->id} ({$user->email})");

        $applications = Application::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('email', $user->email);
        })
            ->orderBy('created_at', 'desc')
            ->get();

        \Log::info("Found " . $applications->count() . " applications.");

        return response()->json([
            'success' => true,
            'data' => $applications
        ]);
    }

    public function featuredUniversities()
    {
        $universities = \App\Models\University::featured()
            ->active()
            ->with(['country', 'city', 'courses'])
            ->take(8)
            ->get()
            ->map(function ($uni) {
                // Extract unique faculty names as disciplines
                $disciplines = $uni->courses->pluck('faculty_name')->unique()->filter()->take(3)->values();
                if ($disciplines->isEmpty()) {
                    $disciplines = ['General Sciences', 'Arts', 'Business']; // Fallback
                }

                // Fix Logo Path Logic
                $logoPath = $uni->logo;
                $logoUrl = null;

                // Only allow valid storage paths (not temp paths)
                if ($logoPath && !str_contains($logoPath, 'private') && !str_contains($logoPath, 'tmp')) {
                    // Remove leading slash if present
                    if (str_starts_with($logoPath, '/')) {
                        $logoPath = substr($logoPath, 1);
                    }
                    $logoUrl = url('storage/' . $logoPath);
                }

                return [
                    'id' => $uni->id,
                    'name' => $uni->name,
                    'slug' => $uni->slug,
                    'logoUrl' => $logoUrl,
                    'rank' => $uni->rank ?? $uni->world_rank ?? 0,
                    'location' => ($uni->city->name ?? '') . ', ' . ($uni->country->name ?? ''),
                    'top_disciplines' => $disciplines,
                    'is_featured' => true
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $universities
        ]);
    }
}
