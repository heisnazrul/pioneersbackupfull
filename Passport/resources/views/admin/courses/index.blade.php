@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Courses List</h2>
        <a href="{{ route('admin.courses.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Create Course
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="border-b">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Course Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Branch</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Tags</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr class="border-b">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $course->name }}</td>
                    <td class="px-6 py-4 text-sm">{{ $course->branch->school->name }} - {{ $course->branch->city->name }}</td>
                    <td class="px-6 py-4 text-sm">{{ $course->tag->name }}</td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.courses.edit', $course) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 ml-4">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $courses->links() }}
        </div>
    </div>
</div>
@endsection
