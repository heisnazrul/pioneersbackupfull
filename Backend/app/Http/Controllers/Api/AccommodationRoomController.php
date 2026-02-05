<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccommodationRoom;
use Illuminate\Http\Request;

class AccommodationRoomController extends Controller
{
    public function index()
    {
        return response()->json(AccommodationRoom::all());
    }

    public function show($slug)
    {
        $room = AccommodationRoom::where('slug', $slug)->firstOrFail();
        return response()->json($room);
    }
}
