@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Edit Course</h2>
        <a href="{{ route('admin.courses.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Courses
        </a>
    </div>

    <form action="{{ route('admin.courses.update', $course) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Course Name -->
        <div class="form-group">
            <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <!-- Arabic Name -->
        <div class="form-group">
            <label for="ar_name" class="block text-sm font-medium text-gray-700">Arabic Name</label>
            <input type="text" name="ar_name" id="ar_name" value="{{ old('ar_name', $course->ar_name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>{{ old('description', $course->description) }}</textarea>
        </div>

        <!-- Arabic Description -->
        <div class="form-group">
            <label for="ar_description" class="block text-sm font-medium text-gray-700">Arabic Description</label>
            <textarea name="ar_description" id="ar_description" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('ar_description', $course->ar_description) }}</textarea>
        </div>

        <!-- Branch -->
        <div class="form-group">
            <label for="branch_id" class="block text-sm font-medium text-gray-700">Branch</label>
            <select name="branch_id" id="branch_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ old('branch_id', $course->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->school->name }} - {{ $branch->city->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tag -->
        <div class="form-group">
            <label for="tag_id" class="block text-sm font-medium text-gray-700">Tag</label>
            <select name="tag_id" id="tag_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ old('tag_id', $course->tag_id) == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Course Type -->
        <div class="form-group">
            <label for="coursetype_id" class="block text-sm font-medium text-gray-700">Course Type</label>
            <select name="coursetype_id" id="coursetype_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach($courseTypes as $courseType)
                    <option value="{{ $courseType->id }}" {{ old('coursetype_id', $course->coursetype_id) == $courseType->id ? 'selected' : '' }}>{{ $courseType->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Start Date -->
        <div class="form-group">
            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="text" name="start_date" id="start_date" value="{{ old('start_date', $course->start_date) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <!-- Required Level -->
        <div class="form-group">
            <label for="required_level" class="block text-sm font-medium text-gray-700">Required Level</label>
            <input type="text" name="required_level" id="required_level" value="{{ old('required_level', $course->required_level) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Study Time -->
        <div class="form-group">
            <label for="study_time" class="block text-sm font-medium text-gray-700">Study Time</label>
            <input type="text" name="study_time" id="study_time" value="{{ old('study_time', $course->study_time) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Lessons per Week -->
        <div class="form-group">
            <label for="lessons_per_week" class="block text-sm font-medium text-gray-700">Lessons per Week</label>
            <input type="number" name="lessons_per_week" id="lessons_per_week" value="{{ old('lessons_per_week', $course->lessons_per_week) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Minimum Age -->
        <div class="form-group">
            <label for="min_age" class="block text-sm font-medium text-gray-700">Minimum Age</label>
            <input type="number" name="min_age" id="min_age" value="{{ old('min_age', $course->min_age) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="flex space-x-2 mt-4">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                Update Course
            </button>
            <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
