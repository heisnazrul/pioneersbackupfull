<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Destination;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::with(['country', 'stats'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->map(function ($destination) {
                if ($destination->image_url && !str_starts_with(trim($destination->image_url), 'http')) {
                    $destination->image_url = asset('storage/' . $destination->image_url);
                }
                return $destination;
            });

        return response()->json([
            'success' => true,
            'data' => $destinations
        ]);
    }

    public function home()
    {
        $destinations = Destination::select('id', 'name', 'slug', 'image_url', 'country_id', 'region', 'description', 'short_pitch', 'university_count')
            ->with(['country:id,name,country_code as code']) // Alias country_code to code for frontend compatibility
            ->where('is_active', true)
            ->orderByRaw("CASE 
                WHEN slug = 'united-kingdom' THEN 1 
                WHEN slug = 'united-states' THEN 2 
                ELSE 3 END")
            ->orderBy('name')
            ->limit(8)
            ->get()
            ->map(function ($destination) {
                if ($destination->image_url && !str_starts_with(trim($destination->image_url), 'http')) {
                    $destination->image_url = asset('storage/' . $destination->image_url);
                }
                return $destination;
            });

        return response()->json([
            'success' => true,
            'data' => $destinations
        ]);
    }

    public function show($slug)
    {
        $destination = Destination::with([
            'features',
            'stats',
            'intakes',
            'faqs',
            'requirements',
            'disciplines'
        ])->where('slug', $slug)->firstOrFail();

        if ($destination->image_url && !str_starts_with(trim($destination->image_url), 'http')) {
            $destination->image_url = asset('storage/' . $destination->image_url);
        }

        return response()->json([
            'success' => true,
            'data' => $destination
        ]);
    }
}
