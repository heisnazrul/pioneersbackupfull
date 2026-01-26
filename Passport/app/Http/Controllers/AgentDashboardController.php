<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Contracts\View\View;

class AgentDashboardController extends Controller
{
    public function __invoke(): View
    {
        $agent = Agent::with('user')
            ->where('user_id', auth()->id())
            ->first();

        $studentCount = $agent ? $agent->students()->count() : 0;
        $pendingStudents = $agent ? $agent->students()->whereNull('onboarded_at')->count() : 0;
        $activeStudents = $studentCount - $pendingStudents;

        return view('agent.dashboard', [
            'agent' => $agent,
            'metrics' => [
                'students' => $studentCount,
                'pending' => $pendingStudents,
                'active' => $activeStudents,
                'referralDiscount' => $agent?->referral_discount ?? 0,
            ],
        ]);
    }
}
