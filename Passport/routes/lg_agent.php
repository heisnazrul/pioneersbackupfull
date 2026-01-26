<?php

use App\Http\Controllers\RoleDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:lg_agent'])->group(function () {
    Route::get('/lg-agent/dashboard', [RoleDashboardController::class, 'show'])
        ->name('lg_agent.dashboard')
        ->defaults('roleKey', 'lg_agent');
});
