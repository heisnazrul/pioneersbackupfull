@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Edit Training Course</h2>
    <a href="{{ route('admin.training-courses.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back to List</a>
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

  <form action="{{ route('admin.training-courses.update', $trainingCourse) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $trainingCourse->slug) }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" class="mt-1 block w-full border rounded-md px-3 py-2" required>
          @foreach(['draft','published','suspended'] as $status)
            <option value="{{ $status }}" @selected(old('status', $trainingCourse->status) === $status)>{{ ucfirst($status) }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">School</label>
        <select name="school_id" class="mt-1 block w-full border rounded-md px-3 py-2" required>
          <option value="">-- Select School --</option>
          @foreach($schools as $school)
            <option value="{{ $school->id }}" @selected(old('school_id', $trainingCourse->school_id) == $school->id)>{{ $school->name }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Branch (optional)</label>
        <select name="branch_id" class="mt-1 block w-full border rounded-md px-3 py-2">
          <option value="">-- No Branch --</option>
          @foreach($branches as $branch)
            <option value="{{ $branch->id }}" @selected(old('branch_id', $trainingCourse->branch_id) == $branch->id)>
              {{ $branch->slug }} @if($branch->school) - {{ $branch->school->name }} @endif
            </option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Course Type</label>
        <select name="course_type_id" class="mt-1 block w-full border rounded-md px-3 py-2" required>
          <option value="">-- Select Course Type --</option>
          @foreach($courseTypes as $type)
            <option value="{{ $type->id }}" @selected(old('course_type_id', $trainingCourse->course_type_id) == $type->id)>{{ $type->name }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Tag (optional)</label>
        <select name="tag_id" class="mt-1 block w-full border rounded-md px-3 py-2">
          <option value="">-- No Tag --</option>
          @foreach($tags as $tag)
            <option value="{{ $tag->id }}" @selected(old('tag_id', $trainingCourse->tag_id) == $tag->id)>{{ $tag->name }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Name (EN)</label>
        <input type="text" name="name" value="{{ old('name', $trainingCourse->name) }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Name (AR)</label>
        <input type="text" name="ar_name" value="{{ old('ar_name', $trainingCourse->ar_name) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Required Level</label>
        <input type="text" name="required_level" value="{{ old('required_level', $trainingCourse->required_level) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Study Time</label>
        <input type="text" name="study_time" value="{{ old('study_time', $trainingCourse->study_time) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Lessons per Week</label>
        <input type="number" name="lessons_per_week" value="{{ old('lessons_per_week', $trainingCourse->lessons_per_week) }}" min="0" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Minimum Age</label>
        <input type="number" name="min_age" value="{{ old('min_age', $trainingCourse->min_age) }}" min="0" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Start Date (text)</label>
        <input type="text" name="start_date" value="{{ old('start_date', $trainingCourse->start_date) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Fee Type</label>
        <select name="fee_type" class="mt-1 block w-full border rounded-md px-3 py-2" required>
          @foreach(['flat','weekly'] as $type)
            <option value="{{ $type }}" @selected(old('fee_type', $trainingCourse->fee_type) === $type)>{{ ucfirst($type) }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Fee Amount</label>
        <input type="number" name="fee_amount" step="0.01" min="0" value="{{ old('fee_amount', $trainingCourse->fee_amount) }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Currency Code</label>
        <input type="text" name="currency_code" value="{{ old('currency_code', $trainingCourse->currency_code) }}" maxlength="3" class="mt-1 block w-full border rounded-md px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Registration Fee</label>
        <input type="number" name="registration_fee" step="0.01" min="0" value="{{ old('registration_fee', $trainingCourse->registration_fee) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Thumbnail Image</label>
        <input type="file" name="thumbnail" accept="image/*" class="mt-1 block w-full border rounded-md px-3 py-2">
        <p class="text-xs text-gray-500 mt-1">Upload up to 2MB. Leave empty to keep the current image.</p>
        @if ($trainingCourse->thumbnail)
          <img src="{{ asset('storage/'.$trainingCourse->thumbnail) }}" alt="{{ $trainingCourse->name }}" class="mt-3 h-20 w-20 object-cover rounded-md border">
        @endif
      </div>
      <div class="flex items-center space-x-2 pt-6">
        <input type="hidden" name="visible" value="0">
        <input type="checkbox" id="visible" name="visible" value="1" class="h-4 w-4" @checked(old('visible', $trainingCourse->visible))>
        <label for="visible" class="text-sm text-gray-700">Visible on site</label>
      </div>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Description</label>
      <textarea name="description" rows="4" class="mt-1 block w-full border rounded-md px-3 py-2">{{ old('description', $trainingCourse->description) }}</textarea>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Arabic Description</label>
      <textarea name="ar_description" rows="4" class="mt-1 block w-full border rounded-md px-3 py-2">{{ old('ar_description', $trainingCourse->ar_description) }}</textarea>
    </div>

    <div class="flex space-x-2">
      <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Update Training Course</button>
      <a href="{{ route('admin.training-courses.index') }}" class="ti-btn rounded-full border">Cancel</a>
    </div>
  </form>
</div>
@endsection
