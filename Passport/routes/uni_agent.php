<?php

use App\Http\Controllers\RoleDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:uni_agent'])->group(function () {
    Route::get('/uni-agent/dashboard', [RoleDashboardController::class, 'show'])
        ->name('uni_agent.dashboard')
        ->defaults('roleKey', 'uni_agent');
});
