<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UniversityWishlist;
use Illuminate\Support\Facades\Auth;

class UniversityWishlistController extends Controller
{
    public function index(Request $request)
    {
        $wishlist = UniversityWishlist::where('user_id', $request->user()->id)
            ->with(['course.university'])
            ->get();

        return response()->json($wishlist);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:university_courses,id',
        ]);

        $exists = UniversityWishlist::where('user_id', $request->user()->id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Course already in wishlist'], 409);
        }

        $wishlist = UniversityWishlist::create([
            'user_id' => $request->user()->id,
            'course_id' => $request->course_id,
        ]);

        return response()->json(['message' => 'Course added to wishlist', 'data' => $wishlist], 201);
    }

    public function destroy(Request $request, $courseId)
    {
        $deleted = UniversityWishlist::where('user_id', $request->user()->id)
            ->where('course_id', $courseId)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Course removed from wishlist']);
        }

        return response()->json(['message' => 'Course not found in wishlist'], 404);
    }
}
