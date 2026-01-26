<?php

namespace App\Http\Controllers;

use App\Models\PioneersDiscount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PioneersDiscountController extends Controller
{
    public function index(): View
    {
        $discounts = PioneersDiscount::query()
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.pioneers-discounts.index', [
            'discounts' => $discounts,
        ]);
    }

    public function create(): View
    {
        return view('admin.pioneers-discounts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        PioneersDiscount::create($data);

        return redirect()
            ->route('admin.pioneers-discounts.index')
            ->with('success', 'Pioneers discount created successfully.');
    }

    public function edit(PioneersDiscount $pioneersDiscount): View
    {
        return view('admin.pioneers-discounts.edit', [
            'pioneersDiscount' => $pioneersDiscount,
        ]);
    }

    public function update(Request $request, PioneersDiscount $pioneersDiscount): RedirectResponse
    {
        $data = $this->validateData($request);
        $pioneersDiscount->update($data);

        return redirect()
            ->route('admin.pioneers-discounts.index')
            ->with('success', 'Pioneers discount updated successfully.');
    }

    public function destroy(PioneersDiscount $pioneersDiscount): RedirectResponse
    {
        $pioneersDiscount->delete();

        return redirect()
            ->route('admin.pioneers-discounts.index')
            ->with('success', 'Pioneers discount deleted successfully.');
    }

    private function validateData(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ar_name' => ['nullable', 'string', 'max:255'],
            'weeks' => ['required', 'integer', 'min:1'],
            'discount_amount' => ['nullable', 'numeric', 'min:0'],
            'discount_full_for' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        return $data;
    }
}
