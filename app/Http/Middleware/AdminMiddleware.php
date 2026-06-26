<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->role) {
            return redirect()->route('admin.login')
                ->with('error', 'Accès refusé. Votre compte n\'a pas de rôle assigné.');
        }

        return $next($request);
    }
}
