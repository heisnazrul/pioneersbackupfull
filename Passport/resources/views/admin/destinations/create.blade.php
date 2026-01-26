@extends('admin.layouts.layout')

@section('content')
    <div class="main-content py-10">
        <div class="flex justify-between py-10">
            <h2 class="text-2xl font-bold mb-4">Add New Destination</h2>
            <a href="{{ route('admin.destinations.index') }}"
                class="ti-btn rounded-full ti-btn-outline ti-btn-outline-secondary">
                Back
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.destinations._form')

                <div class="mt-6">
                    <button type="submit" class="ti-btn rounded-full ti-btn-primary">Create Destination</button>
                </div>
            </form>
        </div>
    </div>
@endsection