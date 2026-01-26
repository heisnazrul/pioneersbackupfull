@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Training Courses</h2>
    <a href="{{ route('admin.training-courses.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
      Create Training Course
    </a>
  </div>

  <div class="overflow-x-auto bg-white rounded-lg shadow-md">
    <table class="min-w-full bg-white">
      <thead>
        <tr class="border-b">
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Name</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">School</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Branch</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Course Type</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Fee</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Status</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($trainingCourses as $trainingCourse)
          <tr class="border-b">
            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $trainingCourse->name }}</td>
            <td class="px-6 py-4 text-sm">{{ $trainingCourse->school->name ?? 'N/A' }}</td>
            <td class="px-6 py-4 text-sm">{{ $trainingCourse->branch?->slug ?? '—' }}</td>
            <td class="px-6 py-4 text-sm">{{ $trainingCourse->courseType->name ?? 'N/A' }}</td>
            <td class="px-6 py-4 text-sm">
              {{ number_format($trainingCourse->fee_amount, 2) }} {{ $trainingCourse->currency_code }}
              <span class="text-gray-500">({{ ucfirst($trainingCourse->fee_type) }})</span>
            </td>
            <td class="px-6 py-4 text-sm">
              <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full {{ $trainingCourse->visible ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                {{ $trainingCourse->visible ? 'Visible' : 'Hidden' }} • {{ ucfirst($trainingCourse->status) }}
              </span>
            </td>
            <td class="px-6 py-4 text-sm">
              <a href="{{ route('admin.training-courses.edit', $trainingCourse) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
              <form action="{{ route('admin.training-courses.destroy', $trainingCourse) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Delete this course?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="px-6 py-4 text-sm text-center text-gray-500">No training courses found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div class="px-6 py-4">
      {{ $trainingCourses->links() }}
    </div>
  </div>
</div>
@endsection
