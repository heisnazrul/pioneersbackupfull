<?php

namespace App\Http\Middleware;

use App\Support\SystemSettings;
use Closure;
use Illuminate\Http\Request;

class EnsureApiClientAllowed
{
    public function handle(Request $request, Closure $next)
    {
        $allowed = SystemSettings::apiClients();
        $allowHttp = SystemSettings::apiAllowHttp();

        if (! $allowHttp && ! $request->isSecure()) {
            return response()->json([
                'success' => false,
                'message' => 'HTTPS required for this API.',
            ], 426);
        }

        // If no allowlist is defined, allow all
        if (empty($allowed)) {
            return $next($request);
        }

        $client = $request->header('X-App-Client');

        if ($client && in_array($client, $allowed, true)) {
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => 'API access denied for this client.',
        ], 403);
    }
}
