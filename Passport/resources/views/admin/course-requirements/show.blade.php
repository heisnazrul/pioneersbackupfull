@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ $requirement->universityCourse?->title ?? 'Course requirement' }}</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-white/70">
                    {{ $requirement->universityCourse?->university?->name ?? '—' }}
                </p>
                <p class="text-xs text-gray-500 dark:text-white/60 mt-1">
                    Requirement: <span class="font-semibold">{{ $requirement->requirement_code }}</span>
                </p>
                @if ($requirementHelp)
                    <p class="text-xs text-gray-500 dark:text-white/60 mt-1">{{ $requirementHelp }}</p>
                @endif
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.course-requirements.edit', $requirement) }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Edit</a>
                <a href="{{ route('admin.course-requirements.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-secondary">Back to list</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="box">
                <div class="box-body space-y-3">
                    <h2 class="text-sm font-semibold text-gray-700 dark:text-white/80 uppercase">Summary</h2>
                    <dl class="space-y-2 text-sm text-gray-700 dark:text-white/80">
                        <div class="flex justify-between">
                            <dt>Value</dt>
                            <dd>{{ $requirement->value }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Mandatory</dt>
                            <dd>
                                @if ($requirement->is_mandatory)
                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-0.5 text-xs font-semibold text-red-700">Required</span>
                                @else
                                    <span class="inline-flex rounded-full bg-gray-100 px-3 py-0.5 text-xs text-gray-600 dark:bg-white/10 dark:text-white/70">Optional</span>
                                @endif
                            </dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Applicant Scope</dt>
                            <dd>{{ $requirement->applicant_scope ? ucfirst($requirement->applicant_scope) : 'All applicants' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Level Scope</dt>
                            <dd>{{ $requirement->level_scope ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Evidence Type</dt>
                            <dd>{{ $requirement->evidence_type ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Intake</dt>
                            <dd>{{ $requirement->intake?->label ?? $requirement->intake?->start_date?->format('d M Y') ?? 'All intakes' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="box">
                <div class="box-body space-y-3">
                    <h2 class="text-sm font-semibold text-gray-700 dark:text-white/80 uppercase">Meta</h2>
                    <dl class="space-y-2 text-sm text-gray-700 dark:text-white/80">
                        <div class="flex justify-between">
                            <dt>Source</dt>
                            <dd>{{ $requirement->source ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Work Experience Min (months)</dt>
                            <dd>{{ $requirement->min_work_experience_months ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Created</dt>
                            <dd>{{ $requirement->created_at?->format('d M Y H:i') ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Updated</dt>
                            <dd>{{ $requirement->updated_at?->format('d M Y H:i') ?? '—' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach ([
                'band_breakdown' => 'Band Breakdown',
                'comparators' => 'Comparators',
                'waiver_rules' => 'Waiver Rules',
                'prereq_subjects' => 'Prerequisite Subjects',
                'application_items' => 'Application Items',
            ] as $field => $label)
                <div class="box">
                    <div class="box-body">
                        <h2 class="text-sm font-semibold text-gray-700 dark:text-white/80 uppercase">{{ $label }}</h2>
                        <pre class="mt-3 whitespace-pre-wrap text-xs font-mono text-gray-700 dark:text-white/80 bg-gray-100 dark:bg-white/10 rounded-lg px-3 py-3">{{ $requirement->$field ? json_encode($requirement->$field, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '—' }}</pre>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="box">
            <div class="box-body">
                <h2 class="text-sm font-semibold text-gray-700 dark:text-white/80 uppercase">Notes</h2>
                <p class="mt-2 text-sm text-gray-700 dark:text-white/80 whitespace-pre-line">{{ $requirement->notes ?? 'No notes provided.' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
