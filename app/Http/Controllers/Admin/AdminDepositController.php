<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Deposit;
use App\Models\UserSetting;
use App\Models\UserAccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminDepositController extends Controller
{


    public $user_setting;
    public function __construct(){
        $this->user_setting = new UserSetting();
    }
   
    public function getAllDeposits() {
        $deposits = DB::table('deposits')
                    ->join('users', 'deposits.user_id', '=', 'users.id')
                    ->select('deposits.*', 'users.first_name', 'users.last_name', 'users.email')
                    ->where('deposits.status', '!=', 'deleted')
                    ->orderBy('deposits.created_at', 'asc')
                    ->get();
        return view('admin.deposit.index', compact('deposits'));
    }
    
    public function getPendingDeposits() {
        $deposits = DB::table('deposits')
                    ->join('users', 'deposits.user_id', '=', 'users.id')
                    ->select('deposits.*', 'users.first_name', 'users.last_name', 'users.email')
                    ->where('deposits.status', 'pending')
                    ->orderBy('deposits.created_at', 'asc')
                    ->get();
        return view('admin.deposit.index', compact('deposits'));
    }


    public function getApprovedDeposits() {
        $deposits = DB::table('deposits')
                    ->join('users', 'deposits.user_id', '=', 'users.id')
                    ->select('deposits.*', 'users.first_name', 'users.last_name', 'users.email')
                    ->where('deposits.status', 'approved') 
                    ->orderBy('deposits.created_at', 'asc')
                    ->get();
        return view ('admin.deposit.index', compact('deposits'));
    }


    public function getRejectedDeposits() {
        $deposits = DB::table('deposits')
                    ->join('users', 'deposits.user_id', '=', 'users.id')
                    ->select('deposits.*', 'users.first_name', 'users.last_name', 'users.email')
                    ->where('deposits.status', 'rejected')
                    ->orWhere('deposits.status', 'deleted')
                    ->orderBy('deposits.created_at', 'asc')
                    ->get();    
        return view('admin.deposit.index', compact('deposits'));
    }

    public function approvedDepositStatus($id) {
        $data = Deposit::where('id', $id)->first();
        if ($data) {
            $user = User::where('id', $data->user_id)->first();
            $data->update(['status' => 'approved']);
            $user_balance = $user->balance;
            $this->user_setting->updatUserSetting('user_old_balance', $user_balance, $user->id);
            $user->increment('balance', $data->amount);
            
            $plan_ids = UserAccountType::allPlansIds();
            if( $data->plan_id && in_array($data->plan_id, $plan_ids) ){
                $user->account_type = $data->plan_id; 
            }
            $user->save(); 
        }
        return back()->with('success', 'Updated Successfully');
    }
    

    public function rejectedDepositStatus($id) {
        $data = Deposit::where('id', $id)->first();
        $user = User::where('id', $data->user_id)->first();
        if( $data->status == 'approved' && $user->balance > $data->amount ){
            $user_balance = $user->balance;
            $this->user_setting->updatUserSetting('user_old_balance', $user_balance , $user->id );
            $user->decrement('balance', $data->amount);
        }else{
            $user->update(['balance' => 0]);
        }
        if ($data) {
            $data->update(['status' => 'rejected']);
        }
        return back()->with('success', 'Updated Successfully');
    }


    public function deleteDeposit($id) {
        $data = Deposit::where('id', $id)->first();
        $user = User::where('id', $data->user_id)->first();
        if( $data->status == 'approved' && $user->balance > $data->amount ){
            $user_balance = $user->balance;
            $this->user_setting->updatUserSetting('user_old_balance', $user_balance , $user->id );
            $user->decrement('balance', $data->amount);
        }else{
            $user->update(['balance' => 0]);
        }
        if ($data) {
            $data->update(['status' => 'deleted']);
        }
        return back()->with('success', 'Updated Successfully');
    }

    public function downloadDeposit($id){
        $deposit = Deposit::where('id', $id)->first();
        $file_path = public_path('uploads/deposit_receipt/' . $deposit->user_id . '/' . basename($deposit->receipt));
        return response()->download($file_path);
    }

}
