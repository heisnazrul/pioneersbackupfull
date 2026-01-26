<?php

namespace App\Http\Controllers;

use App\Models\BranchPickup;
use App\Models\City;
use App\Models\SchoolBranch;
use App\Models\School;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PickupController extends Controller
{
    public function index(): View
    {
        $filters = [
            'country_id' => request('country_id'),
            'city_id' => request('city_id'),
            'school_id' => request('school_id'),
            'branch_id' => request('branch_id'),
        ];

        $pickups = BranchPickup::query()
            ->with(['branch.school', 'branch.city'])
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branch.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branch', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->when($filters['school_id'], fn ($q) => $q->whereHas('branch', fn ($qq) => $qq->where('school_id', $filters['school_id'])))
            ->when($filters['branch_id'], fn ($q) => $q->where('school_branch_id', $filters['branch_id']))
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $filterableCities = City::query()
            ->whereHas('branches.pickups')
            ->when($filters['country_id'], fn ($q) => $q->where('country_id', $filters['country_id']))
            ->orderBy('name')
            ->get(['id', 'name', 'country_id']);

        $filterableSchools = School::query()
            ->whereHas('branches.pickups')
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branches.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branches', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->orderBy('name')
            ->get(['id', 'name']);

        $filterableBranches = SchoolBranch::query()
            ->whereHas('pickups')
            ->when($filters['school_id'], fn ($q) => $q->where('school_id', $filters['school_id']))
            ->when($filters['city_id'], fn ($q) => $q->where('city_id', $filters['city_id']))
            ->when($filters['country_id'], fn ($q) => $q->whereHas('city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->with('school')
            ->orderBy('slug')
            ->get(['id', 'slug', 'school_id', 'city_id']);

        $filterableCountries = Country::query()
            ->whereHas('cities.branches.pickups')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.pickups.index', [
            'pickups' => $pickups,
            'filters' => $filters,
            'countries' => $filterableCountries,
            'cities' => $filterableCities,
            'schools' => $filterableSchools,
            'branches' => $filterableBranches,
        ]);
    }

    public function create(): View
    {
        return view('admin.pickups.create', [
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
            'cities' => City::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        BranchPickup::create($data);

        return redirect()->route('admin.pickups.index')->with('success', 'Pickup fee created successfully.');
    }

    public function edit(BranchPickup $pickup): View
    {
        return view('admin.pickups.edit', [
            'pickup' => $pickup,
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
            'cities' => City::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, BranchPickup $pickup): RedirectResponse
    {
        $data = $this->validateData($request);

        $pickup->update($data);

        return redirect()->route('admin.pickups.index')->with('success', 'Pickup fee updated successfully.');
    }

    public function destroy(BranchPickup $pickup): RedirectResponse
    {
        $pickup->delete();

        return redirect()->route('admin.pickups.index')->with('success', 'Pickup fee deleted successfully.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'school_branch_id' => ['required', 'integer', 'exists:school_branches,id'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'fee' => ['required', 'numeric', 'min:0'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
