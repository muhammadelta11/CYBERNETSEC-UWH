<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        $user = $request->user();
        
        // Check if user has any of the required roles
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Check for special role groups
        if (in_array('admin_all', $roles) && $user->isAnyAdmin()) {
            return $next($request);
        }

        if (in_array('users_all', $roles) && in_array($user->role, [User::ROLE_REGULAR, User::ROLE_PREMIUM])) {
            return $next($request);
        }

        // Redirect based on user role
        if ($user->isAnyAdmin()) {
            return redirect('/admin')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}
