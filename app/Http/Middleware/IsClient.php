<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsClient
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('login');
        }

        if ((string) \Illuminate\Support\Facades\Auth::user()->role === 'client') {
            return $next($request);
        }

        if (in_array((string) \Illuminate\Support\Facades\Auth::user()->role, ['admin', 'developer', 'support', 'analyst'], true)) {
            return redirect()->route('admin.dashboard');
        }

        abort(403, 'Unauthorized action.');
    }
}
