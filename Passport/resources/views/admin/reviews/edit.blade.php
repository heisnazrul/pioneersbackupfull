@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Edit Review</h2>
    <a href="{{ route('admin.reviews.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back to List</a>
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

  @php
    // Be tolerant whether controller passed $existingScreens or not
    $shots = isset($existingScreens) ? $existingScreens : (
      (is_array($review->screenshots) ? $review->screenshots : ($review->screenshots ? json_decode($review->screenshots, true) : []))
    );
  @endphp

  <form action="{{ route('admin.reviews.update', $review) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" value="{{ old('name', $review->name) }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Name (AR)</label>
        <input type="text" name="ar_name" value="{{ old('ar_name', $review->ar_name) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Institute</label>
        <input type="text" name="institute_name" value="{{ old('institute_name', $review->institute_name) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Institute (AR)</label>
        <input type="text" name="ar_institute_name" value="{{ old('ar_institute_name', $review->ar_institute_name) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Gender</label>
        <select name="gender" class="mt-1 block w-full border rounded-md px-3 py-2">
          <option value="">—</option>
          <option value="male"   @selected(old('gender', $review->gender) === 'male')>Male</option>
          <option value="female" @selected(old('gender', $review->gender) === 'female')>Female</option>
          <option value="other"  @selected(old('gender', $review->gender) === 'other')>Other</option>
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Title</label>
        <input type="text" name="title" value="{{ old('title', $review->title) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Title (AR)</label>
        <input type="text" name="ar_title" value="{{ old('ar_title', $review->ar_title) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Rating</label>
        <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $review->rating) }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Photo</label>
        <input type="file" name="photo" accept="image/*" class="mt-1 block w-full border rounded-md px-3 py-2">
        @if($review->photo)
          <img src="{{ asset('storage/'.$review->photo) }}" class="w-16 h-16 mt-2 rounded object-cover" alt="Photo">
        @endif
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Screenshots (multiple)</label>
        <input type="file" name="screenshots[]" accept="image/*" multiple class="mt-1 block w-full border rounded-md px-3 py-2">
        @if(!empty($shots))
          <div class="flex flex-wrap mt-2 gap-2">
            @foreach($shots as $shot)
              <img src="{{ asset('storage/'.$shot) }}" class="w-16 h-16 rounded object-cover" alt="Screenshot">
            @endforeach
          </div>
        @endif
      </div>

      <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">Video URL (optional)</label>
        <input type="url" name="video" value="{{ old('video', $review->video) }}" placeholder="https://..."
               class="mt-1 block w-full border rounded-md px-3 py-2">
        @if($review->video)
          <a href="{{ $review->video }}" target="_blank" class="text-primary text-sm mt-1 inline-block">Open current video</a>
        @endif
      </div>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Review Text</label>
      <textarea name="review_text" class="mt-1 block w-full border rounded-md px-3 py-2" rows="4">{{ old('review_text', $review->review_text) }}</textarea>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Review Text (AR)</label>
      <textarea name="ar_review_text" class="mt-1 block w-full border rounded-md px-3 py-2" rows="4">{{ old('ar_review_text', $review->ar_review_text) }}</textarea>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Facebook</label>
        <input type="url" name="facebook_link" value="{{ old('facebook_link', $review->facebook_link) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Twitter</label>
        <input type="url" name="twitter_link" value="{{ old('twitter_link', $review->twitter_link) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Instagram</label>
        <input type="url" name="instagram_link" value="{{ old('instagram_link', $review->instagram_link) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">LinkedIn</label>
        <input type="url" name="linkedin_link" value="{{ old('linkedin_link', $review->linkedin_link) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
    </div>

    <div class="flex items-center space-x-2">
      <input type="hidden" name="is_approved" value="0">
      <input id="is_approved" type="checkbox" name="is_approved" value="1" class="h-4 w-4"
             @checked(old('is_approved', $review->is_approved))>
      <label for="is_approved" class="text-sm text-gray-700">Approved</label>
    </div>

    <div class="flex space-x-2">
      <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Update</button>
      <a href="{{ route('admin.reviews.index') }}" class="inline-flex items-center px-4 py-2 border rounded-full">Cancel</a>
    </div>
  </form>
</div>
@endsection
