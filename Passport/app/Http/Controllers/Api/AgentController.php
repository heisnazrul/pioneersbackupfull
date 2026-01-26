<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AgentStudentInvitationMail;
use App\Models\Agent;
use App\Models\AgentStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AgentController extends Controller
{
    private array $agentRoles = ['agent', 'uni_agent', 'lg_agent'];

    public function me(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $user = User::find($data['user_id']);
        if (! $user || ! in_array($user->role, $this->agentRoles, true)) {
            return response()->json([
                'success' => false,
                'message' => 'User is not an agent.',
            ], 403);
        }

        $agent = Agent::firstOrCreate(
            ['user_id' => $user->id],
            [
                'referral_code' => Str::upper(Str::random(8)),
                'status' => 'pending',
            ]
        );

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $agent->id,
                'user_id' => $agent->user_id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $agent->phone ?? $user->phone,
                'company_name' => $agent->company_name,
                'status' => $agent->status,
                'referral_code' => $agent->referral_code,
                'referral_discount' => $agent->referral_discount,
                'commission_percent' => $agent->commission_percent,
                'referral_link' => $agent->referralLink(),
                'verified_at' => $agent->verified_at,
            ],
        ]);
    }

    public function students(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $agent = Agent::where('user_id', $data['user_id'])->first();
        if (! $agent) {
            return response()->json([
                'success' => false,
                'message' => 'Agent not found.',
            ], 404);
        }

        $students = AgentStudent::query()
            ->where('agent_id', $agent->id)
            ->orderByDesc('created_at')
            ->get(['id', 'student_user_id', 'name', 'email', 'phone', 'country', 'onboarded_at']);

        return response()->json([
            'success' => true,
            'data' => $students,
        ]);
    }

    public function newStudent(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);

        $agent = Agent::where('user_id', $data['user_id'])->first();
        if (! $agent) {
            return response()->json([
                'success' => false,
                'message' => 'Agent not found.',
            ], 404);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'role' => 'lg_student',
            'status' => 'active',
            'password' => Hash::make(Str::random(12)),
        ]);

        $agentStudent = AgentStudent::create([
            'agent_id' => $agent->id,
            'student_user_id' => $user->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'country' => $data['country'] ?? null,
            'onboarding_token' => Str::random(48),
            'onboarding_token_expires_at' => now()->addDays(7),
        ]);

        try {
            Mail::to($data['email'])->send(new AgentStudentInvitationMail($agent, $agentStudent));
        } catch (\Throwable $e) {
            // Ignore mail failures for API response.
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $agentStudent->id,
                'student_user_id' => $agentStudent->student_user_id,
                'name' => $agentStudent->name,
                'email' => $agentStudent->email,
                'phone' => $agentStudent->phone,
                'country' => $agentStudent->country,
                'onboarded_at' => $agentStudent->onboarded_at,
            ],
        ]);
    }
}
