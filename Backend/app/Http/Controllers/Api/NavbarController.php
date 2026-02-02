<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Destination;

class NavbarController extends Controller
{
    public function destinations()
    {
        // Fetch Destinations where the associated Country is Popular.
        // We filter for distinct countries effectively if one destination per country, 
        // ensuring we only show destinations for popular countries.

        $destinations = Destination::whereHas('country', function ($query) {
            $query->where('is_popular', true)
                ->where('is_active', true);
        })
            ->with(['country'])
            ->where('is_active', true)
            ->limit(9)
            ->get();

        $data = $destinations->map(function ($d) {
            return [
                'name' => $d->country->name, // User wants Country Name shown? "United Kingdom", "United States"
                // Actually the destination name might be "Study in UK". 
                // Screenshot shows "United Kingdom", "United States", "Canada".
                // So likely we want the Country Name. 
                // But the link goes to destination slug.
                'slug' => $d->slug,
                'flag' => $d->country->flag ? url(\Illuminate\Support\Facades\Storage::url($d->country->flag)) : null,
                'country_code' => strtolower($d->country->country_code),
                'pitch' => $d->short_pitch,
            ];
        });

        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }
}
