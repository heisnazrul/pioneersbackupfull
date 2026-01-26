@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10 max-w-3xl">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold">Edit Agent</h2>
    <a href="{{ route('admin.agents.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back</a>
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

  <form action="{{ route('admin.agents.update', $agent) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
      <label class="block text-sm font-medium text-gray-700">Company Name</label>
      <input type="text" name="company_name" value="{{ old('company_name', $agent->company_name) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Phone</label>
      <input type="text" name="phone" value="{{ old('phone', $agent->phone) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Status</label>
      <select name="status" class="mt-1 block w-full border rounded-md px-3 py-2">
        @foreach(['pending','approved','rejected'] as $status)
          <option value="{{ $status }}" @selected(old('status', $agent->status) === $status)>{{ ucfirst($status) }}</option>
        @endforeach
      </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Referral Code</label>
        <input type="text" name="referral_code" value="{{ old('referral_code', $agent->referral_code) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
        <p class="text-xs text-gray-500 mt-1">Leave blank to remove or regenerate later.</p>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Student Discount (%)</label>
        <input type="number" step="0.01" name="referral_discount" value="{{ old('referral_discount', $agent->referral_discount) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Agent Commission (%)</label>
        <input type="number" step="0.01" name="commission_percent" value="{{ old('commission_percent', $agent->commission_percent) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
    </div>
    

    <div class="flex space-x-2">
      <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Save</button>
      <a href="{{ route('admin.agents.index') }}" class="ti-btn rounded-full border">Cancel</a>
    </div>
  </form>

  <form action="{{ route('admin.agents.approve', $agent) }}" method="POST" class="mt-4">
    @csrf
    <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Approve Agent</button>
  </form>
</div>
@endsection
