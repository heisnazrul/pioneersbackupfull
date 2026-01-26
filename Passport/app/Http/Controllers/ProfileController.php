<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\UserProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();
        $profile = $user->profile ?: new UserProfile(['user_id' => $user->id]);

        return view('admin.profile.edit', [
            'user' => $user,
            'profile' => $profile,
            'countries' => Country::query()->orderBy('display_order')->orderBy('name')->get(),
            'cities' => City::query()->orderBy('display_order')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        $profile = $user->profile ?: new UserProfile(['user_id' => $user->id]);

        $data = $request->validate([
            'first_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'nationality_country_id' => ['nullable', Rule::exists('countries', 'id')],
            'current_country_id' => ['nullable', Rule::exists('countries', 'id')],
            'current_city_id' => ['nullable', Rule::exists('cities', 'id')],
            'address_line' => ['nullable', 'string', 'max:191'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'secondary_email' => ['nullable', 'email', 'max:191'],
            'alt_phone_e164' => ['nullable', 'string', 'max:32'],
        ]);

        $profile->fill($data);
        $profile->user()->associate($user);
        $profile->save();

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}
