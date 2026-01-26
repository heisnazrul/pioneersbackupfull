<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UniversityCourse;
use App\Models\University;
use App\Models\UniversityCampus;
use App\Models\UniversityCourseLevel;
use Illuminate\Http\Request;

class UniversityCourseController extends Controller
{
    public function index(Request $request)
    {
        $query = UniversityCourse::query()->with(['university', 'campus', 'level']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('university_id')) {
            $query->where('university_id', $request->input('university_id'));
        }

        $courses = $query->paginate(10);
        $universities = University::pluck('name', 'id');

        return view('admin.university-courses.index', compact('courses', 'universities'));
    }

    public function create()
    {
        $universities = University::pluck('name', 'id');
        $levels = UniversityCourseLevel::pluck('name', 'id');
        $campuses = UniversityCampus::pluck('name', 'id'); // Should ideally be filtered by selected university
        return view('admin.university-courses.create', compact('universities', 'levels', 'campuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:university_courses',
            'university_id' => 'required|exists:universities,id',
            'campus_id' => 'nullable|exists:university_campuses,id',
            'level_id' => 'required|exists:university_course_levels,id',
            'faculty_name' => 'nullable|string',
            'duration_months' => 'required|integer',
            'tuition_fee' => 'required|numeric',
            'currency' => 'required|string|max:3',
        ]);

        UniversityCourse::create($validated);

        return redirect()->route('admin.university-courses.index')->with('success', 'Course created successfully.');
    }

    public function show(UniversityCourse $universityCourse)
    {
        $universityCourse->load(['university', 'campus', 'level', 'details', 'entryRequirements', 'intakes']);
        return view('admin.university-courses.show', compact('universityCourse'));
    }

    public function edit(UniversityCourse $universityCourse)
    {
        $universities = University::pluck('name', 'id');
        $levels = UniversityCourseLevel::pluck('name', 'id');
        $campuses = UniversityCampus::where('university_id', $universityCourse->university_id)->pluck('name', 'id');

        return view('admin.university-courses.edit', compact('universityCourse', 'universities', 'levels', 'campuses'));
    }

    public function update(Request $request, UniversityCourse $universityCourse)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:university_courses,slug,' . $universityCourse->id,
            'university_id' => 'required|exists:universities,id',
            'campus_id' => 'nullable|exists:university_campuses,id',
            'level_id' => 'required|exists:university_course_levels,id',
            'faculty_name' => 'nullable|string',
            'duration_months' => 'required|integer',
            'tuition_fee' => 'required|numeric',
            'currency' => 'required|string|max:3',
        ]);

        $universityCourse->update($validated);

        return redirect()->route('admin.university-courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(UniversityCourse $universityCourse)
    {
        $universityCourse->delete();
        return redirect()->route('admin.university-courses.index')->with('success', 'Course deleted successfully.');
    }
}
