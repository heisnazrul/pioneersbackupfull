@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Preferred Schools</h2>
  </div>

  @if(session('success'))
    <div class="mb-4 text-green-700 bg-green-50 border border-green-200 rounded-md px-4 py-2">
      {{ session('success') }}
    </div>
  @endif

  <div class="bg-white rounded-lg shadow-md p-4 mb-6">
    <form method="GET" action="{{ route('admin.preferred-schools.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Country</label>
        <select name="country_id" class="mt-1 block w-full border rounded-md px-3 py-2">
          <option value="">All</option>
          @foreach($countries as $country)
            <option value="{{ $country->id }}" @selected(($filters['country_id'] ?? null)==$country->id)>{{ $country->name }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">City</label>
        <select name="city_id" class="mt-1 block w-full border rounded-md px-3 py-2">
          <option value="">All</option>
          @foreach($cities as $city)
            <option value="{{ $city->id }}" @selected(($filters['city_id'] ?? null)==$city->id)>{{ $city->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="md:col-span-3 flex items-end gap-2">
        <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Filter</button>
        <a href="{{ route('admin.preferred-schools.index') }}" class="ti-btn rounded-full border">Reset</a>
      </div>
    </form>
  </div>

  <div class="bg-white rounded-lg shadow-md p-4">
    <form method="POST" action="{{ route('admin.preferred-schools.bulk-update') }}">
      @csrf
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Select preferred schools</h3>
        <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Save Selection</button>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
          <thead>
            <tr class="border-b">
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Pick</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">School</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Location</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse($schools as $school)
              @php
                $branch = $school->branches->first();
                $city = $branch->city ?? null;
                $country = $city?->country;
                $isPreferred = $preferredMap[$school->id] ?? false;
              @endphp
              <tr class="border-b">
                <td class="px-6 py-4 text-sm">
                  <input type="checkbox" name="selected_schools[]" value="{{ $school->id }}" class="rounded border-gray-300 text-primary focus:ring-primary" {{ $isPreferred ? 'checked' : '' }}>
                </td>
                <td class="px-6 py-4 text-sm font-semibold">{{ $school->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">
                  {{ trim(($city->name ?? '') . ', ' . ($country->name ?? '')) ?: '—' }}
                </td>
                <td class="px-6 py-4 text-sm">
                  <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $isPreferred ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $isPreferred ? 'Preferred' : 'Not Preferred' }}
                  </span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="px-6 py-4 text-sm text-gray-500">No schools found for this filter.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-4 flex justify-end">
        <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Save Selection</button>
      </div>
    </form>
  </div>
</div>
@endsection
