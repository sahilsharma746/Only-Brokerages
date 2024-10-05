<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class is_admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // Check if the logged-in user has the specified role
        $user = Auth::user();

        if ($user->role == 'admin') {
            return $next($request);
        }else if ($user->role == 'user') {
            return redirect()->route('user.dashboard');
        } else{
            return redirect()->route('admin.login');
        }
    }
}
