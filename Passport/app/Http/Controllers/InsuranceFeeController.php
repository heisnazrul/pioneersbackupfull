<?php

namespace App\Http\Controllers;

use App\Models\BranchInsurance;
use App\Models\SchoolBranch;
use App\Models\School;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class InsuranceFeeController extends Controller
{
    public function index(): View
    {
        $filters = [
            'country_id' => request('country_id'),
            'city_id' => request('city_id'),
            'school_id' => request('school_id'),
            'billing_unit' => request('billing_unit'),
        ];

        $insurances = BranchInsurance::query()
            ->with(['branch.school', 'branch.city.country'])
            ->when($filters['billing_unit'], fn ($q) => $q->where('billing_unit', $filters['billing_unit']))
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branch.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branch', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->when($filters['school_id'], fn ($q) => $q->whereHas('branch', fn ($qq) => $qq->where('school_id', $filters['school_id'])))
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $filterableCities = City::query()
            ->whereHas('branches.insurances')
            ->when($filters['country_id'], fn ($q) => $q->where('country_id', $filters['country_id']))
            ->orderBy('name')
            ->get(['id', 'name', 'country_id']);

        $filterableSchools = School::query()
            ->whereHas('branches.insurances')
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branches.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branches', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->orderBy('name')
            ->get(['id', 'name']);

        $filterableCountries = Country::query()
            ->whereHas('cities.branches.insurances')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.insurance-fees.index', [
            'insurances' => $insurances,
            'filters' => $filters,
            'countries' => $filterableCountries,
            'cities' => $filterableCities,
            'schools' => $filterableSchools,
        ]);
    }

    public function create(): View
    {
        return view('admin.insurance-fees.create', [
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        BranchInsurance::create($data);

        return redirect()->route('admin.insurance-fees.index')->with('success', 'Insurance created successfully.');
    }

    public function edit(BranchInsurance $insuranceFee): View
    {
        return view('admin.insurance-fees.edit', [
            'insuranceFee' => $insuranceFee,
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
        ]);
    }

    public function update(Request $request, BranchInsurance $insuranceFee): RedirectResponse
    {
        $data = $this->validateData($request);

        $insuranceFee->update($data);

        return redirect()->route('admin.insurance-fees.index')->with('success', 'Insurance updated successfully.');
    }

    public function destroy(BranchInsurance $insuranceFee): RedirectResponse
    {
        $insuranceFee->delete();

        return redirect()->route('admin.insurance-fees.index')->with('success', 'Insurance deleted successfully.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'school_branch_id' => ['required', 'integer', 'exists:school_branches,id'],
            'fee' => ['required', 'numeric', 'min:0'],
            'admin_charge' => ['nullable', 'numeric', 'min:0'],
            'billing_unit' => ['required', Rule::in(['week', 'month', 'course'])],
            'billing_count' => ['required', 'integer', 'min:1'],
            'valid_from' => ['nullable', 'date'],
            'valid_to' => ['nullable', 'date', 'after_or_equal:valid_from'],
        ]);
    }
}
