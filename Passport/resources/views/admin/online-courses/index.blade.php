@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Online Courses</h2>
        <a href="{{ route('admin.online-courses.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Create Online Course
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="border-b">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Thumbnail</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">School</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Course Type</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Fee</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($onlineCourses as $onlineCourse)
                <tr class="border-b">
                    <td class="px-6 py-4 text-sm">
                        @if ($onlineCourse->thumbnail)
                            <img src="{{ asset('storage/'.$onlineCourse->thumbnail) }}" alt="{{ $onlineCourse->name }} thumbnail" class="h-12 w-12 object-cover rounded-md border">
                        @else
                            <span class="text-gray-400 text-xs uppercase tracking-wide">No Image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $onlineCourse->name }}</td>
                    <td class="px-6 py-4 text-sm">{{ $onlineCourse->school->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm">{{ $onlineCourse->courseType->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm">
                        {{ number_format($onlineCourse->fee_amount, 2) }} {{ $onlineCourse->currency_code }}
                        <span class="text-gray-500">({{ ucfirst($onlineCourse->fee_type) }})</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.online-courses.edit', $onlineCourse) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.online-courses.destroy', $onlineCourse) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-sm text-center text-gray-500">No online courses found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $onlineCourses->links() }}
        </div>
    </div>
</div>
@endsection
