<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password; 
use App\Models\UserVerifiedStatus;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     * 
     * 
     */

    protected $redirectTo = '/home';


    public function reset(Request $request){
        // Validate the incoming request (email, password, and token)
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        // Attempt to reset the user's password using the broker (based on email and token)
        $response = $this->broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Call the resetPassword function to hash and save the new password
                $this->resetPassword($user, $password);
            }
        );

        // Handle the response based on success or failure
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    protected function resetPassword($user, $password){
        $user->password = Hash::make($password);

        // after update the password disable the 2fa
        $userVerification = UserVerifiedStatus::where('user_id', $user->id)->first();
        if ($userVerification) {
            $userVerification->update(['2fa_verify_status' => 0]);
            session()->forget('2fa_verified');
        }

        $user->google2fa_secret = null;
        // Save the user with the new password
        $user->save();
        // Optionally log the user in after password reset
        $this->guard()->login($user);

    }

}
