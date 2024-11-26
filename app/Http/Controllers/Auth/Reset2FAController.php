<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Reset2FAController extends Controller
{
    public function reset2FA()
    {
       
        Auth::logout();
        return Redirect::route('password.request');
    }
}
