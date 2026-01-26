@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-6">
    <h2 class="text-2xl font-bold">Conversion Fees</h2>
  </div>

  @if(session('success'))
    <div class="mb-4 text-green-700 bg-green-50 border border-green-200 rounded-md px-4 py-2">
      {{ session('success') }}
    </div>
  @endif
  @if($errors->any())
    <div class="mb-4 text-red-700 bg-red-50 border border-red-200 rounded-md px-4 py-2">
      {{ $errors->first() }}
    </div>
  @endif

  <div class="bg-white rounded-lg shadow-md p-4 mb-6">
    <form method="POST" action="{{ route('admin.conversion.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700">Base Currency</label>
        <input type="text" name="base_currency" value="{{ old('base_currency') }}" class="mt-1 w-full border rounded-md px-3 py-2 uppercase" maxlength="3">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Target Currency</label>
        <input type="text" name="target_currency" value="{{ old('target_currency') }}" class="mt-1 w-full border rounded-md px-3 py-2 uppercase" maxlength="3">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Fee (%)</label>
        <input type="number" step="0.01" name="fee" value="{{ old('fee', 0) }}" class="mt-1 w-full border rounded-md px-3 py-2">
      </div>
      <div class="flex gap-2">
        <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Save</button>
        <a href="{{ route('admin.conversion.index') }}" class="ti-btn rounded-full border">Reset</a>
      </div>
    </form>
  </div>

  <div class="overflow-x-auto bg-white rounded-lg shadow-md">
    <table class="min-w-full">
      <thead>
        <tr class="border-b">
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Base</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Target</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Fee (%)</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($fees as $fee)
          <tr class="border-b">
            <td class="px-6 py-4 text-sm font-semibold">{{ $fee->base_currency }}</td>
            <td class="px-6 py-4 text-sm">{{ $fee->target_currency }}</td>
            <td class="px-6 py-4 text-sm">{{ $fee->fee }}</td>
            <td class="px-6 py-4 text-sm">
              <form method="POST" action="{{ route('admin.conversion.destroy', $fee->id) }}" onsubmit="return confirm('Delete this fee?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-6 py-4 text-sm text-gray-500">No conversion fees found.</td>
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
