@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Edit FAQ</h2>
    <a href="{{ route('admin.faqs.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back to List</a>
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

  <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Category</label>
        <input type="text" name="category" value="{{ old('category', $faq->category) }}" class="mt-1 block w-full border rounded-md px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700">Category (AR)</label>
        <input type="text" name="ar_category" value="{{ old('ar_category', $faq->ar_category) }}" class="mt-1 block w-full border rounded-md px-3 py-2">
      </div>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Question</label>
      <textarea name="question" rows="2" class="mt-1 block w-full border rounded-md px-3 py-2" required>{{ old('question', $faq->question) }}</textarea>
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Question (AR)</label>
      <textarea name="ar_question" rows="2" class="mt-1 block w-full border rounded-md px-3 py-2">{{ old('ar_question', $faq->ar_question) }}</textarea>
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-700">Answer</label>
      <textarea name="answer" rows="4" class="mt-1 block w-full border rounded-md px-3 py-2" required>{{ old('answer', $faq->answer) }}</textarea>
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700">Answer (AR)</label>
      <textarea name="ar_answer" rows="4" class="mt-1 block w-full border rounded-md px-3 py-2">{{ old('ar_answer', $faq->ar_answer) }}</textarea>
    </div>

    <div class="flex space-x-2">
      <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Update</button>
      <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center px-4 py-2 border rounded-full">Cancel</a>
    </div>
  </form>
</div>
@endsection
