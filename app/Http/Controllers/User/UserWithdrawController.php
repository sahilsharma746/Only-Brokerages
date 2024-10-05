<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\Getway;
use App\Models\User;
use App\Models\Withdraw;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserWithdrawController extends Controller
{

    public function __construct(){

    }


    public function index() {
        $user = Auth::user();
        $getways = Getway::where([['deposit', 'yes'], ['name', '!=', 'admin']])->get();
        $withdrawals = Withdraw::where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('users.withdraw.index', compact('getways', 'withdrawals'));
    }


    public function SaveUserWithdrawlRequest(Request $request) {
        $user = Auth::user();

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'getway' => 'required|numeric',
            'address' => 'required',
            'address_tag' => 'nullable'
        ]);
    
        $user = User::where('id', $user->id)->first();
     
        if ($user->balance < $request->amount) {
            return back()->with('error', 'You don’t have enough balance.');
        }
    
        $getway = Getway::find($request->getway);
        if (!$getway) {
            return back()->with('error', 'Invalid withdrawal method selected.');
        }
    
        Withdraw::insert([
            'user_id' => auth()->user()->id,
            'getway_id' => $request->getway,  
            'amount' => $request->amount,
            'wallet_address' => $request->address,  
            'address_tag' => $request->address_tag,
            'payment_method' => $getway->name,
            'withdrawl_by' => 'user',
            'created_at' => Carbon::now()
        ]);
       
        // $user->decrement('balance', $request->amount);
    
        return back()->with('withdrawl_success', 'Withdrawl Request Submitted')->with('type', 'withdrawl');
    
    }
    
    
    
   
}
