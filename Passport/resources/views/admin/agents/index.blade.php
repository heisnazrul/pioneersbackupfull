@extends('admin.layouts.layout')

@section('content')
<div class="main-content py-10">
  <div class="flex justify-between py-10">
    <h2 class="text-2xl font-bold mb-4">Agents</h2>
  </div>

  @if(session('success'))
    <div class="mb-4 text-green-700 bg-green-50 border border-green-200 rounded-md px-4 py-2">
      {{ session('success') }}
    </div>
  @endif

  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full">
      <thead>
        <tr class="border-b">
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Agent</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Company</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Phone</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Status</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Referral Code</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Discount %</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Commission %</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($agents as $agent)
        <tr class="border-b">
          <td class="px-6 py-4 text-sm">
            <div class="font-medium text-gray-900">{{ $agent->user->name ?? '—' }}</div>
            <div class="text-gray-500 text-xs">{{ $agent->user->email ?? '—' }}</div>
          </td>
          <td class="px-6 py-4 text-sm">{{ $agent->company_name ?? '—' }}</td>
          <td class="px-6 py-4 text-sm">{{ $agent->phone ?? '—' }}</td>
          <td class="px-6 py-4 text-sm capitalize">{{ $agent->status }}</td>
          <td class="px-6 py-4 text-sm font-mono">{{ $agent->referral_code ?? '—' }}</td>
          <td class="px-6 py-4 text-sm">{{ $agent->referral_discount ? number_format($agent->referral_discount, 2).'%' : '—' }}</td>
          <td class="px-6 py-4 text-sm">{{ $agent->commission_percent ? number_format($agent->commission_percent, 2).'%' : '—' }}</td>
          <td class="px-6 py-4 text-sm space-x-3">
            <a href="{{ route('admin.agents.edit', $agent) }}" class="text-blue-600">Edit</a>
            <form action="{{ route('admin.agents.destroy', $agent) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this agent?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No agents found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    <div class="px-6 py-4">
      {{ $agents->links() }}
    </div>
  </div>
</div>
@endsection
