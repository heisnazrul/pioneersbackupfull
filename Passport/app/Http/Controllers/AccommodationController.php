<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\BathroomType;
use App\Models\BedroomType;
use App\Models\LanguageCourseTag;
use App\Models\MealPlan;
use App\Models\City;
use App\Models\Country;
use App\Models\School;
use App\Models\SchoolBranch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccommodationController extends Controller
{
    public function index(): View
    {
        $filters = [
            'country_id' => request('country_id'),
            'city_id' => request('city_id'),
            'school_id' => request('school_id'),
        ];

        $accommodations = Accommodation::query()
            ->with(['branch.school', 'branch.city.country', 'bedroomType', 'bathroomType', 'mealPlan', 'tag'])
            ->when($filters['country_id'], function ($q) use ($filters) {
                $q->whereHas('branch.city', function ($qq) use ($filters) {
                    $qq->where('country_id', $filters['country_id']);
                });
            })
            ->when($filters['city_id'], function ($q) use ($filters) {
                $q->whereHas('branch', function ($qq) use ($filters) {
                    $qq->where('city_id', $filters['city_id']);
                });
            })
            ->when($filters['school_id'], function ($q) use ($filters) {
                $q->whereHas('branch', function ($qq) use ($filters) {
                    $qq->where('school_id', $filters['school_id']);
                });
            })
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $countries = Country::query()
            ->whereHas('cities.branches.accommodations')
            ->orderBy('name')
            ->get(['id', 'name']);

        $cities = City::query()
            ->whereHas('branches.accommodations')
            ->when($filters['country_id'], fn ($q) => $q->where('country_id', $filters['country_id']))
            ->orderBy('name')
            ->get(['id', 'name', 'country_id']);

        $schools = School::query()
            ->whereHas('branches.accommodations')
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branches.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branches', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.accommodations.index', [
            'accommodations' => $accommodations,
            'filters' => $filters,
            'countries' => $countries,
            'cities' => $cities,
            'schools' => $schools,
        ]);
    }

    public function create(): View
    {
        return view('admin.accommodations.create', [
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
            'tags' => LanguageCourseTag::orderBy('name')->get(),
            'bedroomTypes' => BedroomType::orderBy('name')->get(),
            'bathroomTypes' => BathroomType::orderBy('name')->get(),
            'mealPlans' => MealPlan::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        Accommodation::create($data);

        return redirect()->route('admin.accommodations.index')->with('success', 'Accommodation created successfully.');
    }

    public function edit(Accommodation $accommodation): View
    {
        return view('admin.accommodations.edit', [
            'accommodation' => $accommodation,
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
            'tags' => LanguageCourseTag::orderBy('name')->get(),
            'bedroomTypes' => BedroomType::orderBy('name')->get(),
            'bathroomTypes' => BathroomType::orderBy('name')->get(),
            'mealPlans' => MealPlan::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Accommodation $accommodation): RedirectResponse
    {
        $data = $this->validateData($request);

        $accommodation->update($data);

        return redirect()->route('admin.accommodations.index')->with('success', 'Accommodation updated successfully.');
    }

    public function destroy(Accommodation $accommodation): RedirectResponse
    {
        $accommodation->delete();

        return redirect()->route('admin.accommodations.index')->with('success', 'Accommodation deleted successfully.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'school_branch_id' => ['required', 'integer', 'exists:school_branches,id'],
            'language_course_tag_id' => ['nullable', 'integer', 'exists:language_course_tags,id'],
            'required_age' => ['nullable', 'integer', 'min:0', 'max:100'],
            'fee_per_week' => ['required', 'numeric', 'min:0'],
            'admin_charge' => ['nullable', 'numeric', 'min:0'],
            'under18_supplement_per_week' => ['nullable', 'numeric', 'min:0'],
            'bedroom_type_id' => ['required', 'integer', 'exists:bedroom_types,id'],
            'bathroom_type_id' => ['required', 'integer', 'exists:bathroom_types,id'],
            'meal_plan_id' => ['required', 'integer', 'exists:meal_plans,id'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
