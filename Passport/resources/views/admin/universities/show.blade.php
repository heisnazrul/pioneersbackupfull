@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $university->name }}</h1>
                <p class="text-sm text-gray-600 dark:text-white/70">{{ $university->country?->name }} · {{ ucfirst($university->status) }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.universities.edit', $university) }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Edit</a>
                <a href="{{ route('admin.universities.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div class="box">
                    <div class="box-header"><h2 class="box-title">Overview</h2></div>
                    <div class="box-body space-y-3 text-sm text-gray-700 dark:text-white/80">
                        <div><span class="font-medium">Website:</span> @if ($university->website)<a href="{{ $university->website }}" target="_blank" class="text-primary hover:underline">{{ $university->website }}</a>@else <span class="text-gray-400">N/A</span>@endif</div>
                        <div><span class="font-medium">Admissions Email:</span> {{ $university->email_admissions ?? 'N/A' }}</div>
                        <div><span class="font-medium">Admissions Phone:</span> {{ $university->phone_admissions ?? 'N/A' }}</div>
                        <div><span class="font-medium">Founded:</span> {{ $university->founded_year ?? 'N/A' }}</div>
                        <div><span class="font-medium">Institution Type:</span> {{ $university->public_private ? ucfirst($university->public_private) : 'N/A' }}</div>
                        <div><span class="font-medium">AKA Names:</span> {{ $university->aka_names ? implode(', ', $university->aka_names) : 'N/A' }}</div>
                        <div><span class="font-medium">Research Flags:</span> {{ $university->research_flags ? implode(', ', $university->research_flags) : 'N/A' }}</div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header"><h2 class="box-title">Scholarship Overview</h2></div>
                    <div class="box-body text-sm text-gray-700 dark:text-white/80">
                        {!! nl2br(e($university->scholarship_overview ?? 'No information provided.')) !!}
                    </div>
                </div>
                <div class="box">
                    <div class="box-header"><h2 class="box-title">Notes</h2></div>
                    <div class="box-body text-sm text-gray-700 dark:text-white/80">
                        {!! nl2br(e($university->notes ?? 'No notes recorded.')) !!}
                    </div>
                </div>
            </div>
            <div class="space-y-6">
                <div class="box">
                    <div class="box-header"><h2 class="box-title">Branding</h2></div>
                    <div class="box-body space-y-3 text-sm text-gray-700 dark:text-white/80">
                        <div><span class="font-medium">Logo Path:</span> {{ $university->branding['logo_path'] ?? 'N/A' }}</div>
                        <div><span class="font-medium">Brand Colors:</span> {{ isset($university->branding['brand_colors']) ? implode(', ', $university->branding['brand_colors']) : 'N/A' }}</div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header"><h2 class="box-title">Rankings</h2></div>
                    <div class="box-body space-y-3 text-sm text-gray-700 dark:text-white/80">
                        <div><span class="font-medium">QS:</span> {{ $university->rankings['qs'] ?? 'N/A' }}</div>
                        <div><span class="font-medium">Times:</span> {{ $university->rankings['times'] ?? 'N/A' }}</div>
                        <div><span class="font-medium">Subject Ranks:</span> {{ isset($university->rankings['subject_ranks']) ? implode(', ', $university->rankings['subject_ranks']) : 'N/A' }}</div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header"><h2 class="box-title">Meta</h2></div>
                    <div class="box-body space-y-2 text-xs text-gray-500 dark:text-white/60">
                        <div>Created: {{ $university->created_at->format('M d, Y H:i') }}</div>
                        <div>Updated: {{ $university->updated_at->format('M d, Y H:i') }}</div>
                        @if($university->deleted_at)
                            <div class="text-red-500">Archived: {{ $university->deleted_at->format('M d, Y H:i') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
