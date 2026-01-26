<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Home;
use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\AgentController as ApiAgentController;
use App\Http\Controllers\Api\BlogController as ApiBlogController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\ApplicationController;

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/my-applications', [ApplicationController::class, 'myApplications']);
});

Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/applications', [ApplicationController::class, 'store']);

Route::get('/countries', [App\Http\Controllers\Api\Hero::class, 'countries']);
Route::get('/cities', [App\Http\Controllers\Api\Hero::class, 'cities']);
Route::get('/schools', [App\Http\Controllers\Api\Hero::class, 'schools']);
Route::get('/branches', [App\Http\Controllers\Api\Hero::class, 'branches']);
Route::get('/universities', [App\Http\Controllers\Api\UniversityController::class, 'index']);
Route::get('/universities/{slug}', [App\Http\Controllers\Api\UniversityController::class, 'show']);
Route::get('/courses', [App\Http\Controllers\Api\UniversityCourseController::class, 'index']);
Route::get('/courses/{slug}', [App\Http\Controllers\Api\UniversityCourseController::class, 'show']);

Route::prefix('auth')->group(function () {
    Route::post('/login', [ApiAuthController::class, 'login'])->middleware('api.client');
    Route::post('/whatsapp/send-otp', [ApiAuthController::class, 'sendWhatsappOtp'])->middleware('api.client');
    Route::post('/whatsapp/verify-otp', [ApiAuthController::class, 'verifyWhatsappOtp'])->middleware('api.client');
    Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware(['auth:api', 'api.client']);
    Route::post('/google/one-tap', [\App\Http\Controllers\Auth\SocialLoginController::class, 'handleOneTap']);
});
Route::prefix('agent')->group(function () {
    Route::get('/me', [ApiAgentController::class, 'me']);
    Route::get('/students', [ApiAgentController::class, 'students']);
    Route::post('/new-student', [ApiAgentController::class, 'newStudent']);
});

// Routes home for courseenglish project
Route::prefix(prefix: 'home')->group(function () {
    Route::get('/language-course-types', [Home::class, 'languageCourseTypes']);
    Route::get('/schools', [Home::class, 'schools']);

    Route::get('/languagecourses', [Home::class, 'languageCourses']);
    Route::get('/onlinecourses', [Home::class, 'onlineCourses']);
    Route::get('/summercamps', [Home::class, 'summerCamps']);
});

// Routes home which will be shared between courseenglish and university
Route::prefix('home')->group(function () {
    Route::get('/blogs', [Home::class, 'blogs']);
    Route::get('/faqs', [Home::class, 'faqs']);
    Route::get('/reviews', [Home::class, 'reviews']);
    Route::get('/video-reviews', [Home::class, 'videoReviews']);
    Route::get('/countries', [Home::class, 'countries']);
    Route::get('/cities', [Home::class, 'cities']);
    Route::get('/certificates', [Home::class, 'certificates']);
});

// Route home for university project
Route::prefix('home')->group(function () {
    Route::get('/destinations', [DestinationController::class, 'home']);
    Route::get('/universities', [ApplicationController::class, 'featuredUniversities']); // Use ApplicationController for now or UniversityController
});




// Destinations Module
Route::get('/destinations', [DestinationController::class, 'index']);
Route::get('/destinations/{slug}', [DestinationController::class, 'show']);

// Missing Routes requested by Frontend (Root Level)
// Route::get('/faqs', [Home::class, 'faqs']); // Moved from home prefix
Route::get('/hero', [Home::class, 'hero']);
Route::get('/stats', [Home::class, 'stats']);
Route::get('/contact', [Home::class, 'contact']);
Route::get('/testimonials', [Home::class, 'testimonials']);
Route::get('/process-steps', [Home::class, 'processSteps']);
Route::get('/benefits', [Home::class, 'benefits']);
Route::get('/trust-partners', [Home::class, 'trustPartners']);
Route::get('/scholarships', [Home::class, 'scholarships']);

Route::prefix('cms/university')->group(function () {
    Route::get('/hero', [App\Http\Controllers\Api\CmsApiController::class, 'hero']);
    Route::get('/stats', [App\Http\Controllers\Api\CmsApiController::class, 'stats']);
    Route::get('/certificates', [App\Http\Controllers\Api\CmsApiController::class, 'certificates']);
    Route::get('/destinations', [App\Http\Controllers\Api\CmsApiController::class, 'destinations']);
    Route::get('/reviews', [App\Http\Controllers\Api\CmsApiController::class, 'reviews']);
    Route::get('/blogs', [App\Http\Controllers\Api\CmsApiController::class, 'blogs']);
    Route::get('/why-choose', [App\Http\Controllers\Api\CmsApiController::class, 'whyChoose']);
    Route::get('/universities', [App\Http\Controllers\Api\CmsApiController::class, 'universities']);
    Route::get('/video-reviews', [App\Http\Controllers\Api\CmsApiController::class, 'videoReviews']);
});

Route::get('/university/video_reviews', [Home::class, 'videoReviews']);

Route::get('/blogs', [ApiBlogController::class, 'index']);
Route::get('/categories', [ApiBlogController::class, 'categories']);

// blogs for university project
Route::get('/university/blogs', [ApiBlogController::class, 'universityBlogs']);
Route::get('/university/blogs/{slug}', [ApiBlogController::class, 'universityShow']);
Route::get('/university/categories', [ApiBlogController::class, 'universityCategories']);