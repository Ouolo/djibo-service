<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;

class TrackVisits
{
    public function handle(Request $request, Closure $next)
    {
        // Enregistrer la visite
        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'page_url' => $request->fullUrl(),
            'session_id' => session()->getId(),
            'visited_at' => now(),
        ]);

        return $next($request);
    }
}