@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Create Camp Info</h2>
        <a href="{{ route('admin.camp-infos.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Camp Infos
        </a>
    </div>

    @if ($camps->isEmpty())
        <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 rounded-md">
            No summer camps without info are available. Please create a summer camp first or edit an existing info entry.
        </div>
    @else
    <form action="{{ route('admin.camp-infos.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="camp_id" class="block text-sm font-medium text-gray-700">Camp</label>
            <select name="camp_id" id="camp_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                <option value="" disabled {{ old('camp_id') ? '' : 'selected' }}>Select a camp</option>
                @foreach ($camps as $camp)
                    <option value="{{ $camp->id }}" {{ (int) old('camp_id') === $camp->id ? 'selected' : '' }}>
                        {{ $camp->name }} — {{ $camp->branch->school->name ?? 'Unknown School' }} ({{ $camp->branch->city->name ?? 'Unknown City' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="overview" class="block text-sm font-medium text-gray-700">Overview</label>
                <textarea name="overview" id="overview" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('overview') }}</textarea>
            </div>
            <div>
                <label for="ar_overview" class="block text-sm font-medium text-gray-700">Arabic Overview</label>
                <textarea name="ar_overview" id="ar_overview" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('ar_overview') }}</textarea>
            </div>

            <div>
                <label for="academics" class="block text-sm font-medium text-gray-700">Academics</label>
                <textarea name="academics" id="academics" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('academics') }}</textarea>
            </div>
            <div>
                <label for="ar_academics" class="block text-sm font-medium text-gray-700">Arabic Academics</label>
                <textarea name="ar_academics" id="ar_academics" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('ar_academics') }}</textarea>
            </div>

            <div>
                <label for="activities" class="block text-sm font-medium text-gray-700">Activities</label>
                <textarea name="activities" id="activities" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('activities') }}</textarea>
            </div>
            <div>
                <label for="ar_activities" class="block text-sm font-medium text-gray-700">Arabic Activities</label>
                <textarea name="ar_activities" id="ar_activities" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('ar_activities') }}</textarea>
            </div>

            <div>
                <label for="accommodation" class="block text-sm font-medium text-gray-700">Accommodation</label>
                <textarea name="accommodation" id="accommodation" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('accommodation') }}</textarea>
            </div>
            <div>
                <label for="ar_accommodation" class="block text-sm font-medium text-gray-700">Arabic Accommodation</label>
                <textarea name="ar_accommodation" id="ar_accommodation" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('ar_accommodation') }}</textarea>
            </div>

            <div>
                <label for="safeguarding" class="block text-sm font-medium text-gray-700">Safeguarding</label>
                <textarea name="safeguarding" id="safeguarding" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('safeguarding') }}</textarea>
            </div>
            <div>
                <label for="ar_safeguarding" class="block text-sm font-medium text-gray-700">Arabic Safeguarding</label>
                <textarea name="ar_safeguarding" id="ar_safeguarding" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('ar_safeguarding') }}</textarea>
            </div>
        </div>

        <div class="flex space-x-2 mt-6">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                Save Camp Info
            </button>
            <a href="{{ route('admin.camp-infos.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
        </div>
    </form>
    @endif
</div>
@endsection
