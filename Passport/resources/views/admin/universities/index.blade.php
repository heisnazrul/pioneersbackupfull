@extends('admin.layouts.layout')

@section('content')
    <div class="main-content py-10">
        <div class="space-y-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Universities</h1>
                    <p class="text-sm text-gray-600 dark:text-white/70">Manage global university partners.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.universities.create') }}"
                        class="ti-btn rounded-full ti-btn-outline ti-btn-outline-success">Create University</a>
                </div>
            </div>

            <form method="GET" class="box">
                <div class="box-body grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or slug"
                            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Country</label>
                        <select name="country_id"
                            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                            <option value="">All countries</option>
                            @foreach ($countries as $id => $country)
                                <option value="{{ $id }}" @selected(request('country_id') == $id)>{{ $country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80">Status</label>
                        <select name="status"
                            class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm dark:border-white/10 dark:bg-transparent">
                            <option value="">All</option>
                            <option value="active" @selected(request('status') === 'active')>Active</option>
                            <option value="blocked" @selected(request('status') === 'blocked')>Blocked</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="ti-btn rounded-full ti-btn-outline ti-btn-outline-primary w-full">Filter</button>
                    </div>
                </div>
            </form>

            <div class="box">
                <div class="box-body p-0 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-white/10">
                        <thead class="bg-gray-50 dark:bg-white/5">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">
                                    Country</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">
                                    Website</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-white/60">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-white/5 divide-y divide-gray-200 dark:divide-white/10">
                            @forelse ($universities as $university)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        <div class="font-medium">{{ $university->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-white/60">Slug: {{ $university->slug }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-white/70">
                                        {{ $university->country?->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $university->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $university->is_active ? 'Active' : 'Blocked' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-primary">
                                        @if ($university->website)
                                            <a href="{{ $university->website }}" target="_blank" class="hover:underline">Visit</a>
                                        @else
                                            <span class="text-gray-400">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                        <div class="flex justify-end gap-2">
                                            @if (request('status') === 'archived')
                                                <form action="{{ route('admin.universities.restore', $university->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="ti-btn ti-btn-outline ti-btn-outline-warning rounded-full text-xs">Restore</button>
                                                </form>
                                            @else
                                                <a href="{{ route('admin.universities.show', $university) }}"
                                                    class="ti-btn ti-btn-outline ti-btn-outline-primary rounded-full text-xs">View</a>
                                                <a href="{{ route('admin.universities.edit', $university) }}"
                                                    class="ti-btn ti-btn-outline ti-btn-outline-success rounded-full text-xs">Edit</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-white/60">No
                                        universities found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4">
                    {{ $universities->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection