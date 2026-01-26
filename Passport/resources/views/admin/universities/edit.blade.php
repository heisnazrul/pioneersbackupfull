@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="max-w-5xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Edit University</h1>
                <p class="text-sm text-gray-600 dark:text-white/70">Update the profile for {{ $university->name }}.</p>
            </div>
            <form action="{{ route('admin.universities.destroy', $university) }}" method="POST" onsubmit="return confirm('Archive this university?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-danger">Archive</button>
            </form>
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
                <form action="{{ route('admin.universities.update', $university) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.universities._form', ['university' => $university])

                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('admin.universities.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Cancel</a>
                        <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Update University</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
