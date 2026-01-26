@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex flex-col gap-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Agent Referral Settings</h1>
                <p class="text-sm text-gray-600 dark:text-white/70">Manage referral codes, discounts, and commissions for each agent.</p>
            </div>
            <a href="{{ route('admin.referrals.students') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Referral Students</a>
        </div>

        @if (session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="box">
            <div class="box-body p-0 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-white/10">
                    <thead class="bg-gray-50 dark:bg-white/5">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Agent</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Referral Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Discount %</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Commission %</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-white/5 divide-y divide-gray-200 dark:divide-white/10">
                        @forelse ($agents as $agent)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                    <div class="font-medium">{{ $agent->user?->name ?? 'Unknown' }}</div>
                                    <div class="text-xs text-gray-500 dark:text-white/60">{{ $agent->user?->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm font-mono text-primary">{{ $agent->referral_code ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-white/70">
                                    {{ $agent->referral_discount !== null ? number_format($agent->referral_discount, 2).'%' : '—' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-white/70">
                                    {{ $agent->commission_percent !== null ? number_format($agent->commission_percent, 2).'%' : '—' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700 dark:text-white/70">{{ $agent->status ? ucfirst($agent->status) : '—' }}</td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <a href="{{ route('admin.referrals.edit', $agent) }}" class="ti-btn ti-btn-outline ti-btn-outline-primary rounded-full text-xs">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-white/60">No agents found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">
                {{ $agents->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
