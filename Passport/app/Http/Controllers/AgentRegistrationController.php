<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AgentRegistrationController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('agent.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'role' => 'agent',
            'status' => 'pending',
            'password' => Hash::make(Str::random(12)),
        ]);

        $agent = Agent::create([
            'user_id' => $user->id,
            'phone' => $data['phone'] ?? null,
            'referral_code' => $this->generateReferralCode(),
            'status' => 'pending',
        ]);

        return redirect()->route('agent.pending');
    }

    public function pending(): View
    {
        return view('agent.pending');
    }

    public function showVerifyForm(): View
    {
        return view('agent.verify');
    }

    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $agent = Agent::where('referral_code', $request->code)->first();

        if (! $agent) {
            return back()->withErrors(['code' => 'Invalid agent code.']);
        }

        $agent->update([
            'status' => 'approved',
            'verified_at' => now(),
        ]);

        return redirect()->route('agent.dashboard');
    }

    private function generateReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Agent::where('referral_code', $code)->exists());

        return $code;
    }
}
