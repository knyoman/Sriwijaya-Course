<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * $roles: list of roles as parameters e.g. role:admin,teacher
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->peran; // baca kolom 'peran'
        if ($userRole && in_array($userRole, $roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized access');
    }
}
