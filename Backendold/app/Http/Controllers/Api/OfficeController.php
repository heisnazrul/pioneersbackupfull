<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = \App\Models\Office::all();

        // Map image URL
        $offices->transform(function ($office) {
            if ($office->image && !str_starts_with($office->image, 'http')) {
                $office->image = asset('storage/' . $office->image);
            }
            return $office;
        });

        return response()->json($offices);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $office = \App\Models\Office::where('slug', $slug)->firstOrFail();

        if ($office->image && !str_starts_with($office->image, 'http')) {
            $office->image = asset('storage/' . $office->image);
        }

        return response()->json($office);
    }
}
