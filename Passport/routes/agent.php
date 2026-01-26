<?php

use App\Http\Controllers\Agent\ReferralController;
use App\Http\Controllers\Agent\StudentController;
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\AgentRegistrationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/agent/register', [AgentRegistrationController::class, 'showRegistrationForm'])->name('agent.register');
    Route::post('/agent/register', [AgentRegistrationController::class, 'register'])->name('agent.register.submit');

    Route::get('/agent/verify', [AgentRegistrationController::class, 'showVerifyForm'])->name('agent.verify');
    Route::post('/agent/verify', [AgentRegistrationController::class, 'verify'])->name('agent.verify.submit');
});

Route::get('/agent/pending', [AgentRegistrationController::class, 'pending'])->name('agent.pending');

Route::middleware(['auth', 'role:agent,uni_agent,lg_agent'])->group(function () {
    Route::get('/agent/dashboard', AgentDashboardController::class)->name('agent.dashboard');
    Route::get('/agent/referrals', [ReferralController::class, 'index'])->name('agent.referrals.index');
    Route::post('/agent/referrals/join', [ReferralController::class, 'join'])->name('agent.referrals.join');
    Route::get('/agent/students', [StudentController::class, 'index'])->name('agent.students.index');
    Route::get('/agent/students/create', [StudentController::class, 'create'])->name('agent.students.create');
    Route::post('/agent/students', [StudentController::class, 'store'])->name('agent.students.store');
});
