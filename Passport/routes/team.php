<?php

use App\Http\Controllers\RoleDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:team'])->group(function () {
    Route::get('/team/dashboard', [RoleDashboardController::class, 'show'])
        ->name('team.dashboard')
        ->defaults('roleKey', 'team');
});
