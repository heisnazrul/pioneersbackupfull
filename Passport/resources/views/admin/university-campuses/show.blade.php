@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">{{ $universityCampus->name }}</h1>
                <p class="text-sm text-gray-600 dark:text-white/70">
                    {{ $universityCampus->university?->name }}
                    @if($universityCampus->city)
                        · {{ $universityCampus->city->name }}
                    @endif
                    · {{ $universityCampus->is_online_hub ? 'Online Hub' : 'On Campus' }}
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.campuses.edit', $universityCampus) }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Edit</a>
                <a href="{{ route('admin.campuses.index') }}" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary">Back</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div class="box">
                    <div class="box-header"><h2 class="box-title">Location</h2></div>
                    <div class="box-body space-y-2 text-sm text-gray-700 dark:text-white/80">
                        <div><span class="font-medium">Address:</span>
                            {{ $universityCampus->address_line1 ?? 'N/A' }},
                            {{ $universityCampus->address_line2 ?? '' }}
                            {{ $universityCampus->postal_code ?? '' }}</div>
                        <div><span class="font-medium">Latitude:</span> {{ $universityCampus->latitude ?? 'N/A' }}</div>
                        <div><span class="font-medium">Longitude:</span> {{ $universityCampus->longitude ?? 'N/A' }}</div>
                        <div><span class="font-medium">Timezone:</span> {{ $universityCampus->timezone ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header"><h2 class="box-title">Contact</h2></div>
                    <div class="box-body space-y-2 text-sm text-gray-700 dark:text-white/80">
                        <div><span class="font-medium">Email:</span> {{ data_get($universityCampus->contact, 'email', 'N/A') }}</div>
                        <div><span class="font-medium">Phone:</span> {{ data_get($universityCampus->contact, 'phone', 'N/A') }}</div>
                        <div><span class="font-medium">Housing Available:</span> {{ $universityCampus->housing_available ? 'Yes' : 'No' }}</div>
                        <div><span class="font-medium">International Office:</span> {{ $universityCampus->intl_office_presence ? 'Yes' : 'No' }}</div>
                    </div>
                </div>
            </div>
            <div class="space-y-6">
                <div class="box">
                    <div class="box-header"><h2 class="box-title">Facilities</h2></div>
                    <div class="box-body text-sm text-gray-700 dark:text-white/80">
                        @if ($universityCampus->facilities)
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($universityCampus->facilities as $facility)
                                    <li>{{ $facility }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 dark:text-white/60">No facilities listed.</p>
                        @endif
                    </div>
                </div>
                <div class="box">
                    <div class="box-header"><h2 class="box-title">Notes</h2></div>
                    <div class="box-body text-sm text-gray-700 dark:text-white/80">
                        {!! nl2br(e($universityCampus->notes ?? 'No notes recorded.')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
