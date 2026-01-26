@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Intakes</h1>
                <p class="text-sm text-gray-600 dark:text-white/70">Manage course start dates, deadlines, and seat availability.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.intakes.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Create Intake</a>
            </div>
        </div>

        <form method="GET" class="box">
            <div class="box-body grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">University</label>
                    <select name="university_id" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        <option value="">All universities</option>
                        @foreach ($universities as $university)
                            <option value="{{ $university->id }}" @selected(request('university_id') == $university->id)>{{ $university->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">University Course</label>
                    <select name="university_course_id" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        <option value="">All courses</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" data-university="{{ $course->university_id }}" @selected(request('university_course_id') == $course->id)>
                                {{ $course->title }}@if($course->relationLoaded('university') && $course->university) — {{ $course->university->name }}@endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Status</label>
                    <select name="status" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        <option value="">All statuses</option>
                        @foreach (\App\Models\Intake::STATUSES as $status)
                            <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Start Date From</label>
                    <input type="date" name="start_date_from" value="{{ request('start_date_from') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Start Date To</label>
                    <input type="date" name="start_date_to" value="{{ request('start_date_to') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                </div>
                <div class="flex items-end gap-3 md:col-span-2 lg:col-span-4">
                    <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Filter</button>
                    <a href="{{ route('admin.intakes.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div class="box">
            <div class="box-body p-0 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-white/10">
                    <thead class="bg-gray-50 dark:bg-white/5">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Label</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">University Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Start Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Application Deadline</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Tuition Override</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-white/5 divide-y divide-gray-200 dark:divide-white/10">
                        @forelse ($intakes as $intake)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    <div class="font-semibold">{{ $intake->label ?? '—' }}</div>
                                    <div class="text-xs text-gray-500 dark:text-white/60">ID: {{ $intake->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                    <div>{{ $intake->universityCourse?->title ?? 'Not linked' }}</div>
                                    <div class="text-xs text-gray-500 dark:text-white/60">{{ $intake->universityCourse?->university?->name ?? '—' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                    {{ $intake->start_date?->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium bg-primary/10 text-primary capitalize">
                                        {{ str_replace('_', ' ', $intake->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                    {{ $intake->application_deadline?->format('d M Y') ?? '—' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                    @if ($intake->tuition_fee_override)
                                        {{ number_format($intake->tuition_fee_override, 2) }} {{ $intake->currency_override ?? '' }}
                                    @else
                                        <span class="text-gray-400 dark:text-white/50">Default</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.intakes.show', $intake) }}" class="ti-btn ti-btn-outline ti-btn-outline-primary rounded-full text-xs">View</a>
                                        <a href="{{ route('admin.intakes.edit', $intake) }}" class="ti-btn ti-btn-outline ti-btn-outline-success rounded-full text-xs">Edit</a>
                                        <form action="{{ route('admin.intakes.destroy', $intake) }}" method="POST" onsubmit="return confirm('Delete this intake?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ti-btn ti-btn-outline ti-btn-outline-danger rounded-full text-xs">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-white/60">No intakes found for the selected filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">
                {{ $intakes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const universitySelect = document.querySelector('select[name="university_id"]');
        const courseSelect = document.querySelector('select[name="university_course_id"]');

        if (!universitySelect || !courseSelect) {
            return;
        }

        function filterCourses() {
            const universityId = universitySelect.value;
            const selectedCourse = courseSelect.value;

            Array.from(courseSelect.options).forEach(option => {
                if (!option.value) {
                    option.hidden = false;
                    return;
                }

                const matches = !universityId || Number(option.dataset.university) === Number(universityId);
                option.hidden = !matches;

                if (!matches && option.value === selectedCourse) {
                    courseSelect.value = '';
                }
            });
        }

        filterCourses();
        universitySelect.addEventListener('change', filterCourses);
    });
</script>
@endpush
