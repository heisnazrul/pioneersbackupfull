<?php

use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentOnboardingController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/student/onboard/{token}', [StudentOnboardingController::class, 'show'])->name('student.onboard.show');
    Route::post('/student/onboard/{token}', [StudentOnboardingController::class, 'complete'])->name('student.onboard.complete');
});

Route::middleware(['auth', 'role:lg_student,uni_student'])->group(function () {
    Route::get('/student/dashboard', StudentDashboardController::class)->name('student.dashboard');
});
