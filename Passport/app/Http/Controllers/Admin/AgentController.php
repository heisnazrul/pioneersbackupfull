<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AgentController extends Controller
{
    public function index(): View
    {
        $agents = Agent::query()
            ->with('user')
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.agents.index', compact('agents'));
    }

    public function edit(Agent $agent): View
    {
        return view('admin.agents.edit', compact('agent'));
    }

    public function update(Request $request, Agent $agent): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'string'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'referral_code' => ['nullable', 'string', 'max:50', Rule::unique('agents', 'referral_code')->ignore($agent->id)],
            'referral_discount' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'commission_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        $agent->update($data);

        return redirect()->route('admin.agents.index')->with('success', 'Agent updated successfully.');
    }

    public function destroy(Agent $agent): RedirectResponse
    {
        $agent->delete();

        return redirect()->route('admin.agents.index')->with('success', 'Agent removed.');
    }

    public function approve(Agent $agent): RedirectResponse
    {
        $agent->update([
            'status' => 'approved',
            'verified_at' => now(),
        ]);

        if ($agent->user && $agent->user->status !== 'active') {
            $agent->user->update(['status' => 'active']);
        }

        return back()->with('success', 'Agent approved successfully.');
    }
}
