<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserVerifiedStatus;

class Ensure2FAIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userVerification = UserVerifiedStatus::where('user_id', $user->id)->first();

            if ( $userVerification['2fa_verify_status'] == 1 && !session()->has('2fa_verified') && !session()->has('admin_id')) {
                return redirect()->route('2fa.Verify.screen');
            }

        }
        return $next($request);
    }

}

