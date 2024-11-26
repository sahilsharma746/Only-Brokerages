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

use App\Models\TradingBotJobs;
use App\Models\TradingBot;
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

        $full_data['bot_for_user'] = TradingBotJobs::where('user_id', $user->id)->get();
       $bot_id= TradingBotJobs::where('user_id', $user->id)->pluck('bot_id');
       $full_data['bot_names'] = TradingBot::whereIn('id', $bot_id)->pluck('name', 'id')->toArray();

        $keys = config('settingkeys.prompts_permissions'); // This is an array of keys
        foreach ($keys as $key) {
            $result = $this->user_setting->getUserSetting($key, $user->id);
            $full_data[$key] = ($result !== false) ? true : false;
        }


        return view('admin.users.user-detail', compact('full_data','page_title'));
    }


    public function changeUserPlan(Request $request, User $user){
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
        $user_id = $user->id;
        $upload_dir = public_path('uploads/qr_code/');
        $settings_to_update = [];

        // Ensure the QR code upload directory exists
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Address and Tag keys
        $configKeys = [
            'bitcoin_address_key',
            'bitcoin_address_tag_key',
            'usdt_address_key',
            'usdt_address_tag_key',
            'xmr_address_key',
            'xmr_address_tag_key',
            'paypal_key',
            'bank_key',
            'account_type_key',
            'account_number_key',
            'sort_code_key'
        ];

        foreach ($configKeys as $configKey) {
            $key = config("settingkeys.$configKey");
            if (isset($request->$key) && !empty($request->$key)) {
                $settings_to_update[$key] = $request->$key;
            }
        }

        // Update all settings in a batch if available
        foreach ($settings_to_update as $key => $value) {
            $this->user_setting->updatUserSetting($key, $value, $user_id);
        }

        // QR Code keys and validation
        $qrCodeKeys = [
            'bitcoin_qr_code_key',
            'xmr_qr_code_key',
            'usdt_qr_code_key'
        ];

        $validated = $request->validate([
            config('settingkeys.bitcoin_qr_code_key') => 'mimes:png,jpeg,jpg|max:2048',
            config('settingkeys.xmr_qr_code_key') => 'mimes:png,jpeg,jpg|max:2048',
            config('settingkeys.usdt_qr_code_key') => 'mimes:png,jpeg,jpg|max:2048',
        ]);

        foreach ($qrCodeKeys as $qrCodeKey) {
            $key = config("settingkeys.$qrCodeKey");

            if ($request->hasFile($key)) {
                $qr_file = $request->file($key);
                $qr_code_name = time() . '-' . $qrCodeKey . '.' . $user_id . '.' . $qr_file->getClientOriginalExtension();

                $qr_file->move($upload_dir, $qr_code_name);
                $this->user_setting->updatUserSetting($key, $qr_code_name, $user_id);
            }
        }

        return to_route('admin.user.details', $user_id)->with('success', 'Updated Successfully');
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

            // dlete the kyc prompt key if all the documents are approved

            $user_verified_status->kyc_verify_status = 'verified';

            $user_verified_status->save();
            UserSetting::where('user_id', $user_verified_status->user_id)
            ->where('option_name', 'kyc_verification_prompt')
            ->delete();
            $status_message = ' All documents are approved. KYC status is now fully approved.';
        }

        // return back()->with('success', $status_message);
        return back()->with('success', 'updated successfully');


    }

    public function upgradePrompt(Request $request, $userId){

        $request->validate([
            'prompt_key' => 'required|string',
        ]);

        if( $request->prompt_key == 'upgrade_prompt') {

            $upgrade_prompt_plan_id = $request->plan_id;
            $upgrade_prompt_plan_name = UserAccountType::find($upgrade_prompt_plan_id)->name ?? 'Account type not found';

            if ($request->prompt_setting == '1') {
                $prompt_setting = 'yes';
            } else {
                $prompt_setting = 'no';
            }
            $data = [
                'upgrade_prompt_plan_id' => $upgrade_prompt_plan_id,
                'prompt_setting' => $prompt_setting,
                'upgrade_prompt_plan_name' => $upgrade_prompt_plan_name
            ];
            $json_data = json_encode($data);
            $this->user_setting->updatUserSetting('upgrade_prompt', $json_data, $userId);

        }else if ($request->prompt_key == 'identity_prompt') {

            if ($request->prompt_setting == '1') {
                $prompt_setting = 'yes';
            }
            $identity_data = [
                'prompt_setting' => $prompt_setting
            ];

            $identity_json_data = json_encode($identity_data);

            $this->user_setting->updatUserSetting('identity_prompt', $identity_json_data, $userId);

        }else if ($request->prompt_key == 'account_on_hold_prompt') {


            if ($request->prompt_setting == '1') {
                $prompt_setting = 'yes';
            }
            $account_on_hold_data = [
                'prompt_setting' => $prompt_setting
            ];

            $account_on_hold_json_data = json_encode($account_on_hold_data);

            $this->user_setting->updatUserSetting('account_on_hold_prompt', $account_on_hold_json_data, $userId);

        }else if ($request->prompt_key == 'kyc_verification_prompt') {

            if ($request->prompt_setting == '1') {
                $prompt_setting = 'yes';
            }
            $kyc_verification_data = [
                'prompt_setting' => $prompt_setting
            ];

            $kyc_verification_json_data = json_encode($kyc_verification_data);

            // Save the user setting for KYC verification prompt
            $this->user_setting->updatUserSetting('kyc_verification_prompt', $kyc_verification_json_data, $userId);
        }
                // Handle Account Certificate Prompt
                else if ($request->prompt_key == 'account_certificate_prompt') {

                    $prompt_amount = $request->amount;
                    if ($request->prompt_setting == '1') {
                        $prompt_setting = 'yes';
                    }
                    $data = [
                        'prompt_amount' => $prompt_amount,
                        'prompt_setting' => $prompt_setting
                    ];
                    $json_data = json_encode($data);
                    $this->user_setting->updatUserSetting('account_certificate_prompt', $json_data, $userId);

                }

                // Handle Tax Reference Prompt
                else if ($request->prompt_key == 'tax_reference_prompt') {

                    $prompt_amount = $request->amount;
                    if ($request->prompt_setting == '1') {
                        $prompt_setting = 'yes';
                    }
                    $data = [
                        'prompt_amount' => $prompt_amount,
                        'prompt_setting' => $prompt_setting
                    ];
                    $json_data = json_encode($data);
                    $this->user_setting->updatUserSetting('tax_reference_prompt', $json_data, $userId);

                }

                // Handle Axillary System Prompt
                else if ($request->prompt_key == 'axillary_system_prompt') {

                    $prompt_amount = $request->amount;
                    if ($request->prompt_setting == '1') {
                        $prompt_setting = 'yes';
                    }

                    UserSetting::updateOrCreate(
                        ['user_id' => $userId, 'option_name' => 'axillary_system_status'],
                        ['option_value' => '0']
                    );
                    $data = [
                        'prompt_amount' => $prompt_amount,
                        'prompt_setting' => $prompt_setting
                    ];
                    $json_data = json_encode($data);
                    $this->user_setting->updatUserSetting('axillary_system_prompt', $json_data, $userId);

                }

                // Handle Trade Limit Prompt
                else if ($request->prompt_key == 'trade_limit_prompt') {

                    $prompt_amount = $request->amount;
                    if ($request->prompt_setting == '1') {
                        $prompt_setting = 'yes';
                    }
                    $data = [
                        'prompt_amount' => $prompt_amount,
                        'prompt_setting' => $prompt_setting
                    ];
                    $json_data = json_encode($data);
                    $this->user_setting->updatUserSetting('trade_limit_prompt', $json_data, $userId);

                }

                // Handle Credit Facility Approval Prompt
                else if ($request->prompt_key == 'credit_facility_approval') {

                    $prompt_amount = $request->amount;
                    if ($request->prompt_setting == '1') {
                        $prompt_setting = 'yes';
                    }
                    $data = [
                        'prompt_amount' => $prompt_amount,
                        'prompt_setting' => $prompt_setting
                    ];
                    $json_data = json_encode($data);
                    $this->user_setting->updatUserSetting('credit_facility_approval', $json_data, $userId);

                }

                // Handle Loan Facility Approval Prompt
                else if ($request->prompt_key == 'loan_facility_approval') {

                    $prompt_amount = $request->amount;
                    if ($request->prompt_setting == '1') {
                        $prompt_setting = 'yes';
                    }
                    $data = [
                        'prompt_amount' => $prompt_amount,
                        'prompt_setting' => $prompt_setting
                    ];
                    $json_data = json_encode($data);
                    $this->user_setting->updatUserSetting('loan_facility_approval', $json_data, $userId);
                }

        return response()->json(['status' => true, 'message' => 'Prompt added for this user successfully.']);

    }



    /**
     * Remove a prompt for the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function RemovePrompt(Request $request, $user_id) {
        $option_name = $request->type;
        $deleted = $this->user_setting->deleteUserSetting($user_id, $option_name);
        if ($deleted) {
            return response()->json(['status' => true, 'message' => 'Prompt removed for this user successfully.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to remove prompt.']);
        }
    }


    public function AdminChangePassword(Request $request) {
    $request->validate([
        'new_password' => 'required|min:8',
        'user_id' => 'required|integer|exists:users,id',
    ]);

    $user = User::find($request->user_id);

    if ($user) {
        $user->password = bcrypt($request->new_password);
        $user->save();
        return back()->with('success', ' User password updated successfully');
    }else{
        return back()->with('error', 'User not found');
    }


    }

}








