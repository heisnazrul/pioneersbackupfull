<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;

class MaintenanceController extends Controller
{
    public function clearCache(): RedirectResponse
    {
        // Clear caches and optimize
        Artisan::call('optimize:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');

        return redirect()->back()->with('success', 'Cache cleared and application optimized.');
    }
}
