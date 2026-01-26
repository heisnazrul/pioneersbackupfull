<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Mail\AgentStudentInvitationMail;
use App\Models\Agent;
use App\Models\AgentStudent;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $agent = $this->currentAgent();

        $students = AgentStudent::query()
            ->with('user')
            ->where('agent_id', $agent->id)
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('agent.students.index', compact('students'));
    }

    public function create(): View
    {
        return view('agent.students.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $agent = $this->currentAgent();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);

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

        Mail::to($data['email'])->send(new AgentStudentInvitationMail($agent, $agentStudent));

        return redirect()->route('agent.students.index')->with('success', 'Student created successfully.');
    }

    private function currentAgent(): Agent
    {
        return Agent::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'referral_code' => Str::upper(Str::random(8)),
                'status' => 'pending',
            ]
        );
    }
}
