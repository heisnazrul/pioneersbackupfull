@extends('agent.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex flex-col gap-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Your Students</h1>
                <p class="text-sm text-gray-600 dark:text-white/70">Track who joined using your referral code.</p>
            </div>
            <a href="{{ route('agent.students.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Add Student</a>
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
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">Joined</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-white/5 divide-y divide-gray-200 dark:divide-white/10">
                        @forelse ($students as $info)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $info->user?->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">{{ $info->user?->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ ($info->user?->status === 'active') ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($info->user?->status ?? 'unknown') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">{{ optional($info->user?->created_at)->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-white/60">No students yet. Share your referral link to get started.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
