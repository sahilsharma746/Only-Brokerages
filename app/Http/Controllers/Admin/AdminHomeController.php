<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use App\Models\UserVerifiedStatus;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminHomeController extends Controller
{

    public function index () {
        $full_data=[];
        $page_title = "Overview";
        $full_data['total_users'] = User::where('role', 'user')->count();
        
        $full_data['total_active_users']  = User::where([['role', 'user'], ['status', 'active']])->count();
        
        $full_data['total_kyc_verified_users'] = UserVerifiedStatus::join('users', 'user_verified_status.user_id', '=', 'users.id')
                                                                ->where('users.role', 'user') 
                                                                ->where('user_verified_status.kyc_verify_status', 'verified')
                                                                ->count();

        $full_data['total_kyc_unverified_users'] = UserVerifiedStatus::join('users', 'user_verified_status.user_id', '=', 'users.id')
                                                                ->where('users.role', 'user') 
                                                                ->where('user_verified_status.kyc_verify_status', 'pending')
                                                                ->orWhere('user_verified_status.kyc_verify_status', 'rejected')
                                                                ->count();                                                           
        
        $full_data['total_deposit'] = Deposit::sum('amount');
        $full_data['pending_deposit'] = Deposit::where('status', 'pending')->sum('amount');
        $full_data['rejected_deposit'] = Deposit::where('status', 'rejected')->sum('amount');
        $full_data['deposit_charge'] = 0;
        
        $full_data['total_withdraw'] = Withdraw::sum('amount');
        $full_data['pending_withdraw'] = Withdraw::where('status', 'pending')->sum('amount');
        $full_data['rejected_withdraw'] = Withdraw::where('status', 'rejected')->sum('amount');
        $full_data['withdraw_charge'] = 0;

        return view('admin.index', compact('full_data','page_title'));
    }

    public function adminLogin(){
        $user = Auth::user();
        if( isset( $user->role ) &&  $user->role == 'admin' ) {
            return redirect()->route('admin.dashboard');
        }else if( isset( $user->role ) &&  $user->role == 'user' ){
            return redirect()->route('user.dashboard');
        }        
        return view('admin.adminlogin');
    }


}
