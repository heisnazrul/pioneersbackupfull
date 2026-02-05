<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\PlaceholderController;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Placeholders for external auth providers to prevent View errors
Route::get('/forgot-password', function () {
    return 'Forgot Password Page';
})->name('password.request');
use App\Http\Controllers\Api\GoogleAuthController;

// ...

Route::get('/auth/google/frontend', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
Route::get('/login/whatsapp', function () {
    return 'WhatsApp Login';
})->name('login.whatsapp');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/role/{role}', [UserController::class, 'index'])->name('users.role');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::patch('/users/{user}/status', [UserController::class, 'updateStatus'])->name('users.status');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Applications
    Route::resource('applications', ApplicationController::class);
    Route::resource('uni-applications', \App\Http\Controllers\Admin\UniApplicationController::class);
    Route::resource('contact-submissions', \App\Http\Controllers\Admin\ContactSubmissionController::class);

    // Stubs for Sidebar Routes
    Route::controller(\App\Http\Controllers\Admin\PlaceholderController::class)->group(function () {

        // Basic Components
        Route::resource('countries', \App\Http\Controllers\Admin\CountryController::class);
        Route::resource('cities', \App\Http\Controllers\Admin\CityController::class);
        Route::get('universities/get-cities/{country}', [\App\Http\Controllers\Admin\UniversityController::class, 'getCities']);
        Route::resource('universities', \App\Http\Controllers\Admin\UniversityController::class);
        Route::resource('accreditations', PlaceholderController::class);
        Route::resource('tags', PlaceholderController::class);
        Route::resource('language-course-tags', PlaceholderController::class);
        Route::resource('language-course-types', PlaceholderController::class);
        Route::resource('faqs', PlaceholderController::class);
        Route::resource('reviews', PlaceholderController::class);

        Route::resource('certifications', PlaceholderController::class);
        Route::resource('bathroom-types', PlaceholderController::class);
        Route::resource('bedroom-types', PlaceholderController::class);
        Route::resource('meal-plans', PlaceholderController::class);
        Route::resource('gallery', PlaceholderController::class);
        Route::resource('rates', PlaceholderController::class);
        Route::resource('conversion', PlaceholderController::class);
        Route::resource('preferred-schools', PlaceholderController::class);

        // Content
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
        Route::resource('blog-tags', \App\Http\Controllers\Admin\BlogTagController::class);

        // Manage Agents
        Route::resource('referrals', PlaceholderController::class);
        Route::get('referrals/students', 'index')->name('referrals.students');

        // School Setup
        Route::resource('schools', PlaceholderController::class);
        Route::resource('school-branches', PlaceholderController::class);
        Route::resource('branch-registration-fees', PlaceholderController::class);
        Route::resource('branch-high-season-fees', PlaceholderController::class);
        Route::resource('accommodations', PlaceholderController::class);
        Route::resource('supplements', PlaceholderController::class);
        Route::resource('pickups', PlaceholderController::class);
        Route::resource('insurance-fees', PlaceholderController::class);

        // General Courses
        Route::resource('language-courses', PlaceholderController::class);
        Route::resource('language-course-material-fees', PlaceholderController::class);
        Route::resource('language-course-fees', PlaceholderController::class);

        // Online Courses
        Route::resource('online-courses', PlaceholderController::class);

        // Summer Camps
        Route::resource('summer-camps', PlaceholderController::class);
        Route::resource('summer-camp-details', PlaceholderController::class);
        Route::resource('camp-infos', PlaceholderController::class);
        Route::resource('camp-fees', PlaceholderController::class);
        Route::resource('camp-media', PlaceholderController::class);

        // University Elements
        Route::resource('universities', \App\Http\Controllers\Admin\UniversityController::class);
        Route::resource('destinations', \App\Http\Controllers\Admin\DestinationController::class);
        Route::resource('destination-guides', \App\Http\Controllers\Admin\DestinationGuideController::class);

        // Course Attributes
        Route::resource('levels', \App\Http\Controllers\Admin\LevelController::class);
        Route::resource('subject-areas', \App\Http\Controllers\Admin\SubjectAreaController::class);
        Route::resource('intake-terms', \App\Http\Controllers\Admin\IntakeTermController::class);
        Route::resource('language-tests', \App\Http\Controllers\Admin\LanguageTestController::class);
        Route::resource('course-tags', \App\Http\Controllers\Admin\UniversityCourseTagController::class);
        Route::resource('featured-lists', \App\Http\Controllers\Admin\FeaturedListController::class);

        Route::resource('campuses', \App\Http\Controllers\Admin\CampusController::class);
        Route::resource('university-courses', \App\Http\Controllers\Admin\UniversityCourseController::class);
        Route::resource('scholarships', \App\Http\Controllers\Admin\ScholarshipController::class);
        Route::resource('scholarship-applications', \App\Http\Controllers\Admin\ScholarshipApplicationController::class);
        Route::resource('intakes', PlaceholderController::class);
        Route::resource('course-requirements', PlaceholderController::class);

        // Content Modules
        Route::resource('cms-pages', \App\Http\Controllers\Admin\CmsPageController::class)->only(['index', 'edit', 'update']);
        Route::resource('reviews', \App\Http\Controllers\Admin\ReviewController::class);

        Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);
        Route::resource('certifications', \App\Http\Controllers\Admin\CertificationController::class);
        Route::resource('accommodation-rooms', \App\Http\Controllers\Admin\AccommodationRoomController::class);

        // Discounts
        Route::resource('discounts', PlaceholderController::class);
        Route::resource('coupons', PlaceholderController::class);
        Route::resource('pioneers-discounts', PlaceholderController::class);

        // CMS & Settings
        Route::get('cms/university/home', 'index')->name('cms.university.home');
        Route::resource('cms/course-english', PlaceholderController::class)->names('cms.course-english');
        Route::resource('offices', \App\Http\Controllers\Admin\OfficeController::class);

        // Settings Routes
        Route::prefix('settings')->name('settings.')->controller(\App\Http\Controllers\Admin\SettingsController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/branding', 'updateBranding')->name('branding');
            Route::post('/email', 'updateEmailVerification')->name('email');
            Route::post('/smtp', 'updateSmtp')->name('smtp');
            Route::post('/twilio', 'updateTwilio')->name('twilio');
            Route::post('/google', 'updateGoogle')->name('google');
            Route::post('/contact', 'updateContact')->name('contact');
            Route::post('/api-clients', 'updateApiClients')->name('api-clients');
        });

        // Header Routes
        Route::get('profile', 'edit')->name('profile.edit');
        Route::put('profile', 'update')->name('profile.update');
    });

    // Maintenance Routes
    Route::post('maintenance/clear-cache', function () {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        return back()->with('status', 'System cache cleared successfully!');
    })->name('maintenance.clear-cache');
});
