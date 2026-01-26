@extends('admin.layouts.layout')

@section('content')
    <div class="main-content py-10">
        <div class="mx-auto max-w-4xl space-y-6 text-gray-800 dark:text-white">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold">Edit Course</h1>
                    <p class="text-sm text-gray-500 dark:text-white/60">Update details for {{ $universityCourse->name }}.
                    </p>
                </div>
                <a href="{{ route('admin.university-courses.index') }}" class="ti-btn rounded-full ti-btn-ghost">Back to
                    List</a>
            </div>

            <div class="box">
                <div class="box-body">
                    {{-- Note: Controller passes 'universityCourse' variable, but form partial uses 'course' --}}
                    <form action="{{ route('admin.university-courses.update', $universityCourse) }}" method="POST">
                        @method('PUT')
                        @include('admin.university-courses._form', ['course' => $universityCourse])

                        <div class="mt-6 flex justify-end gap-2">
                            <button type="submit" class="ti-btn rounded-full ti-btn-primary">Update Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection