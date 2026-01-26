@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">FAQs</h2>
    <a href="{{ route('admin.faqs.create') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Add FAQ</a>
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
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Category</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Question</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Answer</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($faqs as $faq)
        <tr class="border-b">
          <td class="px-6 py-4 text-sm">{{ $faq->category }}</td>
          <td class="px-6 py-4 text-sm">{{ Str::limit($faq->question, 50) }}</td>
          <td class="px-6 py-4 text-sm">{{ Str::limit($faq->answer, 50) }}</td>
          <td class="px-6 py-4 text-sm">
            <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this FAQ?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800 ml-4">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="px-6 py-4 text-sm text-gray-500">No FAQs found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    <div class="px-6 py-4">
      {{ $faqs->links() }}
    </div>
  </div>
</div>
@endsection
