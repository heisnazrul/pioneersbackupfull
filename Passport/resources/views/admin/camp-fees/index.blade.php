@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Camp Fees</h2>
        <a href="{{ route('admin.camp-fees.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Create Camp Fee
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="border-b">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Camp</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Branch</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Enrollment Fee</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Weekly Fees</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($campFees as $campFee)
                <tr class="border-b">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $campFee->camp->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @php
                            $branch = $campFee->camp->branch ?? null;
                        @endphp
                        {{ $branch ? ($branch->school->name ?? 'Unnamed School') . ' - ' . ($branch->city->name ?? 'Unknown City') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        {{ $campFee->enrollment_fee !== null ? number_format($campFee->enrollment_fee, 2) : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @php
                            $weekly = collect(range(1, 8))
                                ->map(function ($week) use ($campFee) {
                                    $value = $campFee->{'week_'.$week.'_fee'};
                                    return $value !== null ? 'Week '.$week.': '.number_format($value, 2) : null;
                                })
                                ->filter()
                                ->values();
                        @endphp
                        {{ $weekly->isNotEmpty() ? $weekly->implode(' | ') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.camp-fees.edit', $campFee) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.camp-fees.destroy', $campFee) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500">No camp fees found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $campFees->links() }}
        </div>
    </div>
</div>
@endsection
