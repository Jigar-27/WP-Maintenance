<?php

namespace App\Http\Middleware;

use App\Models\User;
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

        if (\Illuminate\Support\Facades\Auth::user()->hasAnyRole(User::STAFF_ROLES)) {
            return $next($request);
        }

        if (\Illuminate\Support\Facades\Auth::user()->isClient()) {
            return redirect()->route('client.dashboard');
        }

        abort(403, 'Unauthorized action.');
    }
}
