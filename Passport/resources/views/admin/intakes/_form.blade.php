@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">University Course<span class="text-red-500">*</span></label>
        <select name="university_course_id" id="intake-course" required class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Select university course</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}" @selected((old('university_course_id', $intake->university_course_id ?? $selectedCourse ?? '') == $course->id))>
                    {{ $course->title }}@if($course->relationLoaded('university') && $course->university) — {{ $course->university->name }}@endif
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Status<span class="text-red-500">*</span></label>
        <select name="status" required class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected(old('status', $intake->status ?? 'open') === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Start Date<span class="text-red-500">*</span></label>
        <input type="date" name="start_date" id="intake-start-date" value="{{ old('start_date', isset($intake->start_date) ? $intake->start_date->format('Y-m-d') : '') }}" required class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Application Deadline</label>
        <input type="date" name="application_deadline" value="{{ old('application_deadline', isset($intake->application_deadline) ? $intake->application_deadline->format('Y-m-d') : '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Scholarship Deadline</label>
        <input type="date" name="scholarship_deadline" value="{{ old('scholarship_deadline', isset($intake->scholarship_deadline) ? $intake->scholarship_deadline->format('Y-m-d') : '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Orientation Date</label>
        <input type="date" name="orientation_date" value="{{ old('orientation_date', isset($intake->orientation_date) ? $intake->orientation_date->format('Y-m-d') : '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Suggested Label</label>
        <input type="text" name="label" id="intake-label" value="{{ old('label', $intake->label ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="e.g. Fall 2026">
        <p class="mt-1 text-xs text-gray-500 dark:text-white/50">Label auto-suggests from the start date; you can override it anytime.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Tuition Fee Override</label>
        <input type="number" step="0.01" min="0" name="tuition_fee_override" value="{{ old('tuition_fee_override', $intake->tuition_fee_override ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="e.g. 12000">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Currency Override</label>
        <input type="text" name="currency_override" value="{{ old('currency_override', $intake->currency_override ?? '') }}" maxlength="3" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm uppercase dark:border-white/10 dark:bg-transparent" placeholder="USD">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Deposit Amount</label>
        <input type="number" step="0.01" min="0" name="deposit_amount" value="{{ old('deposit_amount', $intake->deposit_amount ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="e.g. 500">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Capacity</label>
        <input type="number" min="0" name="capacity" value="{{ old('capacity', $intake->capacity ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="e.g. 120">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Teaching Period (weeks)</label>
        <input type="number" min="0" name="teaching_period_weeks" value="{{ old('teaching_period_weeks', $intake->teaching_period_weeks ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="e.g. 16">
    </div>
</div>

<div class="mt-6">
    <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Notes</label>
    <textarea name="notes" rows="4" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="Internal notes about the intake">{{ old('notes', $intake->notes ?? '') }}</textarea>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startDateInput = document.getElementById('intake-start-date');
        const labelInput = document.getElementById('intake-label');

        if (!startDateInput || !labelInput) {
            return;
        }

        const originalValue = labelInput.value;
        let userEdited = !!originalValue;

        labelInput.addEventListener('input', function () {
            userEdited = labelInput.value.trim().length > 0;
        });

        startDateInput.addEventListener('change', function () {
            if (userEdited) {
                return;
            }

            const value = startDateInput.value;
            if (!value) {
                return;
            }

            const date = new Date(value + 'T00:00:00');
            if (Number.isNaN(date.getTime())) {
                return;
            }

            const month = date.getUTCMonth() + 1;
            const year = date.getUTCFullYear();

            let season = 'Intake';
            if ([12, 1, 2].includes(month)) {
                season = 'Winter';
            } else if ([3, 4, 5].includes(month)) {
                season = 'Spring';
            } else if ([6, 7, 8].includes(month)) {
                season = 'Summer';
            } else if ([9, 10, 11].includes(month)) {
                season = 'Fall';
            }

            labelInput.value = `${season} ${year}`;
        });
    });
</script>
@endpush
