<?php

namespace App\Http\Controllers;

use App\Models\LanguageCourseTag;
use App\Models\LanguageCourseType;
use App\Models\OnlineCourse;
use App\Models\School;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OnlineCourseController extends Controller
{
    public function index(): View
    {
        $onlineCourses = OnlineCourse::query()
            ->with(['school', 'courseType', 'tag'])
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.online-courses.index', compact('onlineCourses'));
    }

    public function create(): View
    {
        return view('admin.online-courses.create', [
            'schools' => School::orderBy('name')->get(),
            'courseTypes' => LanguageCourseType::orderBy('name')->get(),
            'tags' => LanguageCourseTag::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['visible'] = $request->boolean('visible', true);
        $this->handleThumbnailUpload($data);

        OnlineCourse::create($data);

        return redirect()->route('admin.online-courses.index')->with('success', 'Online course created successfully.');
    }

    public function edit(OnlineCourse $onlineCourse): View
    {
        return view('admin.online-courses.edit', [
            'onlineCourse' => $onlineCourse,
            'schools' => School::orderBy('name')->get(),
            'courseTypes' => LanguageCourseType::orderBy('name')->get(),
            'tags' => LanguageCourseTag::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, OnlineCourse $onlineCourse): RedirectResponse
    {
        $data = $this->validateData($request, $onlineCourse);
        $data['visible'] = $request->boolean('visible', false);
        $this->handleThumbnailUpload($data, $onlineCourse);

        $onlineCourse->update($data);

        return redirect()->route('admin.online-courses.index')->with('success', 'Online course updated successfully.');
    }

    public function destroy(OnlineCourse $onlineCourse): RedirectResponse
    {
        $this->deleteThumbnail($onlineCourse->thumbnail);
        $onlineCourse->delete();

        return redirect()->route('admin.online-courses.index')->with('success', 'Online course deleted successfully.');
    }

    private function validateData(Request $request, ?OnlineCourse $course = null): array
    {
        return $request->validate([
            'slug' => ['required', 'string', 'max:160', Rule::unique('online_courses', 'slug')->ignore($course?->id)],
            'school_id' => ['required', 'integer', 'exists:schools,id'],
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

    private function handleThumbnailUpload(array &$data, ?OnlineCourse $course = null): void
    {
        if (! isset($data['thumbnail']) || ! $data['thumbnail'] instanceof UploadedFile) {
            unset($data['thumbnail']);
            return;
        }

        if ($course?->thumbnail) {
            $this->deleteThumbnail($course->thumbnail);
        }

        $data['thumbnail'] = $data['thumbnail']->store('online-courses/thumbnails', 'public');
    }

    private function deleteThumbnail(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
