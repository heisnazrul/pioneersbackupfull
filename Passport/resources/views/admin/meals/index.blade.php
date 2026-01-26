@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Meals</h2>
    <a href="{{ route('admin.meals.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Add Meal</a>
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
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Name (EN)</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Name (AR)</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Description</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Description (AR)</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($meals as $meal)
        <tr class="border-b">
          <td class="px-6 py-4 text-sm">{{ $meal->name }}</td>
          <td class="px-6 py-4 text-sm">{{ $meal->ar_name }}</td>
          <td class="px-6 py-4 text-sm">{{ $meal->description }}</td>
          <td class="px-6 py-4 text-sm">{{ $meal->ar_description }}</td>
          <td class="px-6 py-4 text-sm">
            <a href="{{ route('admin.meals.edit', $meal) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
            <form action="{{ route('admin.meals.destroy', $meal) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this meal?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800 ml-4">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="px-6 py-4 text-sm text-gray-500">No meals found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    <div class="px-6 py-4">
      {{ $meals->links() }}
    </div>
  </div>
</div>
@endsection
