<?php

use App\Http\Controllers\RoleDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:uni_student'])->group(function () {
    Route::get('/uni-student/dashboard', [RoleDashboardController::class, 'show'])
        ->name('uni_student.dashboard')
        ->defaults('roleKey', 'uni_student');
});
