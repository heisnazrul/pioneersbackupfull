<?php

namespace App\Http\Controllers;

use App\Models\BranchSupplement;
use App\Models\SchoolBranch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplementController extends Controller
{
    public function index(): View
    {
        $supplements = BranchSupplement::query()
            ->with(['branch.school'])
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.supplements.index', compact('supplements'));
    }

    public function create(): View
    {
        return view('admin.supplements.create', [
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        BranchSupplement::create($data);

        return redirect()->route('admin.supplements.index')->with('success', 'Supplement created successfully.');
    }

    public function edit(BranchSupplement $supplement): View
    {
        return view('admin.supplements.edit', [
            'supplement' => $supplement,
            'branches' => SchoolBranch::with('school')->orderBy('slug')->get(),
        ]);
    }

    public function update(Request $request, BranchSupplement $supplement): RedirectResponse
    {
        $data = $this->validateData($request);

        $supplement->update($data);

        return redirect()->route('admin.supplements.index')->with('success', 'Supplement updated successfully.');
    }

    public function destroy(BranchSupplement $supplement): RedirectResponse
    {
        $supplement->delete();

        return redirect()->route('admin.supplements.index')->with('success', 'Supplement deleted successfully.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ar_name' => ['nullable', 'string', 'max:255'],
            'school_branch_id' => ['required', 'integer', 'exists:school_branches,id'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'fee' => ['required', 'numeric', 'min:0'],
        ]);
    }
}
