@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <div>
            <h2 class="text-2xl font-bold mb-2">Discounts</h2>
            <p class="text-sm text-gray-500">Manage percentage discounts and scope rules.</p>
        </div>
        <a href="{{ route('admin.discounts.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            New Discount
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-50 border border-green-200 rounded-md px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="border-b">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Percent</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Scope</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Dates</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($discounts as $discount)
                <tr class="border-b">
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                        <div class="flex flex-col">
                            <span>{{ $discount->name }}</span>
                            <span class="text-xs text-gray-500">{{ $discount->ar_name ?: '—' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800">
                        {{ number_format($discount->discount_percentage, 2) }}%
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800">
                        <div class="flex flex-col gap-1">
                            <span>Branches: {{ $discount->applies_to_all_branches ? 'All' : ($discount->school_branch_ids ? implode(',', $discount->school_branch_ids) : 'None') }}</span>
                            <span>Countries: {{ $discount->applies_to_all_countries ? 'All' : ($discount->country_ids ? implode(',', $discount->country_ids) : 'None') }}</span>
                            <span>User country: {{ $discount->applies_to_user_country ? 'Yes' : 'No' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800">
                        {{ $discount->start_date ? $discount->start_date->format('Y-m-d') : '—' }} →
                        {{ $discount->end_date ? $discount->end_date->format('Y-m-d') : '—' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @php
                            $statusClasses = $discount->is_active
                                ? 'bg-green-100 text-green-700 border border-green-200'
                                : 'bg-gray-100 text-gray-600 border border-gray-200';
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs {{ $statusClasses }}">{{ $discount->is_active ? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.discounts.edit', $discount) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this discount?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 ml-4">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-sm text-gray-500">No discounts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $discounts->links() }}
        </div>
    </div>
</div>
@endsection
