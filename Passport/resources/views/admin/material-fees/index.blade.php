{{-- resources/views/admin/material-fees/index.blade.php --}}
@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Material Fees</h2>
        <a href="{{ route('admin.material-fees.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Add Material Fee
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
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Course</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">School / Branch</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">City</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Fee</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fees as $fee)
                <tr class="border-b">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $fee->course->name }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        {{ $fee->course->branch->school->name ?? '—' }} — {{ $fee->course->branch->name ?? 'Branch' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        {{ $fee->course->branch->city->name ?? '—' }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        ${{ number_format($fee->fee, 2) }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <a href="{{ route('admin.material-fees.edit', $fee) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.material-fees.destroy', $fee) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this material fee?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 ml-4">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-sm text-gray-500">No material fees found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $fees->links() }}
        </div>
    </div>
</div>
@endsection
