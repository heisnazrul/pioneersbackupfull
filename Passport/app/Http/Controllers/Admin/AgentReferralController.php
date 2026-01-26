<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentStudent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AgentReferralController extends Controller
{
    public function index(): View
    {
        $agents = Agent::query()
            ->with('user')
            ->orderBy('company_name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.referrals.index', compact('agents'));
    }

    public function edit(Agent $agent): View
    {
        $agent->load('user');

        return view('admin.referrals.edit', compact('agent'));
    }

    public function update(Request $request, Agent $agent): RedirectResponse
    {
        $data = $request->validate([
            'referral_code' => ['nullable', 'string', 'max:50', Rule::unique('agents', 'referral_code')->ignore($agent->id)],
            'referral_discount' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'commission_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'status' => ['required', Rule::in(['pending','approved','rejected'])],
        ]);

        $agent->update($data);

        return redirect()->route('admin.referrals.index')->with('success', 'Referral settings updated successfully.');
    }

    public function students(): View
    {
        $referrals = AgentStudent::query()
            ->with(['agent.user'])
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.referrals.students', compact('referrals'));
    }
}
