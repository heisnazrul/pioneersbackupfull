@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-6">
    <h2 class="text-2xl font-bold">Exchange Rates</h2>
    <form method="POST" action="{{ route('admin.get-gbp-all-rates') }}">
      @csrf
      <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
        Fetch GBP Rates
      </button>
    </form>
  </div>

  @if(session('success'))
    <div class="mb-4 text-green-700 bg-green-50 border border-green-200 rounded-md px-4 py-2">
      {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="mb-4 text-red-700 bg-red-50 border border-red-200 rounded-md px-4 py-2">
      {{ session('error') }}
    </div>
  @endif

  <div class="overflow-x-auto bg-white rounded-lg shadow-md">
    <table class="min-w-full">
      <thead>
        <tr class="border-b">
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Base</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Target</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Rate</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Updated</th>
        </tr>
      </thead>
      <tbody>
        @forelse($rates as $rate)
          <tr class="border-b">
            <td class="px-6 py-4 text-sm font-semibold">{{ $rate->base_currency }}</td>
            <td class="px-6 py-4 text-sm">{{ $rate->target_currency }}</td>
            <td class="px-6 py-4 text-sm">{{ $rate->rate }}</td>
            <td class="px-6 py-4 text-sm">{{ $rate->updated_at }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-6 py-4 text-sm text-gray-500">No rates found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="px-6 py-4">
      {{ $rates->links() }}
    </div>
  </div>
</div>
@endsection
