@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <div>
            <h2 class="text-2xl font-bold mb-2">Coupons</h2>
            <p class="text-sm text-gray-500">Create and manage discount codes for campaigns.</p>
        </div>
        <a href="{{ route('admin.coupons.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            New Coupon
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
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Code</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Discount</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Usage</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Expires</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($coupons as $coupon)
                <tr class="border-b">
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $coupon->code }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $coupon->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">
                        @if($coupon->discount_type === 'percent')
                            {{ number_format($coupon->discount_value, 2) }}%
                        @else
                            {{ number_format($coupon->discount_value, 2) }}
                        @endif
                        <span class="text-xs text-gray-500">({{ ucfirst($coupon->discount_type) }})</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800">
                        {{ $coupon->used_count }} / {{ $coupon->usage_limit }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800">
                        {{ $coupon->expiration_date ? $coupon->expiration_date->format('Y-m-d') : 'No expiry' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @php
                            $statusClasses = $coupon->is_active
                                ? 'bg-green-100 text-green-700 border border-green-200'
                                : 'bg-gray-100 text-gray-600 border border-gray-200';
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs {{ $statusClasses }}">{{ $coupon->is_active ? 'Active' : 'Inactive' }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this coupon?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 ml-4">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-sm text-gray-500">No coupons found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $coupons->links() }}
        </div>
    </div>
</div>
@endsection
