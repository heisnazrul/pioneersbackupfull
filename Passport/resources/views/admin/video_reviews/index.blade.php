@extends('admin.layouts.layout')

@section('content')
    <div class="main-content py-10">
        <div class="flex justify-between py-10">
            <h2 class="text-2xl font-bold mb-4">Video Reviews</h2>
            <a href="{{ route('admin.video-reviews.create') }}"
                class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
                <i class="ri-add-line me-1 align-middle"></i> Add Video Review
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Thumbnail</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">University</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Review Text
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-white/70">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr class="border-b">
                            <td class="px-6 py-4 text-sm">
                                @if($review->thumbnail)
                                    <img src="{{ asset('storage/' . $review->thumbnail) }}" alt="thumbnail"
                                        class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 text-gray-500">NA</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $review->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $review->university_name }}</td>
                            <td class="px-6 py-4 text-sm">{{ Str::limit($review->review_text, 50) }}</td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.video-reviews.edit', $review->id) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="ri-edit-line"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.video-reviews.destroy', $review->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 ml-4"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="ri-delete-bin-line"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
@endsection