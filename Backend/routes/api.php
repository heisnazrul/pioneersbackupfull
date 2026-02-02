<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

    Route::post('/whatsapp/send-otp', [AuthController::class, 'sendWhatsappOtp']);
    Route::post('/whatsapp/verify-otp', [AuthController::class, 'verifyWhatsappOtp']);
});

use App\Http\Controllers\Api\HomeController;
Route::get('/home/hero', [HomeController::class, 'hero']);
Route::get('/home/certificate', [HomeController::class, 'certificate']);
Route::get('/home/destinations', [HomeController::class, 'destinations']);
Route::get('/home/universities', [HomeController::class, 'universities']);
Route::get('/home/reviews', [HomeController::class, 'reviews']);
Route::get('/home/scholarships', [HomeController::class, 'scholarships']);
Route::get('/home/blogs', [HomeController::class, 'blogs']);
Route::get('/home/faqs', [HomeController::class, 'faqs']);

// Public data endpoints
Route::get('/countries', [\App\Http\Controllers\Api\PublicDataController::class, 'countries']);
Route::get('/intakes', [\App\Http\Controllers\Api\PublicDataController::class, 'intakes']);
Route::get('/levels', [\App\Http\Controllers\Api\PublicDataController::class, 'levels']);
Route::get('/subject-areas', [\App\Http\Controllers\Api\PublicDataController::class, 'subjectAreas']);
Route::get('/cities', [\App\Http\Controllers\Api\PublicDataController::class, 'cities']);

// Courses and Universities APIs
Route::get('/courses', [\App\Http\Controllers\Api\CourseController::class, 'index'])->name('api.courses.index');
Route::get('/courses/{slug}', [\App\Http\Controllers\Api\CourseController::class, 'show'])->name('api.courses.show');
Route::get('/universities', [\App\Http\Controllers\Api\UniversityController::class, 'index'])->name('api.universities.index');
Route::get('/universities/{slug}', [\App\Http\Controllers\Api\UniversityController::class, 'show'])->name('api.universities.show');

// Other APIs
Route::get('/destinations', [\App\Http\Controllers\Api\DestinationController::class, 'index']);
Route::get('/destinations/{slug}', [\App\Http\Controllers\Api\DestinationController::class, 'show']);
Route::get('/scholarships', [HomeController::class, 'scholarships']);
Route::get('/scholarships/{slug}', [\App\Http\Controllers\Api\ScholarshipController::class, 'show']);
Route::get('/blogs', [\App\Http\Controllers\Api\BlogController::class, 'index']);
Route::get('/blog-categories', [\App\Http\Controllers\Api\BlogController::class, 'categories']);
Route::get('/blogs/{slug}', [\App\Http\Controllers\Api\BlogController::class, 'show']);
Route::get('/cms-pages/{slug}', [\App\Http\Controllers\Api\CmsPageController::class, 'show']);
Route::get('/settings/public', [\App\Http\Controllers\Api\SettingController::class, 'index']);
Route::get('/offices', [\App\Http\Controllers\Api\OfficeController::class, 'index']);
Route::get('/offices/{slug}', [\App\Http\Controllers\Api\OfficeController::class, 'show']);

Route::get('/navbar/destinations', [\App\Http\Controllers\Api\NavbarController::class, 'destinations']);
Route::post('/applications', [\App\Http\Controllers\Api\ApplicationController::class, 'store']);
Route::post('/scholarship-applications', [\App\Http\Controllers\Api\ScholarshipApplicationController::class, 'store']); // Scholarship App
Route::post('/uni-applications', [\App\Http\Controllers\Api\UniApplicationController::class, 'store']);
Route::post('/contact/submit', [\App\Http\Controllers\Api\ContactSubmissionController::class, 'store']);

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

Route::prefix('auth')->group(function () {
    Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('/whatsapp/send-otp', [\App\Http\Controllers\Api\AuthController::class, 'sendWhatsappOtp']);
    Route::post('/whatsapp/verify-otp', [\App\Http\Controllers\Api\AuthController::class, 'verifyWhatsappOtp']);
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:api');
});

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/my-applications', [\App\Http\Controllers\Api\ApplicationController::class, 'myApplications']);
    Route::get('/my-scholarship-applications', [\App\Http\Controllers\Api\ScholarshipApplicationController::class, 'index']); // User's Scholarship Apps
    Route::post('/profile/update', [\App\Http\Controllers\Api\AuthController::class, 'updateProfile']);
});
