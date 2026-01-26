@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Summer Camps</h2>
        <a href="{{ route('admin.summer-camps.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Create Summer Camp
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="border-b">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Thumbnail</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Branch</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Course Type</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Schedule</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($summerCamps as $summerCamp)
                <tr class="border-b">
                    <td class="px-6 py-4 text-sm">
                        @if ($summerCamp->thumbnail)
                            <img src="{{ asset('storage/'.$summerCamp->thumbnail) }}" alt="{{ $summerCamp->name }} thumbnail" class="h-12 w-12 object-cover rounded-md border">
                        @else
                            <span class="text-gray-400 text-xs uppercase tracking-wide">No Image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $summerCamp->name }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if ($summerCamp->branch)
                            {{ $summerCamp->branch->school->name ?? 'N/A' }} - {{ $summerCamp->branch->city->name ?? 'N/A' }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $summerCamp->courseType->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm">
                        @php
                            $parts = array_filter([
                                $summerCamp->start_date,
                                $summerCamp->course_period,
                                $summerCamp->payment_deadline ? 'Pay by '.$summerCamp->payment_deadline : null,
                            ]);
                        @endphp
                        {{ $parts ? implode(' • ', $parts) : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.summer-camps.edit', $summerCamp) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.summer-camps.destroy', $summerCamp) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-sm text-center text-gray-500">No summer camps found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $summerCamps->links() }}
        </div>
    </div>
</div>
@endsection
