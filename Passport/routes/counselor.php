<?php

use App\Http\Controllers\RoleDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:counsellor'])->group(function () {
    Route::get('/counsellor/dashboard', [RoleDashboardController::class, 'show'])
        ->name('counsellor.dashboard')
        ->defaults('roleKey', 'counsellor');
});
