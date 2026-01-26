@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Create Country</h2>
        <a href="{{ route('admin.countries.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Countries
        </a>
    </div>

    <form action="{{ route('admin.countries.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <!-- Country Name -->
            <div class="form-group">
                <label for="name" class="block text-sm font-medium text-gray-700">Country Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Arabic Name -->
            <div class="form-group">
                <label for="ar_name" class="block text-sm font-medium text-gray-700">Arabic Name</label>
                <input type="text" name="ar_name" id="ar_name" value="{{ old('ar_name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Flag Name -->
            <div class="form-group">
                <label for="flag" class="block text-sm font-medium text-gray-700">Flag Identifier</label>
                <input type="text" name="flag" id="flag" value="{{ old('flag') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="e.g. assets/flags/us.svg">
                <p class="text-xs text-gray-500 mt-1">Provide a relative path or upload below.</p>
                <input type="file" name="flag_upload" class="mt-2 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm" accept="image/*">
            </div>

            <!-- Country Code -->
            <div class="form-group">
                <label for="country_code" class="block text-sm font-medium text-gray-700">Country Code</label>
                <input type="text" name="country_code" id="country_code" value="{{ old('country_code') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Currency Code -->
            <div class="form-group">
                <label for="currency_code" class="block text-sm font-medium text-gray-700">Currency Code</label>
                <input type="text" name="currency_code" id="currency_code" value="{{ old('currency_code') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="form-group">
                <label for="phone_code" class="block text-sm font-medium text-gray-700">Phone Code</label>
                <input type="text" name="phone_code" id="phone_code" value="{{ old('phone_code') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Optional">
            </div>
            <div class="form-group">
                <label for="capital" class="block text-sm font-medium text-gray-700">Capital</label>
                <input type="text" name="capital" id="capital" value="{{ old('capital') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Optional">
            </div>
            <div class="form-group">
                <label for="continent" class="block text-sm font-medium text-gray-700">Continent</label>
                <input type="text" name="continent" id="continent" value="{{ old('continent') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Optional">
            </div>
        </div>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <!-- Description -->
            <div class="form-group">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('description') }}</textarea>
            </div>

            <!-- Arabic Description -->
            <div class="form-group">
                <label for="ar_description" class="block text-sm font-medium text-gray-700">Arabic Description</label>
                <textarea name="ar_description" id="ar_description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('ar_description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="display_order" class="block text-sm font-medium text-gray-700">Display Order</label>
                <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 0) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="0">
            </div>
            <div class="form-group flex items-center gap-2 mt-6">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" id="is_active" class="rounded border-gray-300 text-primary focus:ring-primary" {{ old('is_active', '1') === '1' ? 'checked' : '' }}>
                <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
            </div>
            <!-- Submit Button -->
            <div class="form-group sm:col-span-3">&nbsp;</div>
        </div>
        <div class="flex space-x-2 mt-4">
                <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                    Save Country
                </button>
                <a href="{{ route('admin.countries.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                    Cancel
                </a>
            </div>
    </form>
</div>
@endsection
