<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UniversityCourse;
use Illuminate\Http\Request;

class UniversityCourseController extends Controller
{
    public function index(Request $request)
    {
        $query = UniversityCourse::query()
            ->with(['university.country', 'university.city', 'level']);

        // Filter by Country (via University)
        if ($request->filled('country_id')) {
            $query->whereHas('university', function ($q) use ($request) {
                $q->where('country_id', $request->country_id);
            });
        }

        // Filter by Keyword (Course Name or University Name)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhereHas('university', function ($uq) use ($keyword) {
                        $uq->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        // Filter by Level
        if ($request->filled('level')) {
            // Frontend sends 'Bachelor', 'Master' etc.
            // Assuming Level model has 'name' or 'slug' matching this
            $query->whereHas('level', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->level}%")
                    ->orWhere('slug', 'like', "%{$request->level}%");
            });
        }

        // Sorting
        if ($request->filled('sort')) {
            if ($request->sort === 'tuition_asc') {
                $query->orderBy('tuition_fee', 'asc');
            } elseif ($request->sort === 'tuition_desc') {
                $query->orderBy('tuition_fee', 'desc');
            }
        }

        $courses = $query->paginate($request->input('pageSize', 10));

        return response()->json([
            'success' => true,
            'data' => $courses->items(),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'last_page' => $courses->lastPage(),
                'per_page' => $courses->perPage(),
                'total' => $courses->total(),
            ]
        ]);
    }

    public function show($slug)
    {
        $course = UniversityCourse::query()
            ->with(['university.country', 'university.city', 'level', 'details', 'requirements', 'intakes'])
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $course
        ]);
    }
}
