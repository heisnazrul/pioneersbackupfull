<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\UniApplication;
use App\Models\UniversityWishlist;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Count Applications
        $generalApps = Application::where('email', $user->email)->count();
        $uniApps = UniApplication::where('email', $user->email)->count();
        $totalApps = $generalApps + $uniApps;

        // Count Wishlist (Saved Courses)
        $savedCourses = UniversityWishlist::where('user_id', $user->id)->count();

        // Messages (Mock for now)
        $messages = 0;

        // Recent Activity (Get latest application)
        $recentApp = UniApplication::where('email', $user->email)
            ->with(['course.university'])
            ->latest()
            ->first();

        $recentActivity = null;
        if ($recentApp) {
            $universityName = $recentApp->course?->university?->name ?? 'University';
            $recentActivity = [
                'type' => 'application',
                'title' => 'Application to ' . $universityName,
                'status' => $recentApp->status,
                'date' => $recentApp->created_at->diffForHumans(),
            ];
        }

        return response()->json([
            'stats' => [
                'active_applications' => $totalApps,
                'saved_courses' => $savedCourses,
                'messages' => $messages,
            ],
            'recent_activity' => $recentActivity,
            'user' => $user->load('profile'),
        ]);
    }
}
