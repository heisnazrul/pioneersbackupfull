@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="max-w-5xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Create Intake</h1>
            <p class="text-sm text-gray-600 dark:text-white/70">Define a new intake window for a course.</p>
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
                <form action="{{ route('admin.intakes.store') }}" method="POST">
                    @include('admin.intakes._form', ['intake' => new \App\Models\Intake()])

                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('admin.intakes.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Cancel</a>
                        <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Save Intake</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
