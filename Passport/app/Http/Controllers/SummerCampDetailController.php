<?php

namespace App\Http\Controllers;

use App\Models\SummerCamp;
use App\Models\SummerCampDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SummerCampDetailController extends Controller
{
    public function index(): View
    {
        $campDetails = SummerCampDetail::query()
            ->with(['camp.branch.school'])
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.summer-camp-details.index', compact('campDetails'));
    }

    public function create(): View
    {
        $camps = SummerCamp::query()
            ->doesntHave('detail')
            ->orderBy('name')
            ->get();

        return view('admin.summer-camp-details.create', compact('camps'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        SummerCampDetail::create($data);

        return redirect()->route('admin.summer-camp-details.index')->with('success', 'Camp details saved successfully.');
    }

    public function edit(SummerCampDetail $summerCampDetail): View
    {
        return view('admin.summer-camp-details.edit', [
            'campDetail' => $summerCampDetail->load('camp'),
        ]);
    }

    public function update(Request $request, SummerCampDetail $summerCampDetail): RedirectResponse
    {
        $data = $this->validateData($request, $summerCampDetail);

        $summerCampDetail->update($data);

        return redirect()->route('admin.summer-camp-details.index')->with('success', 'Camp details updated successfully.');
    }

    public function destroy(SummerCampDetail $summerCampDetail): RedirectResponse
    {
        $summerCampDetail->delete();

        return redirect()->route('admin.summer-camp-details.index')->with('success', 'Camp details deleted successfully.');
    }

    private function validateData(Request $request, ?SummerCampDetail $detail = null): array
    {
        return $request->validate([
            'camp_id' => ['required', 'integer', 'exists:summer_camps,id', Rule::unique('summer_camp_details', 'camp_id')->ignore($detail?->id)],
            'overview' => ['nullable', 'string'],
            'ar_overview' => ['nullable', 'string'],
            'academics' => ['nullable', 'string'],
            'ar_academics' => ['nullable', 'string'],
            'activities' => ['nullable', 'string'],
            'ar_activities' => ['nullable', 'string'],
            'accommodation' => ['nullable', 'string'],
            'ar_accommodation' => ['nullable', 'string'],
            'safeguarding' => ['nullable', 'string'],
            'ar_safeguarding' => ['nullable', 'string'],
        ]);
    }
}
