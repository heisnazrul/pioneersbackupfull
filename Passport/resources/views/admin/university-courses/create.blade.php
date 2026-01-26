@extends('admin.layouts.layout')

@section('content')
    <div class="main-content py-10">
        <div class="mx-auto max-w-4xl space-y-6 text-gray-800 dark:text-white">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold">Create Course</h1>
                    <p class="text-sm text-gray-500 dark:text-white/60">Add a new university course.</p>
                </div>
                <a href="{{ route('admin.university-courses.index') }}" class="ti-btn rounded-full ti-btn-ghost">Back to
                    List</a>
            </div>

            <div class="box">
                <div class="box-body">
                    <form action="{{ route('admin.university-courses.store') }}" method="POST">
                        @include('admin.university-courses._form', ['course' => new \App\Models\UniversityCourse()])

                        <div class="mt-6 flex justify-end gap-2">
                            <button type="submit" class="ti-btn rounded-full ti-btn-primary">Create Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection