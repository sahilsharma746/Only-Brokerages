<?php

namespace App\Http\Controllers\User;

use App\Models\Getway;
use App\Models\Deposit;
use App\Models\Withdraw;
use App\Models\UserAccountType;
use App\Models\UserSetting;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class UserDepositController extends Controller
{

    public $user_setting;

    public function __construct(){

        $this->user_setting = new UserSetting();

    }


    public function index(Request $request) {
        $plan_price = 0;
        $plan = null;

        if ($request->plan_id) {
            $plan = UserAccountType::find($request->plan_id);
            if ($plan) {
                $plan_price = $plan->price;
            }
        }

        $user = Auth::user();

        $deposits = Deposit::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        $getways = Getway::where('deposit', 'yes')
                         ->whereNotIn('name', ['admin', 'admin_credit', 'admin_loan'])
                         ->get();

        $user_settings = $this->user_setting->getUserAllSetting($user->id);

        return view('users.deposit.getway', compact('deposits', 'getways', 'user_settings', 'plan_price', 'plan'));
    }


    public function userAdminDeposite(Request $request) {
        $plan_price = 0;
        $plan = null;

        if ($request->plan_id) {
            $plan = UserAccountType::find($request->plan_id);
            if ($plan) {
                $plan_price = $plan->price;
            }
        }

        $user = Auth::user();

        $deposits = Deposit::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        $getways = Getway::where('deposit', 'yes')
                         ->whereNotIn('name', ['admin', 'admin_credit', 'admin_loan'])
                         ->get();

        $user_settings = $this->user_setting->getUserAllSetting($user->id);

        return view('users.deposit.getway', compact('deposits', 'getways', 'user_settings', 'plan_price', 'plan'));
    }


    public function storeUserDeposit(Request $request, $id) {
        $getway = Getway::where('id', $id)->first();
        $request->validate([
            'amount' => 'required | numeric | min:1',
            'receipt' => 'required | image | mimes:jpg,png,jpeg',
            'wallet_address'=>'required',
            'address_tag'=>'required',
        ]);
        $plan_id = $request->plan_id ?? "NULL";
        $bot_id = $request->bot_id ?? "NULL";


        $base_path = public_path('uploads/deposit_receipt/');

        $user_id = auth()->user()->id;
        $user_folder_path = $base_path . $user_id . '/';

        if (!File::exists($user_folder_path)) {
            File::makeDirectory($user_folder_path, 0755, true);
        }

        $file = $request->file('receipt');
        $file_name = time() . '-receipt.' . $user_id . '.' . $file->getClientOriginalExtension();
        $file->move($user_folder_path, $file_name);

        Deposit::insert([
            'user_id' => $user_id,
            'getway_id' => $id,
            'payment_method'=> $getway->name,
            'amount' => $request->amount,
            'wallet_address' => $request->wallet_address,
            'address_tag'=>  $request->address_tag,
            'receipt' => $file_name,
            'deposit_by' => 'user',
            'plan_id'=>$plan_id,
            'prompt_type' => $request->prompt_type ?? ($request->bot_id ? $request->bot_id . ',bot' : null),
            'created_at' => Carbon::now()
        ]);

        return back()->with('success', 'Your Request Submited Successfully');
    }



    public function sendUserDepositTransferEmail(Request $request, $id) {
            $user = Auth::user();
            $getway = Getway::where('id', $id)->first();

            Deposit::insert([
                'user_id' => $user->id,
                'getway_id' => $id,
                'payment_method'=> $getway->name,
                'amount' => '0',
                'wallet_address' => '',
                'address_tag'=>  '',
                'status'=>  'requested',
                'deposit_by' => 'user',
                'created_at' => Carbon::now()
            ]);

            // Sending email to user about the payment by transfer
            $user_email = $user->email;
            $user_email_details = [
                'body' => "You are requesting a transfer by ".$getway->name
            ];
            Mail::send('emails.user-deposit-email', ['user_email_details' => $user_email_details], function($message) use ($user, $user_email ) {
                $message->to($user_email)
                        ->subject('Deposit Request User Email');
            });

             // Sending email to Admin about the payment by transfer
            $admin_email = config('settingkeys.admin_email');
            $admin_email_details = [
                'body' => "User " . $user->first_name ." ". $user->last_name . " is requsting payment by ". $getway->name,
            ];
            Mail::send('emails.admin-deposit-email', ['admin_email_details' => $admin_email_details], function($message) use ($user, $admin_email ) {
                $message->to($admin_email)
                        ->subject('Deposit Request Admin Email');
            });

            return back()->with('success', 'Your Request Submited Successfully');
    }

}
