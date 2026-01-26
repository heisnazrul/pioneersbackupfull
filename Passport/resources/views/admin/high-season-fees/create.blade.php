{{-- resources/views/admin/high-season-fees/create.blade.php --}}
@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Create High Season Fee</h2>
        <a href="{{ route('admin.high-season-fees.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back to List</a>
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

    <form action="{{ route('admin.high-season-fees.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
            <select name="course_id" id="course_id" class="mt-1 block w-full border rounded-md px-3 py-2" required>
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                        {{ $course->name }} — {{ $course->branch->school->name ?? '' }} ({{ $course->branch->city->name ?? '' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
        </div>

        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
        </div>

        <div>
            <label for="fee" class="block text-sm font-medium text-gray-700">Fee (USD)</label>
            <input type="number" step="0.01" name="fee" id="fee" value="{{ old('fee') }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Save</button>
            <a href="{{ route('admin.high-season-fees.index') }}" class="inline-flex items-center px-4 py-2 border rounded-full">Cancel</a>
        </div>
    </form>
</div>
@endsection
