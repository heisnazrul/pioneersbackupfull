<?php

use App\Http\Controllers\RoleDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:lg_student'])->group(function () {
    Route::get('/lg-student/dashboard', [RoleDashboardController::class, 'show'])
        ->name('lg_student.dashboard')
        ->defaults('roleKey', 'lg_student');
});
