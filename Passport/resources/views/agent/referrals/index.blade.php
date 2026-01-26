@extends('agent.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex flex-col gap-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Referrals</h1>
            <p class="text-sm text-gray-600 dark:text-white/70">Share your code or link and track the students who joined through you.</p>
        </div>

        @if ($agent && $agent->referral_joined_at)
            <div class="grid gap-4 lg:grid-cols-3">
                <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 p-6">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Referral Code</h2>
                    <div class="mt-3 flex items-center gap-3">
                        <span class="text-2xl font-mono tracking-wide text-primary">{{ $agent->referral_code }}</span>
                        <button type="button" class="ti-btn ti-btn-outline ti-btn-outline-primary rounded-full text-xs" data-copy-value="{{ $agent->referral_code }}">Copy</button>
                    </div>
                    <p class="mt-3 text-xs text-gray-500 dark:text-white/50">Share this code during registration.</p>
                </div>

                <div class="rounded-2xl border border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 p-6 lg:col-span-2">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Referral Link</h2>
                    <div class="mt-3 flex flex-col sm:flex-row sm:items-center gap-3">
                        <span class="text-sm text-gray-700 dark:text-white/80 break-all flex-1">{{ $agent->referralLink() }}</span>
                        <button type="button" class="ti-btn ti-btn-outline ti-btn-outline-primary rounded-full text-xs" data-copy-value="{{ $agent->referralLink() }}">Copy Link</button>
                    </div>
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-gray-500 dark:text-white/60">
                        <div class="rounded-lg border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/10 p-3">
                            <p class="font-semibold text-gray-700 dark:text-white/80">Discount</p>
                            <p class="mt-1 text-base text-primary font-semibold">{{ number_format($agent->referral_discount, 2) }}%</p>
                        </div>
                        <div class="rounded-lg border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/10 p-3">
                            <p class="font-semibold text-gray-700 dark:text-white/80">Commission</p>
                            <p class="mt-1 text-base text-primary font-semibold">{{ number_format($agent->commission_percent, 2) }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="rounded-2xl border border-dashed border-primary/40 bg-primary/5 p-6">
                <p class="text-sm text-gray-600 dark:text-white/70">You haven’t joined the referral program yet. Activate it to receive your tracking link and share discounts with students.</p>
                <form action="{{ route('agent.referrals.join') }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Join Referral Program</button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-copy-value]').forEach(function (button) {
            button.addEventListener('click', function () {
                const value = button.getAttribute('data-copy-value');
                if (! value) return;
                navigator.clipboard.writeText(value).then(function () {
                    const original = button.textContent;
                    button.textContent = 'Copied!';
                    setTimeout(function () {
                        button.textContent = original;
                    }, 1500);
                });
            });
        });
    });
</script>
@endpush
