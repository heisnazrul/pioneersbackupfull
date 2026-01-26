@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Edit Online Course</h2>
    <a href="{{ route('admin.online-courses.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back to List</a>
  </div>

  @if ($errors->any())
    <div class="mb-4 text-red-700 bg-red-50 border border-red-200 rounded-md px-4 py-2">
      <ul class="list-disc pl-5 text-sm space-y-1">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.online-courses.update', $onlineCourse) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $onlineCourse->slug) }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" class="mt-1 block w-full border rounded-md px-3 py-2" required>
          @foreach(['draft','published','suspended'] as $status)
            <option value="{{ $status }}" @selected(old('status',$onlineCourse->status) === $status)>{{ ucfirst($status) }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">School</label>
        <select name="school_id" class="mt-1 block w-full border rounded-md px-3 py-2" required>
          <option value="">-- Select School --</option>
          @foreach($schools as $school)
            <option value="{{ $school->id }}" @selected(old('school_id', $onlineCourse->school_id) == $school->id)>{{ $school->name }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Course Type</label>
        <select name="course_type_id" class="mt-1 block w-full border rounded-md px-3 py-2" required>
          <option value="">-- Select Course Type --</option>
          @foreach($courseTypes as $type)
            <option value="{{ $type->id }}" @selected(old('course_type_id', $onlineCourse->course_type_id) == $type->id)>{{ $type->name }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Tag (optional)</label>
        <select name="tag_id" class="mt-1 block w-full border rounded-md px-3 py-2">
          <option value="">-- No Tag --</option>
          @foreach($tags as $tag)
            <option value="{{ $tag->id }}" @selected(old('tag_id', $onlineCourse->tag_id) == $tag->id)>{{ $tag->name }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Name (EN)</label>
        <input type="text" name="name" value="{{ old('name', $onlineCourse->name) }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Name (AR)</label>
        <input type="text" name="ar_name" value="{{ old('ar_name', $onlineCourse->ar_name) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Required Level</label>
        <input type="text" name="required_level" value="{{ old('required_level', $onlineCourse->required_level) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Study Time</label>
        <input type="text" name="study_time" value="{{ old('study_time', $onlineCourse->study_time) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Lessons per Week</label>
        <input type="number" name="lessons_per_week" value="{{ old('lessons_per_week', $onlineCourse->lessons_per_week) }}" min="0" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Minimum Age</label>
        <input type="number" name="min_age" value="{{ old('min_age', $onlineCourse->min_age) }}" min="0" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Start Date (text)</label>
        <input type="text" name="start_date" value="{{ old('start_date', $onlineCourse->start_date) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Fee Type</label>
        <select name="fee_type" class="mt-1 block w-full border rounded-md px-3 py-2" required>
          @foreach(['flat','weekly'] as $type)
            <option value="{{ $type }}" @selected(old('fee_type', $onlineCourse->fee_type) === $type)>{{ ucfirst($type) }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Fee Amount</label>
        <input type="number" name="fee_amount" step="0.01" min="0" value="{{ old('fee_amount', $onlineCourse->fee_amount) }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Currency Code</label>
        <input type="text" name="currency_code" value="{{ old('currency_code', $onlineCourse->currency_code) }}" maxlength="3" class="mt-1 block w-full border rounded-md px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Registration Fee</label>
        <input type="number" name="registration_fee" step="0.01" min="0" value="{{ old('registration_fee', $onlineCourse->registration_fee) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Thumbnail Image</label>
        <input type="file" name="thumbnail" accept="image/*" class="mt-1 block w-full border rounded-md px-3 py-2">
        <p class="text-xs text-gray-500 mt-1">Upload up to 2MB. Leave empty to keep the current image.</p>
        @if ($onlineCourse->thumbnail)
          <img src="{{ asset('storage/'.$onlineCourse->thumbnail) }}" alt="{{ $onlineCourse->name }}" class="mt-3 h-20 w-20 object-cover rounded-md border">
        @endif
      </div>
      <div class="flex items-center space-x-2 pt-6">
        <input type="hidden" name="visible" value="0">
        <input type="checkbox" id="visible" name="visible" value="1" class="h-4 w-4" @checked(old('visible', $onlineCourse->visible))>
        <label for="visible" class="text-sm text-gray-700">Visible on site</label>
      </div>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Description</label>
      <textarea name="description" rows="4" class="mt-1 block w-full border rounded-md px-3 py-2">{{ old('description', $onlineCourse->description) }}</textarea>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Arabic Description</label>
      <textarea name="ar_description" rows="4" class="mt-1 block w-full border rounded-md px-3 py-2">{{ old('ar_description', $onlineCourse->ar_description) }}</textarea>
    </div>

    <div class="flex space-x-2">
      <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Update Online Course</button>
      <a href="{{ route('admin.online-courses.index') }}" class="ti-btn rounded-full border">Cancel</a>
    </div>
  </form>
</div>
@endsection
