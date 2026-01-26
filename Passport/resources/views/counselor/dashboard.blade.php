@extends('counselor.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-body p-8">
                    <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">
                        Welcome back, {{ auth()->user()?->name ?? 'Counselor' }}
                    </h1>
                    <p class="text-gray-600 dark:text-white/70 text-base leading-relaxed max-w-3xl">
                        Review student cases, surface next actions, and track the outcomes you’re guiding. We’ve gathered the briefings, intake notes, and quick links you’ll reach for the most.
                    </p>
                    <div class="mt-8 inline-flex items-center gap-3 rounded-xl bg-primary/10 text-primary px-5 py-3 text-sm font-medium">
                        <i class="ri-sparkling-line text-lg"></i>
                        <span>Need a hand? Drop a note to the counseling lead or email support@pioneerscourse.com.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
