<?php

namespace App\Http\Controllers;

use App\Models\PreferredSchool;
use App\Models\School;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PreferredSchoolController extends Controller
{
    public function index(): View
    {
        $filters = [
            'country_id' => request('country_id'),
            'city_id' => request('city_id'),
        ];

        $preferredMap = PreferredSchool::pluck('active', 'school_id');

        $schools = School::query()
            ->with(['branches.city.country'])
            ->whereHas('branches')
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branches.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branches', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->orderBy('name')
            ->get();

        $countries = Country::query()
            ->whereHas('cities.branches')
            ->orderBy('name')
            ->get(['id', 'name']);

        $cities = City::query()
            ->whereHas('branches')
            ->when($filters['country_id'], fn ($q) => $q->where('country_id', $filters['country_id']))
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.preferred-schools.index', [
            'schools' => $schools,
            'preferredMap' => $preferredMap,
            'filters' => $filters,
            'countries' => $countries,
            'cities' => $cities,
        ]);
    }

    public function create(): View
    {
        return view('admin.preferred-schools.create', [
            'schools' => School::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'school_id' => ['required', 'integer', 'exists:schools,id'],
            'active' => ['nullable', 'boolean'],
        ]);

        $data['active'] = $request->boolean('active', false);

        PreferredSchool::create($data);

        return redirect()->route('admin.preferred-schools.index')->with('success', 'Preferred school added.');
    }

    public function edit(PreferredSchool $preferredSchool): View
    {
        return view('admin.preferred-schools.edit', [
            'preferredSchool' => $preferredSchool,
            'schools' => School::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, PreferredSchool $preferredSchool): RedirectResponse
    {
        $data = $request->validate([
            'school_id' => ['required', 'integer', 'exists:schools,id'],
            'active' => ['nullable', 'boolean'],
        ]);

        $data['active'] = $request->boolean('active', false);

        $preferredSchool->update($data);

        return redirect()->route('admin.preferred-schools.index')->with('success', 'Preferred school updated.');
    }

    public function destroy(PreferredSchool $preferredSchool): RedirectResponse
    {
        $preferredSchool->delete();

        return redirect()->route('admin.preferred-schools.index')->with('success', 'Preferred school deleted.');
    }

    public function bulkUpdate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'selected_schools' => ['nullable', 'array'],
            'selected_schools.*' => ['integer', 'exists:schools,id'],
        ]);

        $selected = collect($validated['selected_schools'] ?? [])->unique()->values();

        // Mark all inactive first
        PreferredSchool::query()->update(['active' => false]);

        foreach ($selected as $schoolId) {
            PreferredSchool::updateOrCreate(
                ['school_id' => $schoolId],
                ['active' => true]
            );
        }

        return redirect()->route('admin.preferred-schools.index')->with('success', 'Preferred schools updated.');
    }
}
