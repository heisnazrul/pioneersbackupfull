<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\IntakeTerm;
use App\Models\Level;
use App\Models\SubjectArea;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicDataController extends Controller
{
    /**
     * Get all countries that have active universities
     */
    public function countries(): JsonResponse
    {
        $countries = Country::select('id', 'name', 'slug', 'country_code', 'currency_code', 'is_popular')
            ->whereHas('universities', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('name')
            ->get();

        return response()->json($countries);
    }

    /**
     * Get all intake terms that have associated courses
     */
    public function intakes(): JsonResponse
    {
        $intakes = IntakeTerm::select('id', 'name', 'key', 'month_num')
            ->whereHas('courses')
            ->orderBy('month_num')
            ->get();

        return response()->json($intakes);
    }

    /**
     * Get all levels that have associated courses
     */
    public function levels(): JsonResponse
    {
        $levels = Level::select('id', 'name', 'key', 'sort_order')
            ->whereHas('courses')
            ->orderBy('sort_order')
            ->get();

        return response()->json($levels);
    }

    /**
     * Get all subject areas
     */
    public function subjectAreas(): JsonResponse
    {
        $subjectAreas = SubjectArea::select('id', 'name', 'key')
            ->orderBy('name')
            ->get();

        return response()->json($subjectAreas);
    }

    /**
     * Get cities by country that have active universities
     */
    /**
     * Get cities that have active universities with courses
     */
    public function cities(Request $request): JsonResponse
    {
        $cities = City::select('id', 'name', 'country_id')
            ->whereHas('universities', function ($query) {
                $query->where('is_active', true)
                    ->whereHas('courses', function ($q) {
                        $q->where('is_active', true);
                    });
            })
            ->orderBy('name')
            ->get();

        return response()->json($cities);
    }
}
