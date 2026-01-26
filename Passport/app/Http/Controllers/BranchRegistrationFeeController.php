<?php

namespace App\Http\Controllers;

use App\Models\BranchRegistrationFee;
use App\Models\SchoolBranch;
use App\Models\School;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BranchRegistrationFeeController extends Controller
{
    public function index(): View
    {
        $filters = [
            'country_id' => request('country_id'),
            'city_id' => request('city_id'),
            'school_id' => request('school_id'),
            'branch_id' => request('branch_id'),
        ];

        $fees = BranchRegistrationFee::query()
            ->with(['branch.school', 'branch.city.country'])
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branch.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branch', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->when($filters['school_id'], fn ($q) => $q->whereHas('branch', fn ($qq) => $qq->where('school_id', $filters['school_id'])))
            ->when($filters['branch_id'], fn ($q) => $q->where('branch_id', $filters['branch_id']))
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $filterableCities = City::query()
            ->whereHas('branches.registrationFees')
            ->when($filters['country_id'], fn ($q) => $q->where('country_id', $filters['country_id']))
            ->orderBy('name')
            ->get(['id', 'name', 'country_id']);

        $filterableSchools = School::query()
            ->whereHas('branches.registrationFees')
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branches.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branches', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->orderBy('name')
            ->get(['id', 'name']);

        $filterableBranches = SchoolBranch::query()
            ->whereHas('registrationFees')
            ->when($filters['school_id'], fn ($q) => $q->where('school_id', $filters['school_id']))
            ->when($filters['city_id'], fn ($q) => $q->where('city_id', $filters['city_id']))
            ->when($filters['country_id'], fn ($q) => $q->whereHas('city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->with('school')
            ->orderBy('slug')
            ->get(['id', 'slug', 'school_id', 'city_id']);

        $filterableCountries = Country::query()
            ->whereHas('cities.branches.registrationFees')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.branch-registration-fees.index', [
            'fees' => $fees,
            'filters' => $filters,
            'countries' => $filterableCountries,
            'cities' => $filterableCities,
            'schools' => $filterableSchools,
            'branches' => $filterableBranches,
        ]);
    }

    public function create(): View
    {
        return view('admin.branch-registration-fees.create', [
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        BranchRegistrationFee::create($data);

        return redirect()->route('admin.branch-registration-fees.index')->with('success', 'Registration fee added.');
    }

    public function edit(BranchRegistrationFee $branchRegistrationFee): View
    {
        return view('admin.branch-registration-fees.edit', [
            'fee' => $branchRegistrationFee,
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
        ]);
    }

    public function update(Request $request, BranchRegistrationFee $branchRegistrationFee): RedirectResponse
    {
        $data = $this->validateData($request);

        $branchRegistrationFee->update($data);

        return redirect()->route('admin.branch-registration-fees.index')->with('success', 'Registration fee updated.');
    }

    public function destroy(BranchRegistrationFee $branchRegistrationFee): RedirectResponse
    {
        $branchRegistrationFee->delete();

        return redirect()->route('admin.branch-registration-fees.index')->with('success', 'Registration fee deleted.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'branch_id' => ['required', 'integer', 'exists:school_branches,id'],
            'amount' => ['required', 'numeric', 'min:0'],
        ]);
    }
}
