@extends('admin.layouts.layout')

@section('content')
    <div class="main-content py-10">
        <div class="flex justify-between py-10">
            <h2 class="text-2xl font-bold mb-4">Add Video Review</h2>
            <a href="{{ route('admin.video-reviews.index') }}"
                class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
                Back to List
            </a>
        </div>

        <form action="{{ route('admin.video-reviews.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>

                <!-- Course Name -->
                <div class="form-group">
                    <label for="course_name" class="block text-sm font-medium text-gray-700">Course Name</label>
                    <input type="text" name="course_name" id="course_name" value="{{ old('course_name') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- University Name -->
                <div class="form-group">
                    <label for="university_name" class="block text-sm font-medium text-gray-700">University Name</label>
                    <input type="text" name="university_name" id="university_name" value="{{ old('university_name') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Country Name -->
                <div class="form-group">
                    <label for="country_name" class="block text-sm font-medium text-gray-700">Country Name</label>
                    <input type="text" name="country_name" id="country_name" value="{{ old('country_name') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Video URL -->
                <div class="form-group">
                    <label for="video_url" class="block text-sm font-medium text-gray-700">Video URL <span
                            class="text-red-500">*</span></label>
                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>

                <!-- Thumbnail -->
                <div class="form-group">
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700">Thumbnail (Image)</label>
                    <input type="file" name="thumbnail" id="thumbnail"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Review Text -->
            <div class="form-group">
                <label for="review_text" class="block text-sm font-medium text-gray-700">Review Text</label>
                <textarea name="review_text" id="review_text" rows="4"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('review_text') }}</textarea>
            </div>

            <!-- Is Active -->
            <div class="form-group">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', 1) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="is_active" class="font-medium text-gray-700">Active</label>
                        <p class="text-gray-500">Show this review on the website.</p>
                    </div>
                </div>
            </div>

            <div class="flex space-x-2 mt-6">
                <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                    Save Review
                </button>
                <a href="{{ route('admin.video-reviews.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection