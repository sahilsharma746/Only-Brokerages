<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Getway;
use App\Models\Deposit;
use App\Models\Withdraw;

use App\Models\UserSetting;
use Illuminate\Http\Request;
use App\Models\UserAccountType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Models\UserAccountTypeFeature;

class UserUpgradeController extends Controller
{

       
    // // public $user_setting;

    // public function __construct(){
    //     // $this->user_setting = new UserSetting();
    // }
    
    public function index(){
        $user = Auth::user();
       
        $plan_with_features = DB::table('user_account_types')
            ->leftJoin('user_account_types_features', 'user_account_types.id', '=', 'user_account_types_features.plan_id')
            ->select('user_account_types.id as plan_id', 'user_account_types.name', 'user_account_types.price',
                    'user_account_types_features.feature_description', 'user_account_types_features.feature_order', 
                    'user_account_types_features.feature_available')
            ->orderBy('user_account_types.id')  // Add this line to order by 'id'
            ->orderBy('user_account_types_features.id')  // Order features by 'feature_order'
            ->get();

        $plans = $plan_with_features->groupBy('plan_id');

        $current_plan_id = \DB::table('user_account_types')
        ->where('id', $user->account_type ?? null)
        ->value('name') ?? 'No Plan';
        

        return view('users.upgrade.index', compact('user','plans','current_plan_id'));
    }


 

}
