@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Add Summer Camp Details</h2>
    <a href="{{ route('admin.summer-camp-details.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back to List</a>
  </div>

  @if ($errors->any())
    <div class="mb-6 text-red-700 bg-red-50 border border-red-200 rounded-md px-4 py-3">
      <ul class="list-disc pl-5 text-sm space-y-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if ($camps->isEmpty())
    <div class="bg-blue-50 border border-blue-200 rounded-md px-4 py-5 text-sm text-blue-800">
      All summer camps already have detail pages. Edit an existing record or create a new camp first.
    </div>
  @else
    <form action="{{ route('admin.summer-camp-details.store') }}" method="POST" class="space-y-8">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700">Summer Camp</label>
        <select name="camp_id" class="mt-1 block w-full border rounded-md px-3 py-2" required>
          <option value="">-- Select Camp --</option>
          @foreach($camps as $camp)
            <option value="{{ $camp->id }}" @selected(old('camp_id') == $camp->id)>
              {{ $camp->name }} ({{ optional($camp->branch)->slug ?? 'No branch' }})
            </option>
          @endforeach
        </select>
      </div>

      @php
        $sections = [
          ['key' => 'overview', 'label' => 'Overview'],
          ['key' => 'academics', 'label' => 'Academics'],
          ['key' => 'activities', 'label' => 'Activities'],
          ['key' => 'accommodation', 'label' => 'Accommodation'],
          ['key' => 'safeguarding', 'label' => 'Safeguarding'],
        ];
      @endphp

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($sections as $section)
          <div>
            <label class="block text-sm font-medium text-gray-700">{{ $section['label'] }} (EN)</label>
            <input type="hidden" id="{{ $section['key'] }}" name="{{ $section['key'] }}" value="{{ old($section['key']) }}">
            <trix-editor input="{{ $section['key'] }}" class="trix-content border rounded-md mt-1"></trix-editor>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">{{ $section['label'] }} (AR)</label>
            @php($arKey = 'ar_'.$section['key'])
            <input type="hidden" id="{{ $arKey }}" name="{{ $arKey }}" value="{{ old($arKey) }}">
            <trix-editor input="{{ $arKey }}" class="trix-content border rounded-md mt-1"></trix-editor>
          </div>
        @endforeach
      </div>

      <div class="flex space-x-2">
        <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Save Details</button>
        <a href="{{ route('admin.summer-camp-details.index') }}" class="ti-btn rounded-full border">Cancel</a>
      </div>
    </form>
  @endif
</div>
@endsection

@push('styles')
    @once
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@2.0.0/dist/trix.min.css">
    @endonce
@endpush

@push('scripts')
    @once
        <script src="https://cdn.jsdelivr.net/npm/trix@2.0.0/dist/trix.umd.min.js"></script>
    @endonce
@endpush
