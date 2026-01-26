@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Upload Camp Media</h2>
        <a href="{{ route('admin.camp-media.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Camp Media
        </a>
    </div>

    @if ($camps->isEmpty())
        <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 rounded-md">
            No summer camps are available. Please create a summer camp first.
        </div>
    @else
    <form action="{{ route('admin.camp-media.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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

        <div>
            <label for="path" class="block text-sm font-medium text-gray-700">Media File</label>
            <input type="file" name="path" id="path" accept="image/*" class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label for="alt_text" class="block text-sm font-medium text-gray-700">Alt Text</label>
            <input type="text" name="alt_text" id="alt_text" value="{{ old('alt_text') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <div>
            <label for="caption" class="block text-sm font-medium text-gray-700">Caption</label>
            <input type="text" name="caption" id="caption" value="{{ old('caption') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="flex space-x-2 mt-6">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                Save Media
            </button>
            <a href="{{ route('admin.camp-media.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
        </div>
    </form>
    @endif
</div>
@endsection
