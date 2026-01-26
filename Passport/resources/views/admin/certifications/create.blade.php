@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Create Certification</h2>
        <a href="{{ route('admin.certifications.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Certifications
        </a>
    </div>

    <form action="{{ route('admin.certifications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <div class="form-group">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Arabic Name -->
            <div class="form-group">
                <label for="ar_title" class="block text-sm font-medium text-gray-700">Arabic Title</label>
                <input type="text" name="ar_title" id="ar_title" value="{{ old('ar_title') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Optional">
            </div>
            <div>
                <label for="certificate_image" class="block text-sm font-medium text-gray-700">Certificate_image</label>
            <input type="file" name="certificate_image" id="certificate_image" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" accept="image/*">
            <p class="text-xs text-gray-500 mt-1">Optional. Upload certificate image (max 2MB).</p>
            </div>
        </div>

        <!-- Image -->
         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="subtitle" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="subtitle" id="subtitle" rows="3" class="mt-1 block w-full border rounded-md px-3 py-2">{{ old('subtitle') }}</textarea>
            </div>
            <div >
                <label for="ar_subtitle" class="block text-sm font-medium text-gray-700">Arabic Description</label>
                <textarea name="ar_subtitle" id="ar_subtitle" rows="3" class="mt-1 block w-full border rounded-md px-3 py-2">{{ old('ar_subtitle') }}</textarea>
            </div>
        </div>

        <div class="flex space-x-2 mt-4">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                Save Certification
            </button>
            <a href="{{ route('admin.certifications.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
