<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DestinationGuide;
use Illuminate\Http\Request;

class DestinationGuideController extends Controller
{
    public function index()
    {
        $guides = DestinationGuide::active()
            ->with('destination')
            ->latest()
            ->get()
            ->map(function ($guide) {
                return [
                    'id' => $guide->id,
                    'title' => $guide->title,
                    'file_url' => asset('storage/' . $guide->file_path),
                    'year' => $guide->year,
                    'destination' => $guide->destination ? $guide->destination->name : 'General',
                    // Map file type based on extension (simple assumption)
                    'type' => 'PDF',
                    'size' => 'Unknown', // Calculate if needed, but storage check might be slow
                    'icon' => 'faFilePdf',
                    'color' => 'text-red-500',
                    'bg' => 'bg-red-50'
                ];
            });

        return response()->json(['data' => $guides]);
    }
}
