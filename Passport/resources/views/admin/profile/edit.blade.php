@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <div>
            <h2 class="text-2xl font-bold mb-2">My Profile</h2>
            <p class="text-sm text-gray-500">Update your personal information and contact details.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-md bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $profile->first_name) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $profile->last_name) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', optional($profile->date_of_birth)->format('Y-m-d')) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" class="mt-1 block w-full border rounded-md px-3 py-2">
                    <option value="">Prefer not to say</option>
                    @foreach(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('gender', $profile->gender) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nationality</label>
                <select name="nationality_country_id" class="mt-1 block w-full border rounded-md px-3 py-2">
                    <option value="">Select nationality</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" @selected(old('nationality_country_id', $profile->nationality_country_id) == $country->id)>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Current Country</label>
                <select name="current_country_id" class="mt-1 block w-full border rounded-md px-3 py-2">
                    <option value="">Select country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" @selected(old('current_country_id', $profile->current_country_id) == $country->id)>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Current City</label>
                <select name="current_city_id" class="mt-1 block w-full border rounded-md px-3 py-2">
                    <option value="">Select city</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" @selected(old('current_city_id', $profile->current_city_id) == $city->id)>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address_line" value="{{ old('address_line', $profile->address_line) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Postal Code</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', $profile->postal_code) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Secondary Email</label>
                <input type="email" name="secondary_email" value="{{ old('secondary_email', $profile->secondary_email) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Alternate Phone</label>
                <input type="text" name="alt_phone_e164" value="{{ old('alt_phone_e164', $profile->alt_phone_e164) }}" class="mt-1 block w-full border rounded-md px-3 py-2" placeholder="Include country code e.g. +971..."><p class="text-xs text-gray-500 mt-1">Stored without formatting for international dialing.</p>
            </div>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Save Profile</button>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 border rounded-full">Cancel</a>
        </div>
    </form>
</div>
@endsection
