@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Edit Referral</h1>
                <p class="text-sm text-gray-600 dark:text-white/70">Adjust the referral settings for {{ $agent->user?->name ?? 'this agent' }}.</p>
            </div>
            <a href="{{ route('admin.referrals.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back</a>
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
                <form action="{{ route('admin.referrals.update', $agent) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Referral Code</label>
                        <input type="text" name="referral_code" value="{{ old('referral_code', $agent->referral_code) }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        <p class="mt-1 text-xs text-gray-500 dark:text-white/50">Must be unique across all agents.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Student Discount (%)</label>
                            <input type="number" step="0.01" name="referral_discount" value="{{ old('referral_discount', $agent->referral_discount) }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Agent Commission (%)</label>
                            <input type="number" step="0.01" name="commission_percent" value="{{ old('commission_percent', $agent->commission_percent) }}" class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                        </div>
                         <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full border rounded-md px-3 py-2">
                                @foreach(['pending','approved','rejected'] as $status)
                                <option value="{{ $status }}" @selected(old('status', $agent->status) === $status)>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            </div>
                    </div>

                    <button type="submit" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
