<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $query = University::query()
            ->with(['country', 'city'])
            ->active();

        if ($request->filled('country_id')) {
            $query->where('country_id', $request->input('country_id'));
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->input('city_id'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('featured')) {
            $query->featured();
        }

        $universities = $query->paginate($request->input('per_page', 12));

        return response()->json([
            'success' => true,
            'data' => $universities->items(),
            'meta' => [
                'current_page' => $universities->currentPage(),
                'last_page' => $universities->lastPage(),
                'per_page' => $universities->perPage(),
                'total' => $universities->total(),
            ]
        ]);
    }

    public function show($slug)
    {
        $university = University::query()
            ->with(['country', 'city', 'details', 'galleries', 'courses', 'scholarships', 'campuses'])
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $university
        ]);
    }
}
