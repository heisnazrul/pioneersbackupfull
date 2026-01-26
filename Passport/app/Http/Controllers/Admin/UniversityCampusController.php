<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UniversityCampus;
use App\Models\University;
use App\Models\City;
use Illuminate\Http\Request;

class UniversityCampusController extends Controller
{
    public function index(Request $request)
    {
        $query = UniversityCampus::query()->with(['university', 'city']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('university_id')) {
            $query->where('university_id', $request->input('university_id'));
        }

        $campuses = $query->paginate(10);
        $universities = University::pluck('name', 'id');

        return view('admin.campuses.index', compact('campuses', 'universities'));
    }

    public function create()
    {
        $universities = University::pluck('name', 'id');
        $cities = City::pluck('name', 'id');
        return view('admin.campuses.create', compact('universities', 'cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:university_campuses',
            'university_id' => 'required|exists:universities,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'nullable|string',
            'map_coordinates' => 'nullable|string',
        ]);

        UniversityCampus::create($validated);

        return redirect()->route('admin.campuses.index')->with('success', 'Campus created successfully.');
    }

    public function show(UniversityCampus $universityCampus)
    {
        $universityCampus->load(['university', 'city', 'courses']);
        return view('admin.campuses.show', compact('universityCampus'));
    }

    public function edit(UniversityCampus $universityCampus)
    {
        $universities = University::pluck('name', 'id');
        $cities = City::pluck('name', 'id');
        return view('admin.campuses.edit', compact('universityCampus', 'universities', 'cities'));
    }

    public function update(Request $request, UniversityCampus $universityCampus)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:university_campuses,slug,' . $universityCampus->id,
            'university_id' => 'required|exists:universities,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'nullable|string',
            'map_coordinates' => 'nullable|string',
        ]);

        $universityCampus->update($validated);

        return redirect()->route('admin.campuses.index')->with('success', 'Campus updated successfully.');
    }

    public function destroy(UniversityCampus $universityCampus)
    {
        $universityCampus->delete();
        return redirect()->route('admin.campuses.index')->with('success', 'Campus deleted successfully.');
    }
}
