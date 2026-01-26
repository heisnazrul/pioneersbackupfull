<?php

namespace App\Http\Controllers;

use App\Models\LanguageCourse;
use App\Models\LanguageCourseFee;
use App\Models\SchoolBranch;
use App\Models\School;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LanguageCourseFeeController extends Controller
{
    public function index(): View
    {
        $filters = [
            'country_id' => request('country_id'),
            'city_id' => request('city_id'),
            'school_id' => request('school_id'),
            'branch_id' => request('branch_id'),
        ];

        $courses = LanguageCourse::query()
            ->with(['branch.school', 'branch.city.country'])
            ->whereHas('fees')
            ->when($filters['country_id'], function ($q) use ($filters) {
                $q->whereHas('branch.city', fn ($qq) => $qq->where('country_id', $filters['country_id']));
            })
            ->when($filters['city_id'], function ($q) use ($filters) {
                $q->whereHas('branch', fn ($qq) => $qq->where('city_id', $filters['city_id']));
            })
            ->when($filters['school_id'], function ($q) use ($filters) {
                $q->whereHas('branch', fn ($qq) => $qq->where('school_id', $filters['school_id']));
            })
            ->when($filters['branch_id'], fn ($q) => $q->where('branch_id', $filters['branch_id']))
            ->withMax('fees as max_week', 'week_number')
            ->withMin('fees as min_fee', 'fee')
            ->withMax('fees as max_fee', 'fee')
            ->withMin('fees as earliest_valid_from', 'valid_from')
            ->withMax('fees as latest_valid_to', 'valid_to')
            ->addSelect([
                'price_split_status' => LanguageCourseFee::selectRaw("CASE WHEN MIN(price_split) = MAX(price_split) THEN COALESCE(MIN(price_split), 'yes') ELSE 'mixed' END")
                    ->whereColumn('language_course_id', 'language_courses.id'),
            ])
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $filterableCities = City::query()
            ->whereHas('branches.languageCourses.fees')
            ->when($filters['country_id'], fn ($q) => $q->where('country_id', $filters['country_id']))
            ->orderBy('name')
            ->get(['id', 'name', 'country_id']);

        $filterableSchools = School::query()
            ->whereHas('branches.languageCourses.fees')
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branches.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branches', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->orderBy('name')
            ->get(['id', 'name']);

        $filterableBranches = SchoolBranch::query()
            ->whereHas('languageCourses.fees')
            ->when($filters['school_id'], fn ($q) => $q->where('school_id', $filters['school_id']))
            ->when($filters['city_id'], fn ($q) => $q->where('city_id', $filters['city_id']))
            ->when($filters['country_id'], fn ($q) => $q->whereHas('city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->with('school')
            ->orderBy('slug')
            ->get(['id', 'slug', 'school_id', 'city_id']);

        $filterableCountries = Country::query()
            ->whereHas('cities.branches.languageCourses.fees')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.language-course-fees.index', [
            'courseFees' => $courses,
            'filters' => $filters,
            'countries' => $filterableCountries,
            'cities' => $filterableCities,
            'schools' => $filterableSchools,
            'branches' => $filterableBranches,
        ]);
    }

    public function create(Request $request): View
    {
        $selectedCourseId = $request->integer('language_course_id');
        $prefill = [];

        if ($selectedCourseId) {
            $prefill = LanguageCourseFee::query()
                ->where('language_course_id', $selectedCourseId)
                ->orderBy('week_number')
                ->get()
                ->pluck('fee', 'week_number')
                ->toArray();
        }

        return view('admin.language-course-fees.create', [
            'courses' => LanguageCourse::with('branch.school')->orderBy('name')->get(),
            'prefill' => $prefill,
            'selectedCourseId' => $selectedCourseId,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateBulkData($request);
        $weeks = $data['weeks'];
        unset($data['weeks']);

        LanguageCourseFee::where('language_course_id', $data['language_course_id'])->delete();

        foreach ($weeks as $week) {
            LanguageCourseFee::create(array_merge($data, [
                'week_number' => $week['week_number'],
                'fee' => $week['fee'],
            ]));
        }

        return redirect()->route('admin.language-course-fees.index')->with('success', 'Language course fees saved successfully.');
    }

    public function edit(LanguageCourseFee $languageCourseFee): View
    {
        return view('admin.language-course-fees.edit', [
            'fee' => $languageCourseFee,
            'courses' => LanguageCourse::with('branch.school')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, LanguageCourseFee $languageCourseFee): RedirectResponse
    {
        $data = $this->validateData($request, $languageCourseFee);

        $languageCourseFee->update($data);

        return redirect()->route('admin.language-course-fees.index')->with('success', 'Language course fee updated successfully.');
    }

    public function destroy(LanguageCourseFee $languageCourseFee): RedirectResponse
    {
        $languageCourseFee->delete();

        return redirect()->route('admin.language-course-fees.index')->with('success', 'Language course fee deleted successfully.');
    }

    private function validateBulkData(Request $request): array
    {
        $data = $request->validate([
            'language_course_id' => ['required', 'integer', 'exists:language_courses,id'],
            'valid_from' => ['nullable', 'date'],
            'valid_to' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'price_split' => ['required', Rule::in(['yes', 'no'])],
            'weeks' => ['required', 'array', 'min:1', 'max:48'],
            'weeks.*.week_number' => ['required', 'integer', 'min:1', 'max:48'],
            'weeks.*.fee' => ['nullable', 'numeric', 'min:0'],
        ]);

        $weeks = collect($data['weeks'])
            ->filter(fn ($week) => isset($week['week_number']) && $week['week_number'] !== null && $week['fee'] !== null && $week['fee'] !== '')
            ->unique('week_number')
            ->values()
            ->all();

        if (empty($weeks)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'weeks' => ['Please provide at least one week with a fee.'],
            ]);
        }

        $data['weeks'] = $weeks;

        return $data;
    }

    private function validateData(Request $request, ?LanguageCourseFee $fee = null): array
    {
        return $request->validate([
            'language_course_id' => ['required', 'integer', 'exists:language_courses,id'],
            'week_number' => ['required', 'integer', 'min:1'],
            'fee' => ['required', 'numeric', 'min:0'],
            'valid_from' => ['nullable', 'date'],
            'valid_to' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'price_split' => ['required', Rule::in(['yes', 'no'])],
        ]);
    }

    public function fetch(LanguageCourse $languageCourse): JsonResponse
    {
        $fees = $languageCourse->fees()
            ->select(['week_number', 'fee'])
            ->orderBy('week_number')
            ->get();

        return response()->json(['fees' => $fees]);
    }
}
