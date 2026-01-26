@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex items-center justify-between py-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Referral Students</h1>
            <p class="text-sm text-gray-600 dark:text-white/70">Track students onboarded through agent referral links.</p>
        </div>
        <a href="{{ route('admin.referrals.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Referral Settings</a>
    </div>

    <div class="box">
        <div class="box-body p-0 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-white/10">
                <thead class="bg-gray-50 dark:bg-white/5">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Agent</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Country</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Invited</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-white/5 divide-y divide-gray-200 dark:divide-white/10">
                    @forelse($referrals as $student)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                <div class="font-medium">{{ $student->name }}</div>
                                <div class="text-xs text-gray-500 dark:text-white/60">{{ $student->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                <div>{{ $student->agent?->user?->name ?? '—' }}</div>
                                <div class="text-xs text-gray-500 dark:text-white/60">{{ $student->agent?->referral_code ? 'Code: '.$student->agent->referral_code : 'No code' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 dark:text-white/70">{{ $student->country ?? '—' }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($student->onboarded_at)
                                    <span class="inline-flex rounded-full bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-700">Onboarded</span>
                                @else
                                    <span class="inline-flex rounded-full bg-amber-50 px-2 py-1 text-xs font-semibold text-amber-700">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-white/60">{{ $student->created_at->format('d M, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No referral students yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">
            {{ $referrals->links() }}
        </div>
    </div>
</div>
@endsection
