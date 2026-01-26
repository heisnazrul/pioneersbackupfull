@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Create Course Type</h2>
        <a href="{{ route('admin.course-types.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Course Types
        </a>
    </div>

    <form action="{{ route('admin.course-types.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Course Type Name -->
        <div class="form-group">
            <label for="name" class="block text-sm font-medium text-gray-700">Course Type Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <!-- Arabic Name -->
        <div class="form-group">
            <label for="ar_name" class="block text-sm font-medium text-gray-700">Arabic Name</label>
            <input type="text" name="ar_name" id="ar_name" value="{{ old('ar_name') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="flex space-x-2 mt-4">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                Save Course Type
            </button>
            <a href="{{ route('admin.course-types.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
