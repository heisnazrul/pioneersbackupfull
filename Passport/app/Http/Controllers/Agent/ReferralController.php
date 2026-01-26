<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ReferralController extends Controller
{
    public function index(): View
    {
        $agent = Agent::where('user_id', auth()->id())->first();

        return view('agent.referrals.index', compact('agent'));
    }

    public function join(): RedirectResponse
    {
        $agent = Agent::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'referral_code' => $this->generateReferralCode(),
                'status' => 'pending',
            ]
        );

        if (! $agent->referral_code) {
            $agent->referral_code = $this->generateReferralCode();
        }

        $agent->update([
            'referral_discount' => $agent->referral_discount > 0 ? $agent->referral_discount : 5,
            'commission_percent' => $agent->commission_percent > 0 ? $agent->commission_percent : 10,
            'referral_joined_at' => now(),
        ]);

        return back()->with('success', 'Referral program activated. Start sharing your code!');
    }

    private function generateReferralCode(): string
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Agent::where('referral_code', $code)->exists());

        return $code;
    }
}
