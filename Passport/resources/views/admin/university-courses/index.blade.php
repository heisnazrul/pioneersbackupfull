@extends('admin.layouts.layout')

@section('content')
    <div class="main-content py-10">
        <div class="space-y-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">University Courses</h1>
                    <p class="text-sm text-gray-600 dark:text-white/70">Manage courses offered by universities.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.university-courses.create') }}"
                        class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Add Course</a>
                </div>
            </div>

            <form method="GET" class="box">
                <div class="box-body grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Name"
                            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">University</label>
                        <select name="university_id"
                            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                            <option value="">All Universities</option>
                            @foreach ($universities as $id => $name)
                                <option value="{{ $id }}" @selected(request('university_id') == $id)>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary w-full">Filter</button>
                    </div>
                </div>
            </form>

            <div class="box">
                <div class="box-body p-0 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-white/10">
                        <thead class="bg-gray-50 dark:bg-white/5">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">
                                    University</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">
                                    Campus</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">
                                    Level</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">
                                    Fee</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-white/5 divide-y divide-gray-200 dark:divide-white/10">
                            @forelse ($courses as $course)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $course->name }}
                                        <div class="text-xs text-gray-500">{{ $course->duration_months }} Months</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                        {{ $course->university->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                        {{ $course->campus?->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                        {{ $course->level->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                        {{ $course->currency }} {{ number_format($course->tuition_fee, 0) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.university-courses.edit', $course) }}"
                                                class="ti-btn ti-btn-outline ti-btn-outline-success rounded-full text-xs">Edit</a>
                                            <form action="{{ route('admin.university-courses.destroy', $course) }}"
                                                method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="ti-btn ti-btn-outline ti-btn-outline-danger rounded-full text-xs">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-white/60">No
                                        courses found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection