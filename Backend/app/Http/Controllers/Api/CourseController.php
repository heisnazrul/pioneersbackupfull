<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\UniversityCourse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseController extends Controller
{
    /**
     * Display a listing of courses with filters
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = UniversityCourse::with(['university.city.country', 'level', 'subjectArea', 'intakeTerms'])
            ->active();

        // Keyword search
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhereHas('university', function ($uq) use ($keyword) {
                        $uq->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        // Filter by level
        if ($request->filled('level')) {
            $query->whereHas('level', function ($q) use ($request) {
                $levelValue = $request->input('level');
                $q->where('key', $levelValue)
                    ->orWhere('name', 'like', "%{$levelValue}%");
            });
        }

        // Filter by destination (country)
        if ($request->filled('destination')) {
            $query->whereHas('university.country', function ($q) use ($request) {
                $q->where('name', $request->input('destination'))
                    ->orWhere('country_code', $request->input('destination'));
            });
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->whereHas('university.city', function ($q) use ($request) {
                $q->where('name', $request->input('city'));
            });
        }

        // Filter by discipline (subject area)
        if ($request->filled('discipline')) {
            $query->whereHas('subjectArea', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->input('discipline')}%")
                    ->orWhere('key', $request->input('discipline'));
            });
        }

        // Filter by intake
        if ($request->filled('intake')) {
            $query->whereHas('intakeTerms', function ($q) use ($request) {
                $q->where('key', $request->input('intake'))
                    ->orWhere('name', 'like', "%{$request->input('intake')}%");
            });
        }

        // Sorting
        $sort = $request->input('sort', '');
        switch ($sort) {
            case 'tuition_asc':
                $query->orderBy('first_year_fee', 'asc');
                break;
            case 'tuition_desc':
                $query->orderBy('first_year_fee', 'desc');
                break;
            case 'duration_asc':
                $query->orderBy('duration_value', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $pageSize = min($request->input('pageSize', 12), 50);
        $courses = $query->paginate($pageSize);

        return CourseResource::collection($courses);
    }

    /**
     * Display the specified course by slug
     */
    public function show(string $slug)
    {
        $course = UniversityCourse::with([
            'university.city.country',
            'level',
            'subjectArea',
            'intakeTerms'
        ])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        return new CourseResource($course);
    }
}
