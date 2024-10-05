<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminSoftwareController extends Controller
{


    public function getSoftwares(){

        return view('admin.software.index');
        
    }


}