<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\SettingController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/whatsapp/send-otp', [AuthController::class, 'sendWhatsappOtp']);
    Route::post('/whatsapp/verify-otp', [AuthController::class, 'verifyWhatsappOtp']);
});

// Public blog endpoints
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blog-categories', [BlogController::class, 'categories']);
Route::get('/blogs/{slug}', [BlogController::class, 'show']);

// Public settings
Route::get('/settings/public', [SettingController::class, 'index']);
