<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()?->role !== 'admin') {
            abort(403, 'Accès non autorisé. Seuls les administrateurs peuvent accéder à cette page.');
        }

        return $next($request);
    }
}
