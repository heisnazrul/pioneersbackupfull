<?php

namespace App\Http\Controllers;

use App\Models\LanguageCourse;
use App\Models\LanguageCourseTag;
use App\Models\LanguageCourseType;
use App\Models\SchoolBranch;
use App\Models\School;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LanguageCourseController extends Controller
{
    public function index(): View
    {
        $query = LanguageCourse::query()->with(['branch.school', 'branch.city.country', 'type', 'tag']);

        $filters = [
            'country_id' => request('country_id'),
            'city_id' => request('city_id'),
            'school_id' => request('school_id'),
            'branch_id' => request('branch_id'),
            'type_id' => request('type_id'),
            'tag_id' => request('tag_id'),
        ];

        if ($filters['country_id']) {
            $query->whereHas('branch.city', function ($q) use ($filters) {
                $q->where('country_id', $filters['country_id']);
            });
        }

        if ($filters['city_id']) {
            $query->whereHas('branch', function ($q) use ($filters) {
                $q->where('city_id', $filters['city_id']);
            });
        }

        if ($filters['school_id']) {
            $query->whereHas('branch', function ($q) use ($filters) {
                $q->where('school_id', $filters['school_id']);
            });
        }

        if ($filters['branch_id']) {
            $query->where('branch_id', $filters['branch_id']);
        }

        if ($filters['type_id']) {
            $query->where('language_course_type_id', $filters['type_id']);
        }

        if ($filters['tag_id']) {
            $query->where('language_course_tag_id', $filters['tag_id']);
        }

        $courses = $query
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $filterableCities = City::query()
            ->whereHas('branches.languageCourses')
            ->when($filters['country_id'], fn ($q) => $q->where('country_id', $filters['country_id']))
            ->orderBy('name')
            ->get(['id', 'name', 'country_id']);

        $filterableSchools = School::query()
            ->whereHas('branches.languageCourses')
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branches.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branches', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->orderBy('name')
            ->get(['id', 'name']);

        $filterableBranches = SchoolBranch::query()
            ->whereHas('languageCourses')
            ->when($filters['school_id'], fn ($q) => $q->where('school_id', $filters['school_id']))
            ->when($filters['city_id'], fn ($q) => $q->where('city_id', $filters['city_id']))
            ->when($filters['country_id'], fn ($q) => $q->whereHas('city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->with('school')
            ->orderBy('slug')
            ->get(['id', 'slug', 'school_id', 'city_id']);

        $filterableCountries = Country::query()
            ->whereHas('cities.branches.languageCourses')
            ->orderBy('name')
            ->get(['id', 'name']);

        $types = LanguageCourseType::orderBy('name')->get(['id', 'name']);
        $tags = LanguageCourseTag::orderBy('name')->get(['id', 'name']);

        return view('admin.language-courses.index', [
            'courses' => $courses,
            'filters' => $filters,
            'countries' => $filterableCountries,
            'cities' => $filterableCities,
            'schools' => $filterableSchools,
            'branches' => $filterableBranches,
            'types' => $types,
            'tags' => $tags,
        ]);
    }

    public function create(): View
    {
        return view('admin.language-courses.create', [
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
            'types' => LanguageCourseType::orderBy('name')->get(),
            'tags' => LanguageCourseTag::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        LanguageCourse::create($data);

        return redirect()
            ->route('admin.language-courses.index')
            ->with('success', 'Language course created successfully.');
    }

    public function edit(LanguageCourse $languageCourse): View
    {
        return view('admin.language-courses.edit', [
            'course' => $languageCourse,
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
            'types' => LanguageCourseType::orderBy('name')->get(),
            'tags' => LanguageCourseTag::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, LanguageCourse $languageCourse): RedirectResponse
    {
        $data = $this->validateData($request, $languageCourse);

        $languageCourse->update($data);

        return redirect()
            ->route('admin.language-courses.index')
            ->with('success', 'Language course updated successfully.');
    }

    public function destroy(LanguageCourse $languageCourse): RedirectResponse
    {
        $languageCourse->delete();

        return redirect()
            ->route('admin.language-courses.index')
            ->with('success', 'Language course deleted successfully.');
    }

    private function validateData(Request $request, ?LanguageCourse $languageCourse = null): array
    {
        $request->merge([
            'slug' => Str::slug($request->input('slug') ?: $request->input('name', '')),
        ]);

        return $request->validate([
            'branch_id' => ['required', 'integer', 'exists:school_branches,id'],
            'language_course_type_id' => ['required', 'integer', 'exists:language_course_types,id'],
            'language_course_tag_id' => ['nullable', 'integer', 'exists:language_course_tags,id'],
            'slug' => ['required', 'string', 'max:160', Rule::unique('language_courses', 'slug')->ignore($languageCourse?->id)],
            'name' => ['required', 'string', 'max:200'],
            'ar_name' => ['nullable', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'ar_description' => ['nullable', 'string'],
            'start_day' => ['nullable', 'string', 'max:32'],
            'required_level' => ['nullable', 'string', 'max:32'],
            'study_time' => ['nullable', 'string', 'max:30'],
            'lessons_per_week' => ['nullable', 'string', 'max:30'],
            'min_age' => ['nullable', 'string', 'max:30'],
        ]);
    }
}
