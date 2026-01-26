<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CouponController extends Controller
{
    public function index(): View
    {
        $coupons = Coupon::query()
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.coupons.index', [
            'coupons' => $coupons,
        ]);
    }

    public function create(): View
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['used_count'] = $data['used_count'] ?? 0;

        Coupon::create($data);

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon): View
    {
        return view('admin.coupons.edit', [
            'coupon' => $coupon,
        ]);
    }

    public function update(Request $request, Coupon $coupon): RedirectResponse
    {
        $data = $this->validateData($request, $coupon);

        $coupon->update($data);

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon): RedirectResponse
    {
        $coupon->delete();

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Coupon deleted successfully.');
    }

    private function validateData(Request $request, ?Coupon $coupon = null): array
    {
        $data = $request->validate([
            'code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('coupons', 'code')->ignore($coupon),
            ],
            'name' => ['required', 'string', 'max:255'],
            'discount_type' => ['required', Rule::in(['percent', 'flat'])],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'usage_limit' => ['required', 'integer', 'min:1'],
            'used_count' => ['nullable', 'integer', 'min:0'],
            'expiration_date' => ['nullable', 'date'],
            'minimum_purchase_amount' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['used_count'] = $request->input('used_count', $coupon?->used_count ?? 0) ?? 0;

        return $data;
    }
}
