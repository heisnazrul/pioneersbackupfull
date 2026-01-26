@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">University Course<span class="text-red-500">*</span></label>
        <select name="university_course_id" required class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Select course</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}" @selected(old('university_course_id', $requirement->university_course_id ?? $selectedCourse ?? '') == $course->id)>
                    {{ $course->title }}@if($course->relationLoaded('university') && $course->university) — {{ $course->university->name }}@endif
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Requirement Code<span class="text-red-500">*</span></label>
        <select name="requirement_code" id="requirement-code" required class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">Select code</option>
            @foreach ($requirementCodes as $code)
                <option value="{{ $code }}" @selected(old('requirement_code', $requirement->requirement_code ?? '') === $code)>{{ $code }}</option>
            @endforeach
        </select>
        <p class="mt-1 text-xs text-gray-500 dark:text-white/60" id="requirement-help">
            {{ $requirementHelp[old('requirement_code', $requirement->requirement_code ?? '')] ?? 'Choose a requirement code to view contextual help.' }}
        </p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Value<span class="text-red-500">*</span></label>
        <input type="text" name="value" value="{{ old('value', $requirement->value ?? '') }}" required class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="Enter value (e.g., 6.5)">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Intake</label>
        <select name="intake_id" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">All intakes</option>
            @foreach ($intakes as $intake)
                <option value="{{ $intake->id }}" @selected(old('intake_id', $requirement->intake_id ?? '') == $intake->id)>
                    {{ $intake->label ?? 'Intake '.$intake->start_date?->format('M Y') }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Applicant Scope</label>
        <select name="applicant_scope" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
            <option value="">All applicants</option>
            @foreach ($scopes as $scope)
                <option value="{{ $scope }}" @selected(old('applicant_scope', $requirement->applicant_scope ?? '') === $scope)>{{ ucfirst($scope) }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Level Scope</label>
        <input type="text" name="level_scope" value="{{ old('level_scope', $requirement->level_scope ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="e.g. Masters">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Evidence Type</label>
        <input type="text" name="evidence_type" value="{{ old('evidence_type', $requirement->evidence_type ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="e.g. document:SOP">
    </div>
    <div class="flex items-center gap-2 mt-6">
        <input type="hidden" name="is_mandatory" value="0">
        <input type="checkbox" name="is_mandatory" value="1" class="rounded border-gray-300 text-primary focus:ring-primary" @checked(old('is_mandatory', $requirement->is_mandatory ?? true))>
        <span class="text-sm text-gray-700 dark:text-white/80">Mandatory requirement</span>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Band Breakdown JSON</label>
        <textarea name="band_breakdown_json" rows="4" class="mt-1 font-mono w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder='{"overall": 6.5, "bands_min": 6.0}'>{{ old('band_breakdown_json', isset($requirement->band_breakdown) ? json_encode($requirement->band_breakdown, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
        <p class="mt-1 text-xs text-gray-500 dark:text-white/50">Optional JSON for detailed score requirements.</p>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Comparators JSON</label>
        <textarea name="comparators_json" rows="4" class="mt-1 font-mono w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder='{"operator": ">=", "min": 6}'>{{ old('comparators_json', isset($requirement->comparators) ? json_encode($requirement->comparators, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
        <p class="mt-1 text-xs text-gray-500 dark:text-white/50">Define operator/min/max logic if needed.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Waiver Rules JSON</label>
        <textarea name="waiver_rules_json" rows="4" class="mt-1 font-mono w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder='{"eligible_if": "..."}'>{{ old('waiver_rules_json', isset($requirement->waiver_rules) ? json_encode($requirement->waiver_rules, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Prerequisite Subjects JSON</label>
        <textarea name="prereq_subjects_json" rows="4" class="mt-1 font-mono w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder='["Mathematics", "Physics"]'>{{ old('prereq_subjects_json', isset($requirement->prereq_subjects) ? json_encode($requirement->prereq_subjects, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Application Items JSON</label>
        <textarea name="application_items_json" rows="4" class="mt-1 font-mono w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder='["document:SOP", "document:LOR"]'>{{ old('application_items_json', isset($requirement->application_items) ? json_encode($requirement->application_items, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Minimum Work Experience (months)</label>
        <input type="number" name="min_work_experience_months" min="0" value="{{ old('min_work_experience_months', $requirement->min_work_experience_months ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Source</label>
        <input type="text" name="source" value="{{ old('source', $requirement->source ?? '') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent" placeholder="e.g. prospectus_2026">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Notes</label>
        <textarea name="notes" rows="3" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">{{ old('notes', $requirement->notes ?? '') }}</textarea>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const codeSelect = document.getElementById('requirement-code');
        const helpText = document.getElementById('requirement-help');
        const helpLookup = @json($requirementHelp);

        if (codeSelect && helpText) {
            codeSelect.addEventListener('change', function () {
                const selected = codeSelect.value;
                helpText.textContent = helpLookup[selected] ?? 'Choose a requirement code to view contextual help.';
            });
        }
    });
</script>
@endpush
