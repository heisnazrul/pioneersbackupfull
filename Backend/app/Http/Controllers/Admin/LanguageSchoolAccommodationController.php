<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LanguageSchoolAccommodation;
use App\Models\LanguageSchoolBranch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LanguageSchoolAccommodationController extends Controller
{
    public function index(): View
    {
        $filters = [
            'country_id' => request('country_id'),
            'city_id' => request('city_id'),
            'school_id' => request('school_id'),
            'branch_id' => request('branch_id'),
        ];

        $items = LanguageSchoolAccommodation::with('branch.school')
            ->when($filters['country_id'], fn($q) => $q->whereHas('branch.city', fn($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn($q) => $q->whereHas('branch', fn($qq) => $qq->where('city_id', $filters['city_id'])))
            ->when($filters['school_id'], fn($q) => $q->whereHas('branch', fn($qq) => $qq->where('language_school_id', $filters['school_id'])))
            ->when($filters['branch_id'], fn($q) => $q->where('branch_id', $filters['branch_id']))
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $countries = \App\Models\Country::whereHas('cities.languageSchoolBranches.accommodations')->orderBy('name')->get(['id','name']);
        $cities = \App\Models\City::whereHas('languageSchoolBranches.accommodations')
            ->when($filters['country_id'], fn($q) => $q->where('country_id', $filters['country_id']))
            ->orderBy('name')->get(['id','name','country_id']);
        $schools = \App\Models\LanguageSchool::whereHas('branches.accommodations')
            ->when($filters['country_id'], fn($q) => $q->whereHas('branches.city', fn($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn($q) => $q->whereHas('branches', fn($qq) => $qq->where('city_id', $filters['city_id'])))
            ->orderBy('name')->get();
        $branches = LanguageSchoolBranch::whereHas('accommodations')
            ->when($filters['school_id'], fn($q) => $q->where('language_school_id', $filters['school_id']))
            ->when($filters['city_id'], fn($q) => $q->where('city_id', $filters['city_id']))
            ->when($filters['country_id'], fn($q) => $q->whereHas('city', fn($qq) => $qq->where('country_id', $filters['country_id'])))
            ->with('school')
            ->orderBy('slug')
            ->get();

        return view('admin.language-school-accommodations.index', [
            'accommodations' => $items,
            'filters' => $filters,
            'countries' => $countries,
            'cities' => $cities,
            'schools' => $schools,
            'branches' => $branches,
        ]);
    }

    public function create(): View
    {
        $branches = LanguageSchoolBranch::with('school')->orderBy('slug')->get();
        $bedroomTypes = \App\Models\BedroomType::orderBy('name')->get();
        $bathroomTypes = \App\Models\BathroomType::orderBy('name')->get();
        $rooms = $bedroomTypes; // reuse bedroom types for room options if needed
        $cities = \App\Models\City::orderBy('name')->get(['id','name']);
        $countries = \App\Models\Country::orderBy('name')->get(['id','name']);
        $tags = \App\Models\LanguageCourseTag::orderBy('name')->get(['id','name']);
        $mealPlans = \App\Models\MealPlan::orderBy('name')->get(['id','name']);
        return view('admin.language-school-accommodations.create', compact('branches','bedroomTypes','bathroomTypes','rooms','cities','countries','tags','mealPlans'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('language-accommodations', 'public');
        }

        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        LanguageSchoolAccommodation::create($data);

        return redirect()->route('admin.language-school-accommodations.index')->with('success', 'Accommodation created.');
    }

    public function edit(LanguageSchoolAccommodation $languageSchoolAccommodation): View
    {
        $branches = LanguageSchoolBranch::with('school')->orderBy('slug')->get();
        return view('admin.language-school-accommodations.edit', [
            'item' => $languageSchoolAccommodation,
            'branches' => $branches,
        ]);
    }

    public function update(Request $request, LanguageSchoolAccommodation $languageSchoolAccommodation): RedirectResponse
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            if ($languageSchoolAccommodation->image) {
                Storage::disk('public')->delete($languageSchoolAccommodation->image);
            }
            $data['image'] = $request->file('image')->store('language-accommodations', 'public');
        }

        $languageSchoolAccommodation->update($data);

        return redirect()->route('admin.language-school-accommodations.index')->with('success', 'Accommodation updated.');
    }

    public function destroy(LanguageSchoolAccommodation $languageSchoolAccommodation): RedirectResponse
    {
        if ($languageSchoolAccommodation->image) {
            Storage::disk('public')->delete($languageSchoolAccommodation->image);
        }
        $languageSchoolAccommodation->delete();

        return redirect()->route('admin.language-school-accommodations.index')->with('success', 'Accommodation deleted.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'branch_id' => ['required', 'exists:language_school_branches,id'],
            'title' => ['required', 'string', 'max:255'],
            'ar_title' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'ar_description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'size:3'],
            'features' => ['nullable', 'array'],
            'image' => ['nullable', 'image', 'max:4096'],
            'details' => ['nullable', 'string'],
            'ar_details' => ['nullable', 'string'],
        ]);
    }
}
