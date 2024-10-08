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
            'getway' => 'required|numeric',
            'amount' => 'required|numeric|min:1',
        ]);

        $getway = Getway::find($request->getway);
        if (!$getway) {
            return back()->with('error', 'Invalid withdrawal method selected.');
        }

        if( strtolower($getway->name) == 'bitcoin' || strtolower($getway->name) == 'xmr' || strtolower($getway->name) == 'usdt' ) {

            $request->validate([
                'address' => 'required',
                'address_tag' => 'required',
            ]);


        }else if ( strtolower($getway->name) == 'deposit via paypal' ) {
            $request->validate([
                'paypal_email' => 'required',
            ]);

        }else if ( strtolower($getway->name) == 'deposit via bank' ) {
            
            $request->validate([
                'bank_name' => 'required|string',
                'account_number' => 'required|numeric',
                'account_type' => 'required|string',
                'short_code' => 'required|string',
                'account_holder_name' => 'required|string',
            ]);

        }

        $user = User::where('id', $user->id)->first();
     
        if ($user->balance < $request->amount) {
            return back()->with('error', 'You don’t have enough balance.');
        }
    
        Withdraw::insert([
            'user_id' => auth()->user()->id,
            'getway_id' => $request->getway,  
            'amount' => $request->amount,
            'wallet_address' => $request->address,  
            'address_tag' => $request->address_tag,
            'payment_method' => $getway->name,
            'withdrawl_by' => 'user',
            'bank_name' => $request->bank_name,
            'account_number' =>$request->account_number,
            'account_type' => $request->account_type,
            'short_code' => $request->short_code,
            'account_holder_name' => $request->account_holder_name,
            'paypal_email' => $request->paypal_email, 
            'created_at' => Carbon::now()
        ]);
       
        // $user->decrement('balance', $request->amount);
    
        return back()->with('withdrawl_success', 'Withdrawl Request Submitted')->with('type', 'withdrawl');
    
    }
    
    
    
   
}
