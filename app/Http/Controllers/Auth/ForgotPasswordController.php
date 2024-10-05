<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;



class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    // public function sendResetLinkEmail(Request $request){
    //     $user = User::where('email', $request->email)->first();
    //     if ($user && $user->oauth_provider) {
    //         return back()->with('status', 'This account uses OAuth and cannot reset the password.');
    //     }
    //     return this->sendResetLinkEmail($request);
    // }


    // public function sendResetLinkEmail(Request $request)
    // {
    //     $this->validateEmail($request);

    //     $user = \App\Models\User::where('email', $request->email)->first();

    //     if ($user && $user->oauth_provider) {
    //         return back()->withErrors(['email' => 'This account uses OAuth and cannot reset the password.']);
    //     }

    //     $response = $this->broker()->sendResetLink(
    //         $request->only('email')
    //     );

    //     return $response == Password::RESET_LINK_SENT
    //         ? $this->sendResetLinkResponse($request, $response)
    //         : $this->sendResetLinkFailedResponse($request, $response);
    // }



}
