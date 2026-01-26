@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Course Requirements</h1>
                <p class="text-sm text-gray-600 dark:text-white/70">Centralised programme requirement facts across courses and intakes.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.course-requirements.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Add Requirement</a>
            </div>
        </div>

        <form method="GET" class="box">
            <div class="box-body grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
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
                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Requirement Code</label>
                    <select name="requirement_code" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        <option value="">All codes</option>
                        @foreach ($requirementCodes as $code)
                            <option value="{{ $code }}" @selected(request('requirement_code') === $code)>{{ $code }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Intake</label>
                    <select name="intake_id" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        <option value="">All</option>
                        @foreach ($intakes as $intake)
                            <option value="{{ $intake->id }}" @selected(request('intake_id') == $intake->id)>{{ $intake->label ?? 'Intake '.$intake->start_date?->format('M Y') }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-3 md:col-span-3 lg:col-span-4">
                    <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Filter</button>
                    <a href="{{ route('admin.course-requirements.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div class="box">
            <div class="box-body p-0 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-white/10">
                    <thead class="bg-gray-50 dark:bg-white/5">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">University Course</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Requirement</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Value</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Scope</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Intake</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-white/5 divide-y divide-gray-200 dark:divide-white/10">
                        @forelse ($requirements as $requirement)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    <div class="font-medium">{{ $requirement->universityCourse?->title ?? '—' }}</div>
                                    <div class="text-xs text-gray-500 dark:text-white/60">
                                        {{ $requirement->universityCourse?->university?->name ?? '—' }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-white/40">#{{ $requirement->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-white/80">
                                    <div class="font-semibold">{{ $requirement->requirement_code }}</div>
                                    <div class="text-xs text-gray-500 dark:text-white/60">
                                        {{ $requirementHelp[$requirement->requirement_code] ?? '—' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-white/80">
                                    {{ $requirement->value }}
                                    @if ($requirement->is_mandatory)
                                        <span class="ml-2 inline-flex items-center rounded-full bg-red-100 px-2 py-0.5 text-[11px] font-semibold text-red-700">Required</span>
                                    @else
                                        <span class="ml-2 inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-[11px] text-gray-600 dark:bg-white/10 dark:text-white/70">Optional</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                    {{ $requirement->applicant_scope ? ucfirst($requirement->applicant_scope) : 'All applicants' }}
                                    @if ($requirement->level_scope)
                                        <div class="text-xs text-gray-500 dark:text-white/60">Level: {{ $requirement->level_scope }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                    @if ($requirement->intake)
                                        {{ $requirement->intake->label ?? $requirement->intake->start_date?->format('d M Y') }}
                                    @else
                                        <span class="text-gray-400 dark:text-white/50">All intakes</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.course-requirements.show', $requirement) }}" class="ti-btn ti-btn-outline ti-btn-outline-primary rounded-full text-xs">View</a>
                                        <a href="{{ route('admin.course-requirements.edit', $requirement) }}" class="ti-btn ti-btn-outline ti-btn-outline-success rounded-full text-xs">Edit</a>
                                        <form action="{{ route('admin.course-requirements.destroy', $requirement) }}" method="POST" onsubmit="return confirm('Delete this requirement?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ti-btn ti-btn-outline ti-btn-outline-danger rounded-full text-xs">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-white/60">No requirements found for the selected filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">
                {{ $requirements->links() }}
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
            const selectedUniversity = universitySelect.value;
            const currentCourse = courseSelect.value;

            Array.from(courseSelect.options).forEach(option => {
                if (!option.value) {
                    option.hidden = false;
                    return;
                }

                const matches = !selectedUniversity || Number(option.dataset.university) === Number(selectedUniversity);
                option.hidden = !matches;

                if (!matches && option.value === currentCourse) {
                    courseSelect.value = '';
                }
            });
        }

        filterCourses();
        universitySelect.addEventListener('change', filterCourses);
    });
</script>
@endpush
