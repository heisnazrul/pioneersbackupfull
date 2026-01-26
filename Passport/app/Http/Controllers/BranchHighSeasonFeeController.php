<?php

namespace App\Http\Controllers;

use App\Models\BranchHighSeasonFee;
use App\Models\SchoolBranch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BranchHighSeasonFeeController extends Controller
{
    public function index(): View
    {
        $fees = BranchHighSeasonFee::query()
            ->with(['branch.school'])
            ->orderByDesc('season_start_date')
            ->paginate(20)
            ->withQueryString();

        return view('admin.branch-high-season-fees.index', compact('fees'));
    }

    public function create(): View
    {
        return view('admin.branch-high-season-fees.create', [
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        BranchHighSeasonFee::create($data);

        return redirect()->route('admin.branch-high-season-fees.index')->with('success', 'High season fee created.');
    }

    public function edit(BranchHighSeasonFee $branchHighSeasonFee): View
    {
        return view('admin.branch-high-season-fees.edit', [
            'fee' => $branchHighSeasonFee,
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
        ]);
    }

    public function update(Request $request, BranchHighSeasonFee $branchHighSeasonFee): RedirectResponse
    {
        $data = $this->validateData($request);

        $branchHighSeasonFee->update($data);

        return redirect()->route('admin.branch-high-season-fees.index')->with('success', 'High season fee updated.');
    }

    public function destroy(BranchHighSeasonFee $branchHighSeasonFee): RedirectResponse
    {
        $branchHighSeasonFee->delete();

        return redirect()->route('admin.branch-high-season-fees.index')->with('success', 'High season fee deleted.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'branch_id' => ['required', 'integer', 'exists:school_branches,id'],
            'season_start_date' => ['required', 'date'],
            'season_end_date' => ['required', 'date', 'after_or_equal:season_start_date'],
            'amount_per_week' => ['required', 'numeric', 'min:0'],
        ]);
    }
}
