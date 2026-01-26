@extends('student.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="max-w-xl mx-auto bg-white dark:bg-white/5 rounded-2xl shadow border border-gray-100 dark:border-white/10 p-8 space-y-6">
    <div class="text-center space-y-2">
      <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Complete Your Profile</h1>
      <p class="text-sm text-gray-500 dark:text-white/70">Welcome! Please fill out the details below to activate your student account.</p>
    </div>

    @if ($errors->any())
      <div class="border border-red-200 bg-red-50 text-red-700 rounded-lg px-4 py-3 text-sm">
        <ul class="list-disc pl-4 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('student.onboard.complete', $student->onboarding_token) }}" method="POST" class="space-y-5">
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Full Name</label>
        <input type="text" name="name" value="{{ old('name', $student->name) }}" class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-white/10 bg-white dark:bg-transparent px-3 py-2 text-sm" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-white/10 bg-white dark:bg-transparent px-3 py-2 text-sm">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Password</label>
        <input type="password" name="password" class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-white/10 bg-white dark:bg-transparent px-3 py-2 text-sm" required>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Confirm Password</label>
        <input type="password" name="password_confirmation" class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-white/10 bg-white dark:bg-transparent px-3 py-2 text-sm" required>
      </div>

      <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success w-full">Activate Account</button>
    </form>
  </div>
</div>
@endsection
