<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('admin.login');
        }

        if (in_array((string) \Illuminate\Support\Facades\Auth::user()->role, ['admin', 'developer', 'support', 'analyst'], true)) {
            return $next($request);
        }

        if ((string) \Illuminate\Support\Facades\Auth::user()->role === 'client') {
            return redirect()->route('client.dashboard');
        }

        abort(403, 'Unauthorized action.');
    }
}
