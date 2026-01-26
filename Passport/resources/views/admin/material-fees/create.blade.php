{{-- resources/views/admin/material-fees/create.blade.php --}}
@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Create Material Fee</h2>
        <a href="{{ route('admin.material-fees.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back to List</a>
    </div>

    @if ($errors->any())
        <div class="mb-4 text-red-700 bg-red-50 border border-red-200 rounded-md px-4 py-2">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.material-fees.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
            <select name="course_id" id="course_id"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm" required>
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                        {{ $course->name }} — {{ $course->branch->school->name ?? '' }} ({{ $course->branch->city->name ?? '' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="fee" class="block text-sm font-medium text-gray-700">Fee (USD)</label>
            <input type="number" step="0.01" min="0" name="fee" id="fee" value="{{ old('fee') }}"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm" required>
        </div>

        <div>
            <label for="fee_type" class="block text-sm font-medium text-gray-700">Fee Type</label>
            <select name="fee_type" id="fee_type"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm" required>
                <option value="flat" @selected(old('fee_type', 'flat') == 'flat')>Flat</option>
                <option value="weekly" @selected(old('fee_type') == 'weekly')>Weekly</option>
            </select>
        </div>

        <div class="flex space-x-2 mt-4">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Save</button>
            <a href="{{ route('admin.material-fees.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">Cancel</a>
        </div>
    </form>
</div>
@endsection
