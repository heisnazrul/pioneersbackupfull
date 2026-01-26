@extends('agent.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-body p-8 space-y-8">
                    <div>
                        <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-3">
                            Welcome back, {{ optional($agent?->user)->name ?? 'Agent' }}
                        </h1>
                        <p class="text-gray-600 dark:text-white/70 text-base leading-relaxed max-w-3xl">
                            Your dashboard is the launchpad for campaigns, partner updates, and resources. We’re thrilled to have you representing Course English around the world. Keep an eye on notifications for new opportunities shared by the HQ team.
                        </p>
                        <div class="mt-6 inline-flex items-center gap-3 rounded-xl bg-primary/10 text-primary px-5 py-3 text-sm font-medium">
                            <i class="ri-sparkling-line text-lg"></i>
                            <span>Need help? Reach out to your partnerships manager or email support@pioneerscourse.com.</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="rounded-2xl border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 p-4">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-white/60">Total Students</p>
                            <p class="mt-2 text-3xl font-semibold text-gray-800 dark:text-white">{{ number_format($metrics['students']) }}</p>
                        </div>
                        <div class="rounded-2xl border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 p-4">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-white/60">Pending Onboarding</p>
                            <p class="mt-2 text-3xl font-semibold text-amber-500">{{ number_format($metrics['pending']) }}</p>
                        </div>
                        <div class="rounded-2xl border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 p-4">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-white/60">Active Students</p>
                            <p class="mt-2 text-3xl font-semibold text-emerald-500">{{ number_format($metrics['active']) }}</p>
                        </div>
                        <div class="rounded-2xl border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 p-4">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-white/60">Referral Discount</p>
                            <p class="mt-2 text-3xl font-semibold text-primary">{{ number_format($metrics['referralDiscount'], 1) }}%</p>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-dashed border-primary/40 bg-primary/5 p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Grow your network</h2>
                            <p class="text-sm text-gray-600 dark:text-white/70">Share your referral tools to bring students onboard. View detailed stats in the referrals section.</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('agent.referrals.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Referrals</a>
                            <a href="{{ route('agent.students.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">My Students</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
