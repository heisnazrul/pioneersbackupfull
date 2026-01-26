<?php

namespace App\Http\Controllers;

use App\Models\LanguageCourse;
use App\Models\LanguageCourseMaterialFee;
use App\Models\SchoolBranch;
use App\Models\School;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LanguageCourseMaterialFeeController extends Controller
{
    public function index(): View
    {
        $filters = [
            'country_id' => request('country_id'),
            'city_id' => request('city_id'),
            'school_id' => request('school_id'),
            'branch_id' => request('branch_id'),
            'billing_unit' => request('billing_unit'),
        ];

        $fees = LanguageCourseMaterialFee::query()
            ->with(['course.branch.school', 'course.branch.city'])
            ->when($filters['billing_unit'], fn ($q) => $q->where('billing_unit', $filters['billing_unit']))
            ->when($filters['country_id'], fn ($q) => $q->whereHas('course.branch.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('course.branch', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->when($filters['school_id'], fn ($q) => $q->whereHas('course.branch', fn ($qq) => $qq->where('school_id', $filters['school_id'])))
            ->when($filters['branch_id'], fn ($q) => $q->whereHas('course', fn ($qq) => $qq->where('branch_id', $filters['branch_id'])))
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $filterableCities = City::query()
            ->whereHas('branches.languageCourses.materialFees')
            ->when($filters['country_id'], fn ($q) => $q->where('country_id', $filters['country_id']))
            ->orderBy('name')
            ->get(['id', 'name', 'country_id']);

        $filterableSchools = School::query()
            ->whereHas('branches.languageCourses.materialFees')
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branches.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branches', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->orderBy('name')
            ->get(['id', 'name']);

        $filterableBranches = SchoolBranch::query()
            ->whereHas('languageCourses.materialFees')
            ->when($filters['school_id'], fn ($q) => $q->where('school_id', $filters['school_id']))
            ->when($filters['city_id'], fn ($q) => $q->where('city_id', $filters['city_id']))
            ->when($filters['country_id'], fn ($q) => $q->whereHas('city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->with('school')
            ->orderBy('slug')
            ->get(['id', 'slug', 'school_id', 'city_id']);

        $filterableCountries = Country::query()
            ->whereHas('cities.branches.languageCourses.materialFees')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.language-course-material-fees.index', [
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
        return view('admin.language-course-material-fees.create', [
            'courses' => LanguageCourse::with('branch.school')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        LanguageCourseMaterialFee::create($data);

        return redirect()->route('admin.language-course-material-fees.index')->with('success', 'Material fee created successfully.');
    }

    public function edit(LanguageCourseMaterialFee $languageCourseMaterialFee): View
    {
        return view('admin.language-course-material-fees.edit', [
            'fee' => $languageCourseMaterialFee,
            'courses' => LanguageCourse::with('branch.school')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, LanguageCourseMaterialFee $languageCourseMaterialFee): RedirectResponse
    {
        $data = $this->validateData($request);

        $languageCourseMaterialFee->update($data);

        return redirect()->route('admin.language-course-material-fees.index')->with('success', 'Material fee updated successfully.');
    }

    public function destroy(LanguageCourseMaterialFee $languageCourseMaterialFee): RedirectResponse
    {
        $languageCourseMaterialFee->delete();

        return redirect()->route('admin.language-course-material-fees.index')->with('success', 'Material fee deleted successfully.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'language_course_id' => ['required', 'integer', 'exists:language_courses,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'billing_unit' => ['required', Rule::in(['week', 'month', 'course'])],
            'billing_count' => ['required', 'integer', 'min:1'],
        ]);
    }
}
