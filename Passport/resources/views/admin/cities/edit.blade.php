@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Edit City</h2>
        <a href="{{ route('admin.cities.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Cities
        </a>
    </div>

    <form action="{{ route('admin.cities.update', $city) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <!-- City Name -->
            <div class="form-group">
                <label for="name" class="block text-sm font-medium text-gray-700">City Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $city->name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Arabic Name -->
            <div class="form-group">
                <label for="ar_name" class="block text-sm font-medium text-gray-700">Arabic Name</label>
                <input type="text" name="ar_name" id="ar_name" value="{{ old('ar_name', $city->ar_name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Country -->
            <div class="form-group">
                <label for="country_id" class="block text-sm font-medium text-gray-700">Country</label>
                <select name="country_id" id="country_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ old('country_id', $city->country_id) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="number" step="0.0000001" name="latitude" id="latitude" value="{{ old('latitude', $city->latitude) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Optional">
            </div>
            <div class="form-group">
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="number" step="0.0000001" name="longitude" id="longitude" value="{{ old('longitude', $city->longitude) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Optional">
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <!-- Description -->
            <div class="form-group">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description', $city->description) }}</textarea>
            </div>

            <!-- Arabic Description -->
            <div class="form-group">
                <label for="ar_description" class="block text-sm font-medium text-gray-700">Arabic Description</label>
                <textarea name="ar_description" id="ar_description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('ar_description', $city->ar_description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="display_order" class="block text-sm font-medium text-gray-700">Display Order</label>
                <input type="number" min="0" name="display_order" id="display_order" value="{{ old('display_order', $city->display_order) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="form-group flex items-center gap-2 mt-6">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" id="is_active" class="rounded border-gray-300 text-primary focus:ring-primary" {{ old('is_active', $city->is_active ? '1' : '0') === '1' ? 'checked' : '' }}>
                <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
            </div>
        </div>

        <div class="flex space-x-2 mt-4">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                Update City
            </button>
            <a href="{{ route('admin.cities.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
