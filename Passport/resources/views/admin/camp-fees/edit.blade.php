@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Edit Camp Fee</h2>
        <a href="{{ route('admin.camp-fees.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Camp Fees
        </a>
    </div>

    <form action="{{ route('admin.camp-fees.update', $campFee) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="camp_id" class="block text-sm font-medium text-gray-700">Camp</label>
            <select name="camp_id" id="camp_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @foreach ($camps as $camp)
                    <option value="{{ $camp->id }}" {{ (int) old('camp_id', $campFee->camp_id) === $camp->id ? 'selected' : '' }}>
                        {{ $camp->name }} — {{ $camp->branch->school->name ?? 'Unknown School' }} ({{ $camp->branch->city->name ?? 'Unknown City' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @for ($week = 1; $week <= 8; $week++)
                @php
                    $field = 'week_'.$week.'_fee';
                @endphp
                <div>
                    <label for="week_{{ $week }}_fee" class="block text-sm font-medium text-gray-700">Week {{ $week }} Fee</label>
                    <input type="number" step="0.01" min="0" name="week_{{ $week }}_fee" id="week_{{ $week }}_fee" value="{{ old($field, $campFee->$field) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            @endfor
            <div>
                <label for="enrollment_fee" class="block text-sm font-medium text-gray-700">Enrollment Fee</label>
                <input type="number" step="0.01" min="0" name="enrollment_fee" id="enrollment_fee" value="{{ old('enrollment_fee', $campFee->enrollment_fee) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="flex space-x-2 mt-6">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                Update Camp Fee
            </button>
            <a href="{{ route('admin.camp-fees.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
