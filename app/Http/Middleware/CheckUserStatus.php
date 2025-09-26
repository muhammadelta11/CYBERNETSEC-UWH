<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if user is authenticated
        if (auth()->check()) {
            $user = auth()->user();

            // Check if user status is inactive (pending approval)
            if ($user->status === 'inactive') {
                // Logout the user and redirect to pending approval page
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/pending-approval')
                    ->with('error', 'Your account is pending approval. Please contact the administrator.');
            }

            // Check if user status is rejected
            if ($user->status === 'rejected') {
                // Logout the user and redirect to account rejected page
                auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/account-rejected')
                    ->with('error', 'Your account has been rejected. Please contact the administrator for more information.');
            }
        }

        return $next($request);
    }
}
