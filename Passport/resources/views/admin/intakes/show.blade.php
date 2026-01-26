@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">{{ $intake->label ?? 'Intake '.$intake->start_date?->format('M Y') }}</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-white/70">
                    {{ $intake->universityCourse?->title ?? 'No course linked' }}
                    @if ($intake->universityCourse?->university)
                        <span class="text-xs text-gray-500 dark:text-white/60 block">University: {{ $intake->universityCourse->university->name }}</span>
                    @endif
                </p>
                <p class="text-xs text-gray-500 dark:text-white/60">Status: {{ ucfirst(str_replace('_', ' ', $intake->status)) }}</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.intakes.edit', $intake) }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Edit Intake</a>
                <a href="{{ route('admin.intakes.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-secondary">Back to list</a>
            </div>
        </div>

        <div class="box">
            <div class="box-body grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <h2 class="text-sm font-semibold text-gray-700 dark:text-white/80 uppercase">Key Dates</h2>
                    <dl class="mt-3 space-y-2 text-sm text-gray-700 dark:text-white/80">
                        <div class="flex justify-between">
                            <dt>Start Date</dt>
                            <dd>{{ $intake->start_date?->format('d M Y') ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Application Deadline</dt>
                            <dd>{{ $intake->application_deadline?->format('d M Y') ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Scholarship Deadline</dt>
                            <dd>{{ $intake->scholarship_deadline?->format('d M Y') ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Orientation Date</dt>
                            <dd>{{ $intake->orientation_date?->format('d M Y') ?? '—' }}</dd>
                        </div>
                    </dl>
                </div>
                <div>
                    <h2 class="text-sm font-semibold text-gray-700 dark:text-white/80 uppercase">Capacity & Duration</h2>
                    <dl class="mt-3 space-y-2 text-sm text-gray-700 dark:text-white/80">
                        <div class="flex justify-between">
                            <dt>Capacity</dt>
                            <dd>{{ $intake->capacity ?? '—' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Teaching Period</dt>
                            <dd>
                                @if ($intake->teaching_period_weeks)
                                    {{ $intake->teaching_period_weeks }} weeks
                                @else
                                    —
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-body space-y-4">
                <h2 class="text-sm font-semibold text-gray-700 dark:text-white/80 uppercase">Financial Overrides</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 dark:text-white/80">
                    <div class="rounded-lg border border-gray-200 dark:border-white/10 p-4">
                        <div class="text-xs uppercase text-gray-500 dark:text-white/60">Tuition Override</div>
                        <div class="mt-2 text-lg font-semibold">
                            @if ($intake->tuition_fee_override)
                                {{ number_format($intake->tuition_fee_override, 2) }} {{ $intake->currency_override ?? '' }}
                            @else
                                <span class="text-gray-400 dark:text-white/50">Default pricing</span>
                            @endif
                        </div>
                    </div>
                    <div class="rounded-lg border border-gray-200 dark:border-white/10 p-4">
                        <div class="text-xs uppercase text-gray-500 dark:text-white/60">Deposit Amount</div>
                        <div class="mt-2 text-lg font-semibold">
                            @if ($intake->deposit_amount)
                                {{ number_format($intake->deposit_amount, 2) }} {{ $intake->currency_override ?? '' }}
                            @else
                                <span class="text-gray-400 dark:text-white/50">Not set</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-body">
                <h2 class="text-sm font-semibold text-gray-700 dark:text-white/80 uppercase">Notes</h2>
                <p class="mt-2 text-sm text-gray-700 dark:text-white/80 whitespace-pre-line">{{ $intake->notes ?? 'No notes recorded for this intake.' }}</p>
            </div>
        </div>

        <div class="text-xs text-gray-500 dark:text-white/50">
            <div>Created: {{ $intake->created_at?->format('d M Y H:i') ?? 'n/a' }}</div>
            <div>Last updated: {{ $intake->updated_at?->format('d M Y H:i') ?? 'n/a' }}</div>
        </div>
    </div>
</div>
@endsection
