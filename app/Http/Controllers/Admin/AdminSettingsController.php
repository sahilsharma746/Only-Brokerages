<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminSettingsController extends Controller
{


    public function getAdminGeneralSettings(){

        return view('admin.settings.general');
    }


    public function getAdminSystemSettings(){

        return view('admin.settings.system');
        
    }


}