<?php

namespace App\Http\Controllers;

use App\Models\Accreditation;
use App\Models\School;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SchoolController extends Controller
{
    public function index(): View
    {
        $schools = School::query()
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.schools.index', [
            'schools' => $schools,
        ]);
    }

    public function create(): View
    {
        return view('admin.schools.create', [
            'accreditations' => Accreditation::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('schools', 'public');
        }

        School::create($data);

        return redirect()
            ->route('admin.schools.index')
            ->with('success', 'School created successfully.');
    }

    public function edit(School $school): View
    {
        return view('admin.schools.edit', [
            'school' => $school,
            'accreditations' => Accreditation::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, School $school): RedirectResponse
    {
        $data = $this->validateData($request, $school);

        if ($request->hasFile('logo')) {
            if ($school->logo) {
                Storage::disk('public')->delete($school->logo);
            }

            $data['logo'] = $request->file('logo')->store('schools', 'public');
        }

        $school->update($data);

        return redirect()
            ->route('admin.schools.index')
            ->with('success', 'School updated successfully.');
    }

    public function destroy(School $school): RedirectResponse
    {
        if ($school->logo) {
            Storage::disk('public')->delete($school->logo);
        }

        $school->delete();

        return redirect()
            ->route('admin.schools.index')
            ->with('success', 'School deleted successfully.');
    }

    private function validateData(Request $request, ?School $school = null): array
    {
        $request->merge([
            'slug' => Str::slug($request->input('slug') ?: $request->input('name', '')),
        ]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ar_name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('schools', 'slug')->ignore($school?->id)],
            'description' => ['nullable', 'string'],
            'ar_description' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'max:5120'],
            'accreditation_ids' => ['nullable', 'array'],
            'accreditation_ids.*' => ['integer', 'exists:accreditations,id'],
            'rating' => ['nullable', 'numeric', 'between:0,5'],
        ]);

        $data['accreditation_ids'] = array_map('intval', $data['accreditation_ids'] ?? []);
        $data['rating'] = $data['rating'] ?? 0;

        return $data;
    }
}
