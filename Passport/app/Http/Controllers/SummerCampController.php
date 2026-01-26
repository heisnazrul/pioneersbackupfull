<?php

namespace App\Http\Controllers;

use App\Models\LanguageCourseTag;
use App\Models\LanguageCourseType;
use App\Models\SchoolBranch;
use App\Models\SummerCamp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SummerCampController extends Controller
{
    public function index(): View
    {
        $summerCamps = SummerCamp::query()
            ->with(['branch.school', 'courseType', 'tag'])
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.summer-camps.index', compact('summerCamps'));
    }

    public function create(): View
    {
        return view('admin.summer-camps.create', [
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

        SummerCamp::create($data);

        return redirect()->route('admin.summer-camps.index')->with('success', 'Summer camp created successfully.');
    }

    public function edit(SummerCamp $summerCamp): View
    {
        return view('admin.summer-camps.edit', [
            'summerCamp' => $summerCamp,
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
            'courseTypes' => LanguageCourseType::orderBy('name')->get(),
            'tags' => LanguageCourseTag::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, SummerCamp $summerCamp): RedirectResponse
    {
        $data = $this->validateData($request, $summerCamp);
        $data['visible'] = $request->boolean('visible', false);
        $this->handleThumbnailUpload($data, $summerCamp);

        $summerCamp->update($data);

        return redirect()->route('admin.summer-camps.index')->with('success', 'Summer camp updated successfully.');
    }

    public function destroy(SummerCamp $summerCamp): RedirectResponse
    {
        $this->deleteThumbnail($summerCamp->thumbnail);
        $summerCamp->delete();

        return redirect()->route('admin.summer-camps.index')->with('success', 'Summer camp deleted successfully.');
    }

    private function validateData(Request $request, ?SummerCamp $camp = null): array
    {
        return $request->validate([
            'slug' => ['required', 'string', 'max:160', Rule::unique('summer_camps', 'slug')->ignore($camp?->id)],
            'branch_id' => ['required', 'integer', 'exists:school_branches,id'],
            'course_type_id' => ['required', 'integer', 'exists:language_course_types,id'],
            'tag_id' => ['nullable', 'integer', 'exists:language_course_tags,id'],
            'name' => ['required', 'string', 'max:200'],
            'ar_name' => ['nullable', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'ar_description' => ['nullable', 'string'],
            'required_level' => ['nullable', 'string', 'max:10'],
            'study_time' => ['nullable', 'string', 'max:10'],
            'lessons_per_week' => ['nullable', 'integer'],
            'age_range' => ['nullable', 'string', 'max:50'],
            'start_date' => ['nullable', 'string', 'max:10'],
            'payment_deadline' => ['nullable', 'date'],
            'fee_type' => ['required', Rule::in(['flat', 'weekly'])],
            'fee_amount' => ['required', 'numeric', 'min:0'],
            'registration_fee' => ['nullable', 'numeric', 'min:0'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'visible' => ['nullable', 'boolean'],
            'status' => ['required', Rule::in(['draft', 'published', 'suspended'])],
        ]);
    }

    private function handleThumbnailUpload(array &$data, ?SummerCamp $camp = null): void
    {
        if (! isset($data['thumbnail']) || ! $data['thumbnail'] instanceof UploadedFile) {
            unset($data['thumbnail']);
            return;
        }

        if ($camp?->thumbnail) {
            $this->deleteThumbnail($camp->thumbnail);
        }

        $data['thumbnail'] = $data['thumbnail']->store('summer-camps/thumbnails', 'public');
    }

    private function deleteThumbnail(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
