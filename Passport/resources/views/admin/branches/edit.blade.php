@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Edit Branch</h2>
        <a href="{{ route('admin.branches.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Branches
        </a>
    </div>

    <form action="{{ route('admin.branches.update', $branch) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- School -->
        <div class="form-group">
            <label for="school_id" class="block text-sm font-medium text-gray-700">School</label>
            <select name="school_id" id="school_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach($schools as $school)
                    <option value="{{ $school->id }}" {{ old('school_id', $branch->school_id) == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- City -->
        <div class="form-group">
            <label for="city_id" class="block text-sm font-medium text-gray-700">City</label>
            <select name="city_id" id="city_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ old('city_id', $branch->city_id) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('description', $branch->description) }}</textarea>
        </div>

        <!-- Arabic Description -->
        <div class="form-group">
            <label for="ar_description" class="block text-sm font-medium text-gray-700">Arabic Description</label>
            <textarea name="ar_description" id="ar_description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('ar_description', $branch->ar_description) }}</textarea>
        </div>

        <!-- Images -->
        <div class="form-group">
            <label for="images" class="block text-sm font-medium text-gray-700">Images</label>
            <input type="file" name="images[]" id="images" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple>
            @if($branch->images)
                <div class="mt-2">
                    @foreach($branch->images as $image)
                        <img src="{{ Storage::url($image) }}" width="50" height="50" alt="Branch Image">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Video -->
        <div class="form-group">
            <label for="video" class="block text-sm font-medium text-gray-700">Video URL</label>
            <input type="url" name="video" id="video" value="{{ old('video', $branch->video) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Rating -->
        <div class="form-group">
            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
            <input type="number" name="rating" id="rating" value="{{ old('rating', $branch->rating) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" min="0" max="5" step="0.1">
        </div>

        <div class="flex space-x-2 mt-4">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                Update Branch
            </button>
            <a href="{{ route('admin.branches.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
