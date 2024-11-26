<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class is_user
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
            return redirect()->route('home');
        }

         // Check if the logged-in user has the specified role
        $user = Auth::user();
        if ($user->role == 'user') {
            date_default_timezone_set($user->time_zone);
            return $next($request);
        }else if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } else{
             return redirect()->route('home');
        }

    }
}
