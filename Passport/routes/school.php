<?php

use App\Http\Controllers\RoleDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:school'])->group(function () {
    Route::get('/school/dashboard', [RoleDashboardController::class, 'show'])
        ->name('school.dashboard')
        ->defaults('roleKey', 'school');
});
