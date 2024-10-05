<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } 
        if (auth()->user()->role == 'user'){
            return redirect()->route('user.dashboard');
        }else{
            return abort(404);
        }
    }

    public function handleRegistrationForm(Request $request)
    {

        \Log::info('Request received', $request->all());

    }

}
