@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="flex justify-between py-10">
        <h2 class="text-2xl font-bold mb-4">Edit Coupon</h2>
        <a href="{{ route('admin.coupons.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">
            Back to Coupons
        </a>
    </div>

    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        @include('admin.coupons._form', ['coupon' => $coupon])

        <div class="flex space-x-2">
            <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">
                Update Coupon
            </button>
            <a href="{{ route('admin.coupons.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-full text-gray-700 hover:bg-gray-100">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
