{{-- resources/views/admin/pickups/edit.blade.php --}}
@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Edit Pickup</h2>
        <a href="{{ route('admin.pickups.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back to List</a>
    </div>

    @if ($errors->any())
        <div class="mb-4 text-red-700 bg-red-50 border border-red-200 rounded-md px-4 py-2">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pickups.update', $pickup) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="school_branch_id" class="block text-sm font-medium text-gray-700">Branch</label>
            <select name="school_branch_id" id="school_branch_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm" required>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" @selected(old('school_branch_id', $pickup->school_branch_id) == $branch->id)>
                        {{ optional($branch->school)->name }} — {{ $branch->slug }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="city_id" class="block text-sm font-medium text-gray-700">City</label>
            <select name="city_id" id="city_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm" required>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" @selected(old('city_id', $pickup->city_id) == $city->id)>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="fee" class="block text-sm font-medium text-gray-700">Fee (per transfer)</label>
            <input type="number" step="0.01" min="0" name="fee" id="fee" value="{{ old('fee', $pickup->fee) }}"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm" required>
        </div>

        <div>
            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
            <input type="text" name="note" id="note" value="{{ old('note', $pickup->note) }}"
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm">
        </div>

        <div class="flex space-x-2 mt-4">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Update</button>
            <a href="{{ route('admin.pickups.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">Cancel</a>
        </div>
    </form>
</div>
@endsection
