@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Edit Camp Media</h2>
        <a href="{{ route('admin.camp-media.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Camp Media
        </a>
    </div>

    <form action="{{ route('admin.camp-media.update', $campMedium) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="camp_id" class="block text-sm font-medium text-gray-700">Camp</label>
            <select name="camp_id" id="camp_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach ($camps as $camp)
                    <option value="{{ $camp->id }}" {{ (int) old('camp_id', $campMedium->camp_id) === $camp->id ? 'selected' : '' }}>
                        {{ $camp->name }} — {{ $camp->branch->school->name ?? 'Unknown School' }} ({{ $camp->branch->city->name ?? 'Unknown City' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Current Media</label>
            @if ($campMedium->path)
                <img src="{{ asset('storage/'.$campMedium->path) }}" alt="{{ $campMedium->alt_text }}" class="h-24 w-24 object-cover rounded-md border mb-2">
            @else
                <span class="text-gray-400 text-xs uppercase tracking-wide">No Image</span>
            @endif
        </div>

        <div>
            <label for="path" class="block text-sm font-medium text-gray-700">Replace Media</label>
            <input type="file" name="path" id="path" accept="image/*" class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <p class="text-xs text-gray-500 mt-1">Leave empty to keep the current media.</p>
        </div>

        <div>
            <label for="alt_text" class="block text-sm font-medium text-gray-700">Alt Text</label>
            <input type="text" name="alt_text" id="alt_text" value="{{ old('alt_text', $campMedium->alt_text) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <div>
            <label for="caption" class="block text-sm font-medium text-gray-700">Caption</label>
            <input type="text" name="caption" id="caption" value="{{ old('caption', $campMedium->caption) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="flex space-x-2 mt-6">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                Update Media
            </button>
            <a href="{{ route('admin.camp-media.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
