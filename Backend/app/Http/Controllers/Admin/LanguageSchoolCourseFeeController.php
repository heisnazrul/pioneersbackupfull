<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LanguageSchoolCourse;
use App\Models\LanguageSchoolCourseFee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LanguageSchoolCourseFeeController extends Controller
{
    public function index(): View
    {
        $filters = [
            'country_id' => request('country_id'),
            'city_id' => request('city_id'),
            'school_id' => request('school_id'),
            'branch_id' => request('branch_id'),
        ];

        $courseFees = LanguageSchoolCourse::with(['branch.school', 'branch.city.country'])
            ->whereHas('fees')
            ->when($filters['country_id'], fn($q) => $q->whereHas('branch.city', fn($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn($q) => $q->whereHas('branch', fn($qq) => $qq->where('city_id', $filters['city_id'])))
            ->when($filters['school_id'], fn($q) => $q->whereHas('branch', fn($qq) => $qq->where('language_school_id', $filters['school_id'])))
            ->when($filters['branch_id'], fn($q) => $q->where('branch_id', $filters['branch_id']))
            ->withMax('fees as max_week', 'week_number')
            ->withMin('fees as min_fee', 'fee')
            ->withMax('fees as max_fee', 'fee')
            ->withMin('fees as earliest_valid_from', 'valid_from')
            ->withMax('fees as latest_valid_to', 'valid_to')
            ->addSelect([
                'price_split_status' => LanguageSchoolCourseFee::selectRaw("CASE WHEN MIN(price_split) = MAX(price_split) THEN COALESCE(MIN(price_split), 'yes') ELSE 'mixed' END")
                    ->whereColumn('language_school_course_id', 'language_school_courses.id'),
            ])
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $countries = \App\Models\Country::whereHas('cities.languageSchoolBranches.languageSchoolCourses.fees')
            ->orderBy('name')->get(['id','name']);
        $cities = \App\Models\City::whereHas('languageSchoolBranches.languageSchoolCourses.fees')
            ->when($filters['country_id'], fn($q) => $q->where('country_id', $filters['country_id']))
            ->orderBy('name')->get(['id','name','country_id']);
        $schools = \App\Models\LanguageSchool::whereHas('branches.languageSchoolCourses.fees')
            ->when($filters['country_id'], fn($q) => $q->whereHas('branches.city', fn($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn($q) => $q->whereHas('branches', fn($qq) => $qq->where('city_id', $filters['city_id'])))
            ->orderBy('name')->get(['id','name']);
        $branches = \App\Models\LanguageSchoolBranch::whereHas('courses.fees')
            ->when($filters['school_id'], fn($q) => $q->where('language_school_id', $filters['school_id']))
            ->when($filters['city_id'], fn($q) => $q->where('city_id', $filters['city_id']))
            ->when($filters['country_id'], fn($q) => $q->whereHas('city', fn($qq) => $qq->where('country_id', $filters['country_id'])))
            ->with('school')
            ->orderBy('slug')
            ->get(['id','slug','language_school_id','city_id']);

        return view('admin.language-school-course-fees.index', compact('courseFees','filters','countries','cities','schools','branches'));
    }

    public function create(): View
    {
        $courses = LanguageSchoolCourse::with('branch.school')->orderBy('name')->get();
        return view('admin.language-school-course-fees.create', compact('courses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        LanguageSchoolCourseFee::create($data);

        return redirect()->route('admin.language-school-course-fees.index')->with('success', 'Course fee created.');
    }

    public function edit(LanguageSchoolCourseFee $languageSchoolCourseFee): View
    {
        $courses = LanguageSchoolCourse::with('branch.school')->orderBy('name')->get();
        return view('admin.language-school-course-fees.edit', [
            'fee' => $languageSchoolCourseFee,
            'courses' => $courses,
        ]);
    }

    public function update(Request $request, LanguageSchoolCourseFee $languageSchoolCourseFee): RedirectResponse
    {
        $data = $this->validateData($request);
        $languageSchoolCourseFee->update($data);

        return redirect()->route('admin.language-school-course-fees.index')->with('success', 'Course fee updated.');
    }

    public function destroy(LanguageSchoolCourseFee $languageSchoolCourseFee): RedirectResponse
    {
        $languageSchoolCourseFee->delete();
        return redirect()->route('admin.language-school-course-fees.index')->with('success', 'Course fee deleted.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'language_school_course_id' => ['required', 'exists:language_school_courses,id'],
            'week_number' => ['required', 'integer', 'min:1'],
            'fee' => ['required', 'numeric', 'min:0'],
            'valid_from' => ['nullable', 'date'],
            'valid_to' => ['nullable', 'date', 'after_or_equal:valid_from'],
            'price_split' => ['required', Rule::in(['yes', 'no'])],
        ]);
    }
}
