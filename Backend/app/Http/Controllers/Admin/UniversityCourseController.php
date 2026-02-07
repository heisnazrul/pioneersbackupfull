<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\SubjectArea;
use App\Models\University;
use App\Models\UniversityCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UniversityCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = UniversityCourse::with(['university', 'level', 'subjectArea'])
            ->orderBy('university_id')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.university_courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $universities = University::orderBy('name')->get();
        $levels = Level::where('is_active', true)->orderBy('sort_order')->get();
        $subjects = SubjectArea::where('is_active', true)->orderBy('sort_order')->get();
        $intakes = \App\Models\IntakeTerm::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.university_courses.create', compact('universities', 'levels', 'subjects', 'intakes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'university_id' => 'required|exists:universities,id',
            'level_id' => 'required|exists:levels,id',
            'subject_area_id' => 'nullable|exists:subject_areas,id',
            'name' => 'required|string|max:255',
            'ar_name' => 'nullable|string|max:255',
            'duration_value' => 'nullable|integer|min:1',
            'duration_unit' => 'required|string|in:month,year,week',
            'first_year_fee' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'degree_requirement' => 'nullable|string',
            'language_requirement' => 'nullable|string',
            'overview' => 'nullable|string',
            'ar_overview' => 'nullable|string',
            'awarding_body' => 'nullable|string|max:255',
            'ar_awarding_body' => 'nullable|string|max:255',
            'is_active' => 'boolean',

            // Intakes validation
            'intakes' => 'nullable|array',
            'intakes.*.selected' => 'nullable|boolean', // Checkbox
            'intakes.*.deadline_date' => 'nullable|date',
            'intakes.*.start_date' => 'nullable|date',
            'intakes.*.id' => 'exists:intake_terms,id',
        ]);

        $slug = Str::slug($validated['name']);

        // Ensure unique slug per university
        $count = UniversityCourse::where('university_id', $validated['university_id'])
            ->where('slug', $slug)
            ->count();

        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $validated['slug'] = $slug;

        $course = UniversityCourse::create($validated);

        // Sync logic for pivot with extra fields
        if (!empty($validated['intakes'])) {
            $syncData = [];
            foreach ($validated['intakes'] as $intakeId => $data) {
                if (!empty($data['selected']) && $data['selected'] == 1) {
                    $syncData[$intakeId] = [
                        'deadline_date' => $data['deadline_date'] ?? null,
                        'start_date' => $data['start_date'] ?? null,
                        'is_active' => true,
                    ];
                }
            }
            $course->intakeTerms()->sync($syncData);
        }

        return redirect()->route('admin.university-courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UniversityCourse $universityCourse)
    {
        $universities = University::orderBy('name')->get();
        $levels = Level::where('is_active', true)->orderBy('sort_order')->get();
        $subjects = SubjectArea::where('is_active', true)->orderBy('sort_order')->get();
        $intakes = \App\Models\IntakeTerm::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.university_courses.edit', compact('universityCourse', 'universities', 'levels', 'subjects', 'intakes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UniversityCourse $universityCourse)
    {
        $validated = $request->validate([
            'university_id' => 'required|exists:universities,id',
            'level_id' => 'required|exists:levels,id',
            'subject_area_id' => 'nullable|exists:subject_areas,id',
            'name' => 'required|string|max:255',
            'ar_name' => 'nullable|string|max:255',
            'duration_value' => 'nullable|integer|min:1',
            'duration_unit' => 'required|string|in:month,year,week',
            'first_year_fee' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'degree_requirement' => 'nullable|string',
            'language_requirement' => 'nullable|string',
            'overview' => 'nullable|string',
            'ar_overview' => 'nullable|string',
            'awarding_body' => 'nullable|string|max:255',
            'ar_awarding_body' => 'nullable|string|max:255',
            'is_active' => 'boolean',

            'intakes' => 'nullable|array',
            'intakes.*.selected' => 'nullable|boolean',
            'intakes.*.deadline_date' => 'nullable|date',
            'intakes.*.start_date' => 'nullable|date',
            'intakes.*.id' => 'exists:intake_terms,id',
        ]);

        if ($universityCourse->name !== $validated['name']) {
            $slug = Str::slug($validated['name']);
            // Check uniqueness excluding current
            $count = UniversityCourse::where('university_id', $validated['university_id'])
                ->where('slug', $slug)
                ->where('id', '!=', $universityCourse->id)
                ->count();

            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            $validated['slug'] = $slug;
        }

        $universityCourse->update($validated);

        // Sync logic
        $syncData = [];
        if (!empty($request->input('intakes'))) {
            foreach ($request->input('intakes') as $intakeId => $data) {
                if (!empty($data['selected']) && $data['selected'] == 1) {
                    $syncData[$intakeId] = [
                        'deadline_date' => $data['deadline_date'] ?? null,
                        'start_date' => $data['start_date'] ?? null,
                        'is_active' => true,
                    ];
                }
            }
        }
        $universityCourse->intakeTerms()->sync($syncData);

        return redirect()->route('admin.university-courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UniversityCourse $universityCourse)
    {
        $universityCourse->delete();

        return redirect()->route('admin.university-courses.index')->with('success', 'Course deleted successfully.');
    }
}
