@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="max-w-6xl mx-auto space-y-6">
        <div class="flex flex-col gap-2">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Edit Requirement</h1>
            <p class="text-sm text-gray-600 dark:text-white/70">Update the rule details, scope, or supporting evidence.</p>
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
                <form action="{{ route('admin.course-requirements.update', $requirement) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('admin.course-requirements._form')

                    <div class="mt-8 flex justify-between items-center gap-3">
                        <a href="{{ route('admin.course-requirements.show', $requirement) }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-secondary">Back</a>
                        <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Update Requirement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
