<?php

use App\Models\User;
use App\Models\Application;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$testEmail = 'heisnazrulxx@gmail.com';

echo "Finding user with email: $testEmail\n";
$user = User::where('email', $testEmail)->first();

if (!$user) {
    echo "User not found!\n";
    exit;
}

echo "User Found: ID {$user->id}, Email {$user->email}\n";

// exact logic from controller
$applications = Application::where(function ($query) use ($user) {
    $query->where('user_id', $user->id)
        ->orWhere('email', $user->email);
})
    ->orderBy('created_at', 'desc')
    ->get();

echo "Found " . $applications->count() . " applications matching user/email.\n";

foreach ($applications as $app) {
    echo " - App ID: {$app->application_id}, Status: {$app->status}, Email: {$app->email}, UserID: {$app->user_id}\n";
}
