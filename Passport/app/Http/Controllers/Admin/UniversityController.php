<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\University::query()->with('country');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('country_id')) {
            $query->where('country_id', $request->input('country_id'));
        }

        if ($request->filled('status')) {
            if ($request->input('status') == 'active') {
                $query->where('is_active', true);
            } elseif ($request->input('status') == 'blocked') {
                $query->where('is_active', false);
            }
        }

        $universities = $query->paginate(10)->withQueryString();
        $countries = \App\Models\Country::pluck('name', 'id');

        return view('admin.universities.index', compact('universities', 'countries'));
    }

    public function create()
    {
        $countries = \App\Models\Country::pluck('name', 'id');
        $cities = \App\Models\City::pluck('name', 'id'); // Ideally filtered by country via AJAX
        return view('admin.universities.create', compact('countries', 'cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:universities',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'logo' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:4096',
            'website' => 'nullable|url',
            'type' => 'required|in:public,private',
            'established_year' => 'nullable|integer',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('universities/logos', 'public');
            $validated['logo'] = $path;
        }

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('universities/covers', 'public');
            $validated['cover_image'] = $path;
        }

        $university = \App\Models\University::create($validated);

        if ($request->has('description')) {
            $university->details()->create(['description' => $request->description]);
        }

        return redirect()->route('admin.universities.index')->with('success', 'University created successfully.');
    }

    public function show(\App\Models\University $university)
    {
        return view('admin.universities.show', compact('university'));
    }

    public function edit(\App\Models\University $university)
    {
        $countries = \App\Models\Country::pluck('name', 'id');
        $cities = \App\Models\City::pluck('name', 'id');
        return view('admin.universities.edit', compact('university', 'countries', 'cities'));
    }

    public function update(Request $request, \App\Models\University $university)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:universities,slug,' . $university->id,
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'type' => 'required|in:public,private',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'logo' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($university->logo && \Storage::disk('public')->exists($university->logo)) {
                \Storage::disk('public')->delete($university->logo);
            }
            $path = $request->file('logo')->store('universities/logos', 'public');
            $validated['logo'] = $path;
        }

        if ($request->hasFile('cover_image')) {
            // Delete old cover if exists
            if ($university->cover_image && \Storage::disk('public')->exists($university->cover_image)) {
                \Storage::disk('public')->delete($university->cover_image);
            }
            $path = $request->file('cover_image')->store('universities/covers', 'public');
            $validated['cover_image'] = $path;
        }

        $university->update($validated);

        return redirect()->route('admin.universities.index')->with('success', 'University updated successfully.');
    }

    public function destroy(\App\Models\University $university)
    {
        $university->delete();
        return redirect()->route('admin.universities.index')->with('success', 'University deleted successfully.');
    }
}
