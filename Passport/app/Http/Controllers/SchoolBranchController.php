<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\School;
use App\Models\SchoolBranch;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SchoolBranchController extends Controller
{
    public function index(): View
    {
        $filters = [
            'country_id' => request('country_id'),
            'city_id' => request('city_id'),
            'school_id' => request('school_id'),
        ];

        $query = SchoolBranch::query()->with(['school', 'city.country']);

        if ($filters['country_id']) {
            $query->whereHas('city', function ($q) use ($filters) {
                $q->where('country_id', $filters['country_id']);
            });
        }

        if ($filters['city_id']) {
            $query->where('city_id', $filters['city_id']);
        }

        if ($filters['school_id']) {
            $query->where('school_id', $filters['school_id']);
        }

        $branches = $query
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        $countries = Country::query()
            ->whereHas('cities.branches')
            ->orderBy('name')
            ->get(['id', 'name']);

        $cities = City::query()
            ->whereHas('branches')
            ->when($filters['country_id'], fn ($q) => $q->where('country_id', $filters['country_id']))
            ->orderBy('name')
            ->get(['id', 'name']);

        $schools = School::query()
            ->whereHas('branches')
            ->when($filters['country_id'], fn ($q) => $q->whereHas('branches.city', fn ($qq) => $qq->where('country_id', $filters['country_id'])))
            ->when($filters['city_id'], fn ($q) => $q->whereHas('branches', fn ($qq) => $qq->where('city_id', $filters['city_id'])))
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.school-branches.index', [
            'branches' => $branches,
            'filters' => $filters,
            'countries' => $countries,
            'cities' => $cities,
            'schools' => $schools,
        ]);
    }

    public function create(): View
    {
        return view('admin.school-branches.create', [
            'schools' => School::orderBy('name')->get(),
            'cities' => City::orderBy('name')->get(),
            'galleryImages' => $this->branchGalleryImages(),
            'selectedGalleryImageIds' => [],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        SchoolBranch::create($data);

        return redirect()
            ->route('admin.school-branches.index')
            ->with('success', 'School branch created successfully.');
    }

    public function edit(SchoolBranch $schoolBranch): View
    {
        return view('admin.school-branches.edit', [
            'branch' => $schoolBranch,
            'schools' => School::orderBy('name')->get(),
            'cities' => City::orderBy('name')->get(),
            'galleryText' => $this->galleryArrayToText($schoolBranch->gallery_urls),
            'galleryImages' => $this->branchGalleryImages(),
            'selectedGalleryImageIds' => $this->matchGalleryIds($schoolBranch->gallery_urls),
        ]);
    }

    public function update(Request $request, SchoolBranch $schoolBranch): RedirectResponse
    {
        $data = $this->validateData($request, $schoolBranch);

        $schoolBranch->update($data);

        return redirect()
            ->route('admin.school-branches.index')
            ->with('success', 'School branch updated successfully.');
    }

    public function destroy(SchoolBranch $schoolBranch): RedirectResponse
    {
        $schoolBranch->delete();

        return redirect()
            ->route('admin.school-branches.index')
            ->with('success', 'School branch deleted successfully.');
    }

    private function validateData(Request $request, ?SchoolBranch $branch = null): array
    {
        $request->merge([
            'slug' => Str::slug($request->input('slug', '')),
        ]);

        $data = $request->validate([
            'school_id' => ['required', 'integer', 'exists:schools,id'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'slug' => ['required', 'string', 'max:160', Rule::unique('school_branches', 'slug')->ignore($branch?->id)],
            'description' => ['nullable', 'string'],
            'ar_description' => ['nullable', 'string'],
            'gallery_urls' => ['nullable', 'string'],
            'video_url' => ['nullable', 'string', 'max:255'],
            'gallery_image_ids' => ['nullable', 'array'],
            'gallery_image_ids.*' => ['integer', 'exists:galleries,id'],
        ]);

        $galleryText = $data['gallery_urls'] ?? '';
        unset($data['gallery_urls']);
        $manualGallery = $this->normalizeGalleryUrls($galleryText);

        $selectedIds = collect($request->input('gallery_image_ids', []))
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->all();

        $selectedPaths = [];
        if (!empty($selectedIds)) {
            $selectedPaths = Gallery::query()
                ->where('use_case', 'branch_image')
                ->whereIn('id', $selectedIds)
                ->pluck('image_path')
                ->all();
        }

        $combined = array_values(array_unique(array_filter(array_merge($selectedPaths, $manualGallery ?? []))));
        $data['gallery_urls'] = empty($combined) ? null : $combined;

        return $data;
    }

    private function normalizeGalleryUrls(?string $text): ?array
    {
        if ($text === null) {
            return null;
        }

        $items = collect(preg_split('/\r\n|\r|\n/', $text ?? ''))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();

        return empty($items) ? null : $items;
    }

    private function galleryArrayToText(?array $gallery): string
    {
        return $gallery ? implode("\n", $gallery) : '';
    }

    private function branchGalleryImages()
    {
        return Gallery::query()
            ->where('use_case', 'branch_image')
            ->orderBy('title')
            ->orderBy('id')
            ->get(['id', 'title', 'image_path']);
    }

    private function matchGalleryIds(?array $paths): array
    {
        if (!$paths) {
            return [];
        }

        return Gallery::query()
            ->where('use_case', 'branch_image')
            ->whereIn('image_path', $paths)
            ->pluck('id')
            ->all();
    }
}
