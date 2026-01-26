@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Course Fees List</h2>
        <a href="{{ route('admin.course-fees.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Add New Course Fee
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="border-b">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Course Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">School & Branch</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Year</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Weeks (Min-Max)</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Fees (Min-Max)</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($fees as $fee)
                <tr class="border-b">
                    <td class="px-6 py-4">{{ $fee->course->name }}</td>
                    <td class="px-6 py-4">{{ $fee->course->branch->school->name ?? '' }} - {{ $fee->course->branch->city->name ?? '' }}</td>
                    <td class="px-6 py-4">{{ $fee->year }}</td> <!-- ✅ -->
                    <td class="px-6 py-4">{{ $fee->min_week }} - {{ $fee->max_week }}</td>
                    <td class="px-6 py-4">${{ $fee->min_fee }} - ${{ $fee->max_fee }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.course-fees.edit', ['course' => $fee->course_id, 'year' => $fee->year]) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('admin.course-fees.destroy', ['course' => $fee->course_id, 'year' => $fee->year]) }}" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 ml-4">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $fees->links() }}
        </div>
    </div>
</div>
@endsection
