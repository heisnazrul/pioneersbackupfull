<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\UniversityCourse;
use App\Models\UniversityWishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UniversityWishlistController extends Controller
{
    /**
     * List the authenticated user's wishlist courses.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $wishlists = UniversityWishlist::with([
            'course.university.country',
            'course.level',
            'course.subjectArea',
            'course.intakeTerms',
        ])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        $courses = $wishlists
            ->pluck('course')
            ->filter(); // in case of missing relations

        return CourseResource::collection($courses);
    }

    /**
     * Add a course to the authenticated user's wishlist.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:university_courses,id'],
        ]);

        $wishlist = UniversityWishlist::firstOrCreate([
            'user_id' => $request->user()->id,
            'course_id' => $validated['course_id'],
        ]);

        $wishlist->load([
            'course.university.country',
            'course.level',
            'course.subjectArea',
            'course.intakeTerms',
        ]);

        return response()->json([
            'message' => 'Course added to wishlist.',
            'data' => new CourseResource($wishlist->course),
        ], 201);
    }

    /**
     * Remove a course from the authenticated user's wishlist.
     */
    public function destroy(Request $request, int $courseId): JsonResponse
    {
        UniversityWishlist::where('user_id', $request->user()->id)
            ->where('course_id', $courseId)
            ->delete();

        return response()->json([
            'message' => 'Course removed from wishlist.',
        ], 200);
    }
}
