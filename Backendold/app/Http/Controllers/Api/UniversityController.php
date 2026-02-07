<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UniversityResource;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UniversityController extends Controller
{
    /**
     * Display a listing of universities with filters
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = University::with(['city.country', 'courses.level'])
            ->active();

        // Keyword search
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('name', 'like', "%{$keyword}%");
        }

        // Filter by destination (country)
        if ($request->filled('destination')) {
            $query->whereHas('country', function ($q) use ($request) {
                $q->where('name', $request->input('destination'))
                    ->orWhere('country_code', $request->input('destination'));
            });
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->whereHas('city', function ($q) use ($request) {
                $q->where('name', $request->input('city'));
            });
        }

        // Filter by ranking
        if ($request->filled('rankingMin')) {
            $query->where('rank', '>=', $request->input('rankingMin'));
        }

        if ($request->filled('rankingMax')) {
            $query->where('rank', '<=', $request->input('rankingMax'));
        }

        // Sorting
        $sort = $request->input('sort', '');
        switch ($sort) {
            case 'rank_asc':
                $query->orderBy('rank', 'asc');
                break;
            case 'rank_desc':
                $query->orderBy('rank', 'desc');
                break;
            default:
                $query->orderBy('rank', 'asc')->orderBy('name', 'asc');
                break;
        }

        $pageSize = min($request->input('pageSize', 12), 50);
        $universities = $query->paginate($pageSize);

        return UniversityResource::collection($universities);
    }

    /**
     * Display the specified university by slug
     */
    public function show(string $slug)
    {
        $university = University::with([
            'city.country',
            'courses.level',
            'courses.intakeTerms'
        ])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        return new UniversityResource($university);
    }
}
