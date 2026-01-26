@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Reviews</h2>
    <a href="{{ route('admin.reviews.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Add Review</a>
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
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Name</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Institute</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Rating</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Video</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Approved</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($reviews as $r)
        <tr class="border-b">
          <td class="px-6 py-4 text-sm font-medium text-gray-900">
            <div class="flex items-center space-x-3">
              @if($r->photo)
                <img src="{{ asset('storage/'.$r->photo) }}" class="w-8 h-8 rounded-full object-cover" alt="">
              @endif
              <div>
                <div>{{ $r->name }}</div>
                @if($r->title)
                  <div class="text-xs text-gray-500">{{ $r->title }}</div>
                @endif
              </div>
            </div>
          </td>
          <td class="px-6 py-4 text-sm">{{ $r->institute_name ?: '—' }}</td>
          <td class="px-6 py-4 text-sm">{{ $r->rating }}/5</td>
          <td class="px-6 py-4 text-sm">
            @if($r->video)
              <a href="{{ $r->video }}" target="_blank" class="text-blue-600 hover:text-blue-800">View</a>
            @else
              —
            @endif
          </td>
          <td class="px-6 py-4 text-sm">{{ $r->is_approved ? 'Yes' : 'No' }}</td>
          <td class="px-6 py-4 text-sm">
            <a href="{{ route('admin.reviews.edit', $r) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
            <form action="{{ route('admin.reviews.destroy', $r) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this review?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800 ml-4">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="px-6 py-4 text-sm text-gray-500">No reviews found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    <div class="px-6 py-4">
      {{ $reviews->links() }}
    </div>
  </div>
</div>
@endsection
