@extends('agent.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="max-w-3xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Add a Student</h1>
                <p class="text-sm text-gray-600 dark:text-white/70">Create an account on behalf of your student and they will receive an email to set their password.</p>
            </div>
            <a href="{{ route('agent.students.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back</a>
        </div>

        @if ($errors->any())
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="box">
            <div class="box-body p-6">
                <form action="{{ route('agent.students.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-white/80">Student Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white/80">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-white/80">Phone (optional)</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        </div>
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 dark:text-white/80">Country (optional)</label>
                            <input type="text" id="country" name="country" value="{{ old('country') }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        </div>
                    </div>

                    <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Create Student</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
