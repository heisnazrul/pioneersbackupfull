<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/agent.php';
require __DIR__ . '/student.php';
require __DIR__ . '/counselor.php';
require __DIR__ . '/school.php';
require __DIR__ . '/team.php';
require __DIR__ . '/lg_agent.php';
require __DIR__ . '/uni_agent.php';
require __DIR__ . '/lg_student.php';
require __DIR__ . '/uni_student.php';

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Google Login
Route::get('auth/google', [App\Http\Controllers\Auth\SocialLoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\SocialLoginController::class, 'handleGoogleCallback']);

// Frontend specific Google Login (Stateless, PostMessage)
Route::get('auth/google/frontend', [App\Http\Controllers\Auth\SocialLoginController::class, 'loginFrontend']);
Route::get('auth/google/frontend/callback', [App\Http\Controllers\Auth\SocialLoginController::class, 'callbackFrontend']);
