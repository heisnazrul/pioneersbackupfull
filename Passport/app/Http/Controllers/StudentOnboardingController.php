<?php

namespace App\Http\Controllers;

use App\Models\AgentStudent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class StudentOnboardingController extends Controller
{
    public function show(string $token): View
    {
        $student = $this->findPendingStudent($token);

        return view('student.onboard', [
            'student' => $student,
        ]);
    }

    public function complete(Request $request, string $token): RedirectResponse
    {
        $student = $this->findPendingStudent($token);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if ($student->user) {
            $student->user->update([
                'name' => $data['name'],
                'phone' => $data['phone'] ?? null,
                'password' => Hash::make($data['password']),
                'status' => 'active',
            ]);
        }

        $student->update([
            'name' => $data['name'],
            'phone' => $data['phone'] ?? null,
            'onboarding_token' => null,
            'onboarding_token_expires_at' => null,
            'onboarded_at' => now(),
        ]);

        if ($student->user) {
            Auth::login($student->user);
        }

        return redirect()->route('student.dashboard')->with('success', 'Welcome aboard! Your account is ready.');
    }

    private function findPendingStudent(string $token): AgentStudent
    {
        return AgentStudent::where('onboarding_token', $token)
            ->where(function ($query) {
                $query->whereNull('onboarding_token_expires_at')
                    ->orWhere('onboarding_token_expires_at', '>=', now());
            })
            ->firstOrFail();
    }
}
