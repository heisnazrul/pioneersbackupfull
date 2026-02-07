<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LanguageCourseTrainingCourse;
use App\Models\LanguageCourseTag;
use App\Models\LanguageCourseType;
use App\Models\LanguageSchool;
use App\Models\LanguageSchoolBranch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LanguageCourseTrainingCourseController extends Controller
{
    public function index(): View
    {
        $courses = LanguageCourseTrainingCourse::query()
            ->with(['school', 'branch', 'courseType', 'tag'])
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.language-course-training-courses.index', compact('courses'));
    }

    public function create(): View
    {
        return view('admin.language-course-training-courses.create', [
            'schools' => $this->schools(),
            'branches' => $this->branches(),
            'types' => $this->types(),
            'tags' => $this->tags(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name'].'-'.uniqid());
        LanguageCourseTrainingCourse::create($data);

        return redirect()->route('admin.language-course-training-courses.index')
            ->with('success', 'Training course created successfully.');
    }

    public function edit(LanguageCourseTrainingCourse $languageCourseTrainingCourse): View
    {
        return view('admin.language-course-training-courses.edit', [
            'course' => $languageCourseTrainingCourse,
            'schools' => $this->schools(),
            'branches' => $this->branches(),
            'types' => $this->types(),
            'tags' => $this->tags(),
        ]);
    }

    public function update(Request $request, LanguageCourseTrainingCourse $languageCourseTrainingCourse): RedirectResponse
    {
        $data = $this->validateData($request, $languageCourseTrainingCourse);
        $data['slug'] = $data['slug'] ?: $languageCourseTrainingCourse->slug;
        $languageCourseTrainingCourse->update($data);

        return redirect()->route('admin.language-course-training-courses.index')
            ->with('success', 'Training course updated successfully.');
    }

    public function destroy(LanguageCourseTrainingCourse $languageCourseTrainingCourse): RedirectResponse
    {
        $languageCourseTrainingCourse->delete();
        return redirect()->route('admin.language-course-training-courses.index')
            ->with('success', 'Training course deleted.');
    }

    private function validateData(Request $request, ?LanguageCourseTrainingCourse $course = null): array
    {
        return $request->validate([
            'slug' => ['nullable', 'string', 'max:160', 'unique:language_course_training_courses,slug'.($course ? ','.$course->id : '')],
            'language_school_id' => ['required', 'exists:language_schools,id'],
            'branch_id' => ['nullable', 'exists:language_school_branches,id'],
            'course_type_id' => ['required', 'exists:language_course_types,id'],
            'tag_id' => ['nullable', 'exists:language_course_tags,id'],
            'name' => ['required', 'string', 'max:200'],
            'ar_name' => ['nullable', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'ar_description' => ['nullable', 'string'],
            'required_level' => ['nullable', 'string', 'max:10'],
            'study_time' => ['nullable', 'string', 'max:10'],
            'lessons_per_week' => ['nullable', 'integer', 'min:0'],
            'min_age' => ['nullable', 'integer', 'min:0'],
            'start_date' => ['nullable', 'string', 'max:10'],
            'fee_type' => ['required', 'in:flat,weekly'],
            'fee_amount' => ['required', 'numeric', 'min:0'],
            'currency_code' => ['required', 'string', 'size:3'],
            'registration_fee' => ['nullable', 'numeric', 'min:0'],
            'thumbnail' => ['nullable', 'string', 'max:255'],
            'visible' => ['nullable', 'boolean'],
            'status' => ['required', 'in:draft,published,suspended'],
        ]);
    }

    private function schools()
    {
        return LanguageSchool::orderBy('name')->get(['id', 'name']);
    }

    private function branches()
    {
        return LanguageSchoolBranch::orderBy('id')->get(['id', 'language_school_id', 'slug']);
    }

    private function types()
    {
        return LanguageCourseType::orderBy('name')->get(['id', 'name']);
    }

    private function tags()
    {
        return LanguageCourseTag::orderBy('name')->get(['id', 'name']);
    }
}
