<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminAssetsController extends Controller
{


    public function getAllAssets(){

        return view('admin.assets.index');
    }


}