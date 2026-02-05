<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccommodationRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccommodationRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = AccommodationRoom::all();
        return view('admin.accommodation_rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.accommodation_rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:accommodation_rooms',
            'description' => 'nullable|string',
            'price' => 'nullable|string',
            'features' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
            'details' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('accommodation', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        AccommodationRoom::create($validated);

        return redirect()->route('admin.accommodation-rooms.index')->with('success', 'Room created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccommodationRoom $accommodationRoom)
    {
        return view('admin.accommodation_rooms.edit', compact('accommodationRoom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccommodationRoom $accommodationRoom)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:accommodation_rooms,slug,' . $accommodationRoom->id,
            'description' => 'nullable|string',
            'price' => 'nullable|string',
            'features' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
            'details' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($accommodationRoom->image) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $accommodationRoom->image));
            }
            $path = $request->file('image')->store('accommodation', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $accommodationRoom->update($validated);

        return redirect()->route('admin.accommodation-rooms.index')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccommodationRoom $accommodationRoom)
    {
        if ($accommodationRoom->image) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $accommodationRoom->image));
        }
        $accommodationRoom->delete();

        return redirect()->route('admin.accommodation-rooms.index')->with('success', 'Room deleted successfully.');
    }
}
