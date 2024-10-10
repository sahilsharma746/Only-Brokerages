<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Getway;
use App\Models\Deposit;
use App\Models\Withdraw;
use App\Models\UserAddress;
use App\Models\UserSetting;
use Illuminate\Http\Request;


use App\Models\UserAccountType;
use App\Models\UserVerifiedStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AdminUserController extends Controller
{

    protected $page_title;

    public $user_setting;

    public function __construct()
    {
        $this->user_setting = new UserSetting();
    }

    public function index () {
        $page_title = 'All Users';
        $all_users = User::with('addresses')->where([['role', 'user']])->get();
        return view('admin.users.index', compact('all_users', 'page_title'));
    }

    
    public function activeUsers () {
        $page_title = 'Active Users';
        $all_users = User::with('addresses')->where([['role', 'user'], ['status', 'active']])->get();
        return view('admin.users.index', compact('all_users', 'page_title'));
    }
    
    
    public function kycVerified () {
        $page_title = 'KYC Verified Users';
       
        $all_users = User::join('user_verified_status', 'users.id', '=', 'user_verified_status.user_id')
            ->with('addresses')
            ->where([
                ['users.role', 'user'],
                ['user_verified_status.kyc_verify_status', 'verified']
            ])
            ->select('users.*') 
            ->get();

        return view('admin.users.index', compact('all_users', 'page_title'));
    }
    
    
    public function kycUnverified () {
        $page_title = 'KYC Unverified Users';
        $all_users = User::join('user_verified_status', 'users.id', '=', 'user_verified_status.user_id')
            ->with('addresses')
            ->where([
                ['users.role', 'user'],
                ['user_verified_status.kyc_verify_status', 'pending']
            ])
            ->select('users.*')
            ->get();
        return view('admin.users.index', compact('all_users', 'page_title'));
    }
    
   
    public function emailVerified () {
        $page_title = 'Email Verified Users';
        $all_users = User::join('user_verified_status', 'users.id', '=', 'user_verified_status.user_id')
            ->with('addresses')
            ->where([
                ['users.role', 'user'],
                ['user_verified_status.email_verify_status', 'verified']
            ])
            ->select('users.*') 
            ->get();
        return view('admin.users.index', compact('all_users', 'page_title'));
    }
    
    
    public function phoneVerified () {
        $page_title = 'Phone Verified Users';
        $all_users = User::join('user_verified_status', 'users.id', '=', 'user_verified_status.user_id')
            ->with('addresses')
            ->where([
                ['users.role', 'user'],
                ['user_verified_status.phone_verify_status', 'verified']
            ])
            ->select('users.*') 
            ->get();        
        return view('admin.users.index', compact('all_users', 'page_title'));
    }
    
    
    public function bannedVerified () {
        $page_title = 'Banned Users';
        $all_users = User::with('addresses')->where([['role', 'user'], ['status', 'baned']])->get();
        return view('admin.users.index', compact('all_users', 'page_title'));
    }

    public function deletedUser()
    {
        $page_title = 'Deleted Users';
        $all_users = User::with('addresses')->where([['role', 'user'], ['status', 'deactive']])->get();
        return view('admin.users.index', compact('all_users', 'page_title'));
    }

    
    public function details(User $user){
        $page_title = "Manage User";
        $full_data = [];
        $total_deposit_amount = Deposit::getUserDepositAmount($user->id);
        $total_withdrawl_amount = 0;
        $total_transactions = 0;
        $user_address = UserAddress::where('user_id', $user->id)->first();
        $verification_prompts_permissions_data = UserVerifiedStatus::where('user_id', $user->id)->first();
        $user_settings = $this->user_setting->getUserAllSetting($user->id);

        $full_data['total_deposit_amount'] = $total_deposit_amount;
        $full_data['total_withdrawl_amount'] = $total_withdrawl_amount;
        $full_data['total_transactions'] = $total_transactions;
        $full_data['user_data'] = $user;
        $full_data['user_address'] = $user_address;
        $full_data['verification_prompts_permissions_data'] = $verification_prompts_permissions_data;
        $full_data['user_settings'] = $user_settings;
        $full_data['kyc_cocument_path'] = asset('uploads/kyc_documents/'.$user->id.'/');
        $full_data['all_account_type'] = UserAccountType::all(); 
        $full_data['current_account'] =  UserAccountType::getUserPlan($user->account_type);
        return view('admin.users.user-detail', compact('full_data','page_title'));
    }


    public function changeUserPlan(Request $request, User $user)
{
    $request->validate([
        'account_type_id' => 'required|exists:user_account_types,id',
    ]);

    $user->update([
        'account_type' => $request->account_type_id,
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'User plan updated successfully!');
}

 

    public function editUserPaymentSettings(Request $request, User $user) {

        $bitcoin_address = config('settingkeys.bitcoin_address_key');
        if ( isset( $request->$bitcoin_address ) && !empty( $request->$bitcoin_address)) {
            $this->user_setting->updatUserSetting( $bitcoin_address, $request->$bitcoin_address, $user->id );
        }

        $bitcoin_address_tag_key = config('settingkeys.bitcoin_address_tag_key');
        if ( isset( $request->$bitcoin_address_tag_key ) && !empty( $request->$bitcoin_address_tag_key)) {
            $this->user_setting->updatUserSetting( $bitcoin_address_tag_key, $request->$bitcoin_address_tag_key, $user->id );
        }

        $usdt_address_key = config('settingkeys.usdt_address_key');
        if ( isset( $request->$usdt_address_key ) && !empty( $request->$usdt_address_key)) {
            $this->user_setting->updatUserSetting( $usdt_address_key, $request->$usdt_address_key, $user->id );
        }

        $usdt_address_tag_key = config('settingkeys.usdt_address_tag_key');
        if ( isset( $request->$usdt_address_tag_key ) && !empty( $request->$usdt_address_tag_key)) {
            $this->user_setting->updatUserSetting( $usdt_address_tag_key, $request->$usdt_address_tag_key, $user->id );
        }

        $xmr_address_key = config('settingkeys.xmr_address_key');
        if ( isset( $request->$xmr_address_key ) && !empty( $request->$xmr_address_key)) {
            $this->user_setting->updatUserSetting( $xmr_address_key, $request->$xmr_address_key, $user->id );
        }

        $xmr_address_tag_key = config('settingkeys.xmr_address_tag_key');
        if ( isset( $request->$xmr_address_tag_key ) && !empty( $request->$xmr_address_tag_key)) {
            $this->user_setting->updatUserSetting( $xmr_address_tag_key, $request->$xmr_address_tag_key, $user->id );
        }

        $paypal_key = config('settingkeys.paypal_key');
        if ( isset( $request->$paypal_key ) && !empty( $request->$paypal_key)) {
            $this->user_setting->updatUserSetting( $paypal_key, $request->$paypal_key, $user->id );
        }

        $bank_key = config('settingkeys.bank_key');
        if ( isset( $request->$bank_key ) && !empty( $request->$bank_key)) {
            $this->user_setting->updatUserSetting( $bank_key, $request->$bank_key, $user->id );
        }

        $account_type_key = config('settingkeys.account_type_key');
        if ( isset( $request->$account_type_key ) && !empty( $request->$account_type_key)) {
            $this->user_setting->updatUserSetting( $account_type_key, $request->$account_type_key, $user->id );
        }

        $account_number_key = config('settingkeys.account_number_key');
        if ( isset( $request->$account_number_key ) && !empty( $request->$account_number_key)) {
            $this->user_setting->updatUserSetting( $account_number_key, $request->$account_number_key, $user->id );
        }

        $sort_code_key = config('settingkeys.sort_code_key');
        if ( isset( $request->$sort_code_key ) && !empty( $request->$sort_code_key)) {
            $this->user_setting->updatUserSetting( $sort_code_key, $request->$sort_code_key, $user->id );
        }

        $bitcoin_qr_code_key = config('settingkeys.bitcoin_qr_code_key');
        $xmr_qr_code_key = config('settingkeys.xmr_qr_code_key');
        $usdt_qr_code_key = config('settingkeys.usdt_qr_code_key');
        $user_id = $user->id;

        $validated = $request->validate([
            $bitcoin_qr_code_key => 'mimes:png,jpeg,jpg|max:2048',
            $xmr_qr_code_key => 'mimes:png,jpeg,jpg|max:2048',
            $usdt_qr_code_key => 'mimes:png,jpeg,jpg|max:2048',
        ]);

        // Bitcoin QR Code
        if ($request->hasFile($bitcoin_qr_code_key)) {
            $bitcoin_qr_file = $request->file($bitcoin_qr_code_key);
            $bitcoin_qr_code = time() . '-bitcoin_qr_code.' . $user_id . '.' . $bitcoin_qr_file->getClientOriginalExtension();
            $upload_dir = public_path('uploads/qr_code/');
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $bitcoin_qr_file->move($upload_dir, $bitcoin_qr_code);
            $this->user_setting->updatUserSetting($bitcoin_qr_code_key, $bitcoin_qr_code, $user->id);
        }

        // Monero (XMR) QR Code
        if ($request->hasFile($xmr_qr_code_key)) {
            $xmr_qr_file = $request->file($xmr_qr_code_key);
            $xmr_qr_code = time() . '-xmr_qr_code.' . $user_id . '.' . $xmr_qr_file->getClientOriginalExtension();
            $upload_dir = public_path('uploads/qr_code/');
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $xmr_qr_file->move($upload_dir, $xmr_qr_code);
            $this->user_setting->updatUserSetting($xmr_qr_code_key, $xmr_qr_code, $user->id);
        }

        // USDT QR Code
        if ($request->hasFile($usdt_qr_code_key)) {
            $usdt_qr_file = $request->file($usdt_qr_code_key);
            $usdt_qr_code = time() . '-usdt_qr_code.' . $user_id . '.' . $usdt_qr_file->getClientOriginalExtension();
            $upload_dir = public_path('uploads/qr_code/');
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $usdt_qr_file->move($upload_dir, $usdt_qr_code);
            $this->user_setting->updatUserSetting($usdt_qr_code_key, $usdt_qr_code, $user->id);
        }

        return to_route('admin.user.details', $user->id )->with('success', 'Updated Successfully');

    }


    public function user_verification (User $user) {
        return view('admin.users.user-detail', compact('all_users', 'page_title'));
    }
    

    public function editBalance(User $user) {
        return view('admin.users.edit-balance', compact('user'));
    }

    public function AddsubtractBlanace(Request $request, User $user)
    {
        $request->validate([
            'amount' => 'required | numeric | min:1'
        ]);

        // Log the old balance for tracking
        $user_balance = $user->balance;
        $this->user_setting->updatUserSetting('user_old_balance', $user_balance, $user->id);

        // Default to admin loan gateway ID (or whatever logic fits your need)
        $admin_gateway_id = Getway::getAdminGatewayID();
        $remarks = $request->remark ?? ''; // Set remarks if provided, or default to an empty string
    
        if(  $request->type  == 'debit'  ) {
            Withdraw::updateWithdrawalByAdmin($user->id, $request->amount, $admin_gateway_id->id, $remarks, 'admin');
            $user->decrement('balance', $request->amount);
        }else{
            Deposit::updateDepositByAdmin($user->id, $request->amount, $admin_gateway_id->id, $remarks, 'admin');
            $user->increment('balance', $request->amount);
        }
      
        // Redirect with success message
        return to_route('admin.user.index')->with('success', 'Updated Successfully');
    }
    


    

    public function updateBalance(Request $request, User $user) {
        $request->validate([
            'amount' => 'required | numeric | min:1',
            'type' => 'required | string'
        ]);

        $admin_gateway_id = ( $request->type == 'admin_credit') ? Getway::getAdminCreditGatewayID() : Getway::getAdminLoanGatewayID();
        $remarks = isset($request->remark ) ? $request->remark : '';

        // Check if the request type is 'credit', otherwise treat it as 'debit'
        Deposit::updateDepositByAdmin($user->id, $request->amount, $admin_gateway_id->id, $remarks, $request->type );
        $user_balance = $user->balance;
        $this->user_setting->updatUserSetting('user_old_balance', $user_balance , $user->id );
        $user->increment('balance', $request->amount);
        
        return to_route('admin.user.index')->with('success', 'Updated Successfully');
    }

    public function deleteUser(User $user) {
        $user->update([ 'status' => 'deactive' ]);
        $arr = explode('/', $user->avatar);
        $img = end($arr);
        if ($img != 'avatar.png') {
            $file_path = public_path('uploads/user_avatar/' . $user->avatar);
            if (file_exists($file_path)) {
                unlink(base_path($file_path));
            }
        }
        // $user->delete();
        return back()->with('success', 'Deleted Successfully');
    }


    public function banUser (User $user) {
        $user->update([ 'status' => 'baned' ]);
        return back()->with('success', 'Banned Succesfully');
    }


    public function UnbanUser (User $user) {
        $user->update([ 'status' => 'active' ]);
        return back()->with('success', 'User UnBanned Succesfully');
    }



    public function loginAsUser(User $user){
        // Save the admin's ID to restore later
        session(['admin_id' => Auth::id()]);

        // Log in as the selected user
        Auth::login($user);

        // Redirect to the user dashboard (or any desired page)
        return redirect()->route('user.dashboard')->with('success', 'Logged in as ' . $user->first_name . " " . $user->last_name );
    }

    public function form () {
        return view('admin.form');
    }

    
    public function kycAdminAction(User $user, Request $request){
        $request->validate([
            'kyc_id_type' => 'required|string',
            'action' => 'required|string|in:approve,reject',
        ]);
    
        $status = ($request->action === 'approve') ? 3 : 2;

        $message = '';

        if ($request->kyc_id_type === 'kyc_id_front') {
            $updated = UserVerifiedStatus::where('user_id', $user->id)
                ->update(['kyc_id_front' => $status]);
            $message = 'Front ID';

        } elseif ($request->kyc_id_type === 'kyc_id_back') {
            $updated = UserVerifiedStatus::where('user_id', $user->id)
                ->update(['kyc_id_back' => $status]);
            $message = 'Back ID';

        } elseif ($request->kyc_id_type === 'kyc_address_proof') {
            $updated = UserVerifiedStatus::where('user_id', $user->id)
                ->update(['kyc_address_proof' => $status]);
            $message = 'Address Proof';

        } elseif ($request->kyc_id_type === 'kyc_selfie_proof') {
            $updated = UserVerifiedStatus::where('user_id', $user->id)
                ->update(['kyc_selfie_proof' => $status]);
            $message = 'Selfie Proof';

        } else {
            return back()->with('error', 'Invalid document type.');
        }

        if (!$updated) {
            return back()->with('error', 'Failed to update status.');
        }

        $action = ($status === 3) ? 'approved' : 'rejected';
        $statusMessage = "{$message} has been {$action} successfully!";

        $user_verified_status = UserVerifiedStatus::where('user_id', $user->id)->first();
        
        if (
            $user_verified_status->kyc_id_front == 3 &&
            $user_verified_status->kyc_id_back == 3 &&
            $user_verified_status->kyc_address_proof == 3 &&
            $user_verified_status->kyc_selfie_proof == 3
        ) {
            // If all are approved, update kyc_verify_status to 'approved'
            $user_verified_status->kyc_verify_status = 'verified';
            $user_verified_status->save();
            $status_message = ' All documents are approved. KYC status is now fully approved.';
        }

        // return back()->with('success', $status_message);
        return back()->with('success', 'updated successfully');

        
    }
    
    
    public function AdminPrompt(Request $request, $userId)
    {    
        $request->validate([
            'prompt_type' => 'required|string|in:upgrade_prompt,certificate_prompt,identity_prompt,custom_prompt,demo',
            'action' => 'required|string|in:on,off'
        ]);

        $user_prompt_settings = UserVerifiedStatus::where('user_id', $userId)->first();

        if (!$user_prompt_settings) {
            return redirect()->back()->withErrors('User prompt settings not found.');
        }

        $prompt_type = $request->input('prompt_type');
        $action = $request->input('action');

        $newValue = $action == 'on' ? '1' : '0';
        $user_prompt_settings->$prompt_type = $newValue;
        $user_prompt_settings->save();

        return back()->with('success', 'updated successfully');

    }

}



    

