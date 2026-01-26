@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Add Preferred School</h2>
    <a href="{{ route('admin.preferred-schools.index') }}" class="ti-btn rounded-full border">Back</a>
  </div>

  <div class="bg-white rounded-lg shadow-md p-6">
    <form method="POST" action="{{ route('admin.preferred-schools.store') }}" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700">School</label>
        <select name="school_id" class="mt-1 block w-full border rounded-md px-3 py-2">
          @foreach($schools as $school)
            <option value="{{ $school->id }}">{{ $school->name }}</option>
          @endforeach
        </select>
      </div>
      <label class="flex items-center gap-2 text-sm font-medium text-gray-700">
        <input type="checkbox" name="active" value="1" class="rounded border-gray-300 text-primary focus:ring-primary" checked>
        Active
      </label>
      <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Save</button>
    </form>
  </div>
</div>
@endsection
