@extends('school.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-body p-8">
                    <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">
                        Welcome back, {{ auth()->user()?->name ?? 'School Partner' }}
                    </h1>
                    <p class="text-gray-600 dark:text-white/70 text-base leading-relaxed max-w-3xl">
                        Stay across enrollment requests, upcoming intakes, and the resources you share with students and counselors. We’ll surface important notifications and quick actions as soon as they need your attention.
                    </p>
                    <div class="mt-8 inline-flex items-center gap-3 rounded-xl bg-primary/10 text-primary px-5 py-3 text-sm font-medium">
                        <i class="ri-sparkling-line text-lg"></i>
                        <span>Need help? Contact your partnership manager or email support@pioneerscourse.com.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
