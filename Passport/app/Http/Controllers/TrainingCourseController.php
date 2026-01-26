<?php

namespace App\Http\Controllers;

use App\Models\LanguageCourseTag;
use App\Models\LanguageCourseType;
use App\Models\School;
use App\Models\SchoolBranch;
use App\Models\TrainingCourse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TrainingCourseController extends Controller
{
    public function index(): View
    {
        $trainingCourses = TrainingCourse::query()
            ->with(['school', 'branch', 'courseType', 'tag'])
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.training-courses.index', compact('trainingCourses'));
    }

    public function create(): View
    {
        return view('admin.training-courses.create', [
            'schools' => School::orderBy('name')->get(),
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
            'courseTypes' => LanguageCourseType::orderBy('name')->get(),
            'tags' => LanguageCourseTag::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['visible'] = $request->boolean('visible', true);
        $this->handleThumbnailUpload($data);

        TrainingCourse::create($data);

        return redirect()->route('admin.training-courses.index')->with('success', 'Training course created successfully.');
    }

    public function edit(TrainingCourse $trainingCourse): View
    {
        return view('admin.training-courses.edit', [
            'trainingCourse' => $trainingCourse,
            'schools' => School::orderBy('name')->get(),
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
            'courseTypes' => LanguageCourseType::orderBy('name')->get(),
            'tags' => LanguageCourseTag::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, TrainingCourse $trainingCourse): RedirectResponse
    {
        $data = $this->validateData($request, $trainingCourse);
        $data['visible'] = $request->boolean('visible', false);
        $this->handleThumbnailUpload($data, $trainingCourse);

        $trainingCourse->update($data);

        return redirect()->route('admin.training-courses.index')->with('success', 'Training course updated successfully.');
    }

    public function destroy(TrainingCourse $trainingCourse): RedirectResponse
    {
        $this->deleteThumbnail($trainingCourse->thumbnail);
        $trainingCourse->delete();

        return redirect()->route('admin.training-courses.index')->with('success', 'Training course deleted successfully.');
    }

    private function validateData(Request $request, ?TrainingCourse $course = null): array
    {
        return $request->validate([
            'slug' => ['required', 'string', 'max:160', Rule::unique('training_courses', 'slug')->ignore($course?->id)],
            'school_id' => ['required', 'integer', 'exists:schools,id'],
            'branch_id' => ['nullable', 'integer', 'exists:school_branches,id'],
            'course_type_id' => ['required', 'integer', 'exists:language_course_types,id'],
            'tag_id' => ['nullable', 'integer', 'exists:language_course_tags,id'],
            'name' => ['required', 'string', 'max:200'],
            'ar_name' => ['nullable', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'ar_description' => ['nullable', 'string'],
            'required_level' => ['nullable', 'string', 'max:10'],
            'study_time' => ['nullable', 'string', 'max:10'],
            'lessons_per_week' => ['nullable', 'integer'],
            'min_age' => ['nullable', 'integer'],
            'start_date' => ['nullable', 'string', 'max:10'],
            'fee_type' => ['required', Rule::in(['flat', 'weekly'])],
            'fee_amount' => ['required', 'numeric', 'min:0'],
            'currency_code' => ['required', 'string', 'size:3'],
            'registration_fee' => ['nullable', 'numeric', 'min:0'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'visible' => ['nullable', 'boolean'],
            'status' => ['required', Rule::in(['draft', 'published', 'suspended'])],
        ]);
    }

    private function handleThumbnailUpload(array &$data, ?TrainingCourse $course = null): void
    {
        if (! isset($data['thumbnail']) || ! $data['thumbnail'] instanceof UploadedFile) {
            unset($data['thumbnail']);
            return;
        }

        if ($course?->thumbnail) {
            $this->deleteThumbnail($course->thumbnail);
        }

        $data['thumbnail'] = $data['thumbnail']->store('training-courses/thumbnails', 'public');
    }

    private function deleteThumbnail(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
