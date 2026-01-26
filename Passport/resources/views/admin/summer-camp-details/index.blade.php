@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Summer Camp Details</h2>
    <a href="{{ route('admin.summer-camp-details.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
      Add Camp Details
    </a>
  </div>

  <div class="overflow-x-auto bg-white rounded-lg shadow-md">
    <table class="min-w-full bg-white">
      <thead>
        <tr class="border-b">
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Camp</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Branch</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Overview</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Updated</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($campDetails as $detail)
          <tr class="border-b">
            <td class="px-6 py-4 text-sm font-medium text-gray-900">
              {{ $detail->camp->name ?? '—' }}
            </td>
            <td class="px-6 py-4 text-sm">
              @if($detail->camp && $detail->camp->branch)
                {{ $detail->camp->branch->school->name ?? 'N/A' }} • {{ $detail->camp->branch->slug }}
              @else
                —
              @endif
            </td>
            <td class="px-6 py-4 text-sm text-gray-600">
              {{ \Illuminate\Support\Str::limit(strip_tags($detail->overview ?? ''), 80) ?: '—' }}
            </td>
            <td class="px-6 py-4 text-sm text-gray-500">
              {{ $detail->updated_at->diffForHumans() }}
            </td>
            <td class="px-6 py-4 text-sm">
              <a href="{{ route('admin.summer-camp-details.edit', $detail) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
              <form action="{{ route('admin.summer-camp-details.destroy', $detail) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Delete these details?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No camp details found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div class="px-6 py-4">
      {{ $campDetails->links() }}
    </div>
  </div>
</div>
@endsection
