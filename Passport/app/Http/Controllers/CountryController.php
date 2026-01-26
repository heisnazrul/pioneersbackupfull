<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CountryController extends Controller
{
    public function index(): View
    {
        $countries = Country::query()
            ->orderBy('display_order')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.countries.index', [
            'countries' => $countries,
        ]);
    }

    public function create(): View
    {
        return view('admin.countries.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        if ($request->hasFile('flag_upload')) {
            $data['flag'] = $request->file('flag_upload')->store('flags', 'public');
        }

        Country::create($data);

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Country created successfully.');
    }

    public function edit(Country $country): View
    {
        return view('admin.countries.edit', [
            'country' => $country,
        ]);
    }

    public function update(Request $request, Country $country): RedirectResponse
    {
        $data = $this->validateData($request, $country);

        if ($request->boolean('remove_flag')) {
            $this->deleteFlag($country->flag);
            $data['flag'] = $this->defaultFlagValue($data['flag'] ?? null);
        }

        if ($request->hasFile('flag_upload')) {
            $this->deleteFlag($country->flag);
            $data['flag'] = $request->file('flag_upload')->store('flags', 'public');
        }

        $country->update($data);

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country): RedirectResponse
    {
        $this->deleteFlag($country->flag);
        $country->delete();

        return redirect()
            ->route('admin.countries.index')
            ->with('success', 'Country deleted successfully.');
    }

    private function validateData(Request $request, ?Country $country = null): array
    {
        $ignoreId = $country?->id;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ar_name' => ['required', 'string', 'max:255'],
            'flag' => ['nullable', 'string', 'max:255'],
            'flag_upload' => ['nullable', 'image', 'max:2048'],
            'country_code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('countries', 'country_code')->ignore($ignoreId),
            ],
            'currency_code' => ['required', 'string', 'max:10'],
            'phone_code' => ['nullable', 'string', 'max:10'],
            'description' => ['nullable', 'string'],
            'ar_description' => ['nullable', 'string'],
            'capital' => ['nullable', 'string', 'max:255'],
            'continent' => ['nullable', 'string', 'max:255'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['flag'] = $this->defaultFlagValue($data['flag'] ?? $country->flag ?? null);

        return $data;
    }

    private function defaultFlagValue(?string $flag): ?string
    {
        return $flag ? ltrim($flag, '/') : null;
    }

    private function deleteFlag(?string $flag): void
    {
        if (! $flag) {
            return;
        }

        if (str_starts_with($flag, 'flags/')) {
            Storage::disk('public')->delete($flag);
        }
    }
}

