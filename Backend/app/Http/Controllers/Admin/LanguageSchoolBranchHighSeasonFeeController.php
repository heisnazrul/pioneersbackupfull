<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LanguageSchoolBranch;
use App\Models\LanguageSchoolBranchHighSeasonFee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LanguageSchoolBranchHighSeasonFeeController extends Controller
{
    public function index(): View
    {
        $fees = LanguageSchoolBranchHighSeasonFee::with('branch.school')->orderByDesc('created_at')->paginate(20);
        $branches = LanguageSchoolBranch::with('school')->orderBy('slug')->get();
        return view('admin.language-school-branch-high-season-fees.index', compact('fees', 'branches'));
    }

    public function create(): View
    {
        $branches = LanguageSchoolBranch::with('school')->orderBy('slug')->get();
        return view('admin.language-school-branch-high-season-fees.create', compact('branches'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'branch_id' => ['required', 'exists:language_school_branches,id'],
            'week_start' => ['required', 'integer', 'min:1'],
            'week_end' => ['nullable', 'integer', 'min:1'],
            'fee' => ['required', 'numeric', 'min:0'],
        ]);

        LanguageSchoolBranchHighSeasonFee::create($data);

        return redirect()->route('admin.language-school-branch-high-season-fees.index')->with('success', 'High season fee added.');
    }

    public function edit(LanguageSchoolBranchHighSeasonFee $languageSchoolBranchHighSeasonFee): View
    {
        $branches = LanguageSchoolBranch::with('school')->orderBy('slug')->get();
        return view('admin.language-school-branch-high-season-fees.edit', [
            'fee' => $languageSchoolBranchHighSeasonFee,
            'branches' => $branches,
        ]);
    }

    public function update(Request $request, LanguageSchoolBranchHighSeasonFee $languageSchoolBranchHighSeasonFee): RedirectResponse
    {
        $data = $request->validate([
            'branch_id' => ['required', 'exists:language_school_branches,id'],
            'week_start' => ['required', 'integer', 'min:1'],
            'week_end' => ['nullable', 'integer', 'min:1'],
            'fee' => ['required', 'numeric', 'min:0'],
        ]);

        $languageSchoolBranchHighSeasonFee->update($data);

        return redirect()->route('admin.language-school-branch-high-season-fees.index')->with('success', 'High season fee updated.');
    }

    public function destroy(LanguageSchoolBranchHighSeasonFee $languageSchoolBranchHighSeasonFee): RedirectResponse
    {
        $languageSchoolBranchHighSeasonFee->delete();
        return redirect()->route('admin.language-school-branch-high-season-fees.index')->with('success', 'High season fee deleted.');
    }
}
