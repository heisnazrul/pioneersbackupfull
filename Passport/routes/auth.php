<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/login/whatsapp', [AuthController::class, 'showWhatsappLoginForm'])->name('login.whatsapp');
    Route::post('/login/whatsapp/send', [AuthController::class, 'sendWhatsappOtp'])->name('login.whatsapp.send');
    Route::post('/login/whatsapp/verify', [AuthController::class, 'verifyWhatsappOtp'])->name('login.whatsapp.verify');

    Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendForgotOtp'])->name('password.email');

    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    Route::get('/verify', [AuthController::class, 'showVerifyForm'])->name('auth.verify');
    Route::post('/verify', [AuthController::class, 'verifyOtp'])->name('auth.verify.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
