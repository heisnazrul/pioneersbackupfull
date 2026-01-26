<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Ensure the authenticated user has the admin role.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        if ($user) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if ($request->expectsJson()) {
            abort(403, 'This action is unauthorized.');
        }

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'You must be an administrator to access that page.',
            ]);
    }
}

