<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserMarktWatchController extends Controller
{
    public function index() {
        return view('users.marketWatch.index');
    }
}
