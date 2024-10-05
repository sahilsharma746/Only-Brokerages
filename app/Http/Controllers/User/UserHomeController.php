<?php

namespace App\Http\Controllers\User;
use App\Models\User;
use App\Models\Trade;
use App\Models\Deposit;

use App\Models\Withdraw;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use App\Models\UserAccountType;
use App\Models\UserVerifiedStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class UserHomeController extends Controller
{
  

    public function index() {
        $user_setting = new UserSetting();
        $full_data = [];
        $user = Auth::user();
        $user_data = User::with('addresses')
            ->where([['role', 'user'], ['id', $user->id]])
            ->first();
        $full_data['userVerifiedStatus'] = UserVerifiedStatus::where('user_id', $user->id)->first();

        $full_data['total_deposit'] = Deposit::getUserDepositAmount($user->id);
        $full_data['total_approved_deposit'] = Deposit::getUserDepositAmount($user->id, 'approved');

        $currentBalance = $user->balance; 

        $user_old_value = $user_setting->getUserSetting('user_old_balance', $user->id); 

        if (!$user_old_value) {
            // Set percentage to 0 if there is no old balance
            $full_data['usertotoalpercentage'] = 0;
        } else {
       
        if ($user_old_value > $currentBalance) {
            // Decrease
            $difference = $user_old_value - $currentBalance; 
            $usertotoalpercentage = ($difference / $user_old_value) * 100; 
        
        } else {
            // Increase
            $difference = $currentBalance - $user_old_value; 
            $usertotoalpercentage = ($difference / $user_old_value) * 100; 
                }
        $full_data['usertotoalpercentage']  = number_format($usertotoalpercentage, 2);

            }

        $settings = UserSetting::where('user_id', $user->id)
            ->whereIn('option_name', ['dashboard_currency', 'profile_language'])
            ->get()->keyBy('option_name');
            
        $full_data['setting_info'] = [
            'dashboard_currency' => $settings['dashboard_currency']->option_value ?? 'USD',
            'profile_language' => $settings['profile_language']->option_value ?? 'en',
        ];
        $user_verifications = UserVerifiedStatus::where('user_id', $user->id)->first();

        $full_data['user_verifications'] = $user_verifications;
        $full_data['countries'] = config('countries');
        $full_data['languages'] = config('languages');
        $full_data['currencies'] = config('currencies');
        $kycTypes = config('settingkeys.kyc_type');
        $full_data['user_data'] = $user_data;


        $full_data['totalAdminCreditDeposits'] = Deposit::where('user_id', $user->id)
            ->where('payment_method', 'admin_credit')
            ->sum('amount');

        $full_data['totalAdminLoanDeposits'] = Deposit::where('user_id', $user->id)
            ->where('payment_method', 'admin_loan')
            ->sum('amount');

        $full_data['totalAdminDeposits'] = Deposit::where('user_id', $user->id)
            ->whereIn('payment_method', ['admin_credit', 'admin_loan'])
            ->sum('amount');

        $totalCapital = $full_data['totalAdminDeposits'];

        if ($totalCapital > 0) {
            $full_data['adminCreditPercentage'] = number_format(($full_data['totalAdminCreditDeposits'] / $totalCapital) * 100, 2);

            $full_data['adminLoanPercentage'] = number_format(($full_data['totalAdminLoanDeposits'] / $totalCapital) * 100, 2);
        } else {
            $full_data['adminCreditPercentage'] = 0;
            $full_data['adminLoanPercentage'] = 0;
        }


        $full_data['totalAmountWinTrade'] = Trade::where('user_id', $user->id)->where('trade_result', 'win')->sum('capital');
        $full_data['totalAmountLossTrade'] = Trade::where('user_id', $user->id)->where('trade_result', 'loss')->sum('capital');
        
        $full_data['totalWinAmount'] = Trade::where('user_id', $user->id)
                                            ->where('trade_result', 'win')
                                            ->sum('pnl');
        $full_data['totalLossAmount'] = Trade::where('user_id', $user->id)
                                        ->where('trade_result', 'loss')
                                        ->selectRaw('SUM(ABS(pnl)) as total_loss') // Sum absolute values
                                        ->value('total_loss'); // Get the result

        if( $full_data['totalAmountWinTrade'] > 0 ) {
            $full_data['win_percentage'] = ($full_data['totalWinAmount'] / $full_data['totalAmountWinTrade']) * 100;
        }else{
            $full_data['win_percentage'] = 0;
        }

        if( $full_data['totalAmountLossTrade'] > 0 ) {
            $full_data['loss_percentage'] = ($full_data['totalLossAmount'] / $full_data['totalAmountLossTrade']) * 100;
        }else{
            $full_data['loss_percentage'] = 0;
        }

        $full_data['win_percentage'] = number_format($full_data['win_percentage'], 2);
        $full_data['loss_percentage'] = number_format($full_data['loss_percentage'], 2);

        $full_data['totalTradesCount'] = Trade::where('user_id', $user->id)->count();
        $full_data['totalWinTradesCount'] = Trade::where('user_id', $user->id)
                                            ->where('trade_result', 'win')
                                            ->count();

        if ($full_data['totalTradesCount'] > 0) {
            $full_data['winPercentage'] = ($full_data['totalWinTradesCount'] / $full_data['totalTradesCount']) * 100;
        } else {
            $full_data['winPercentage'] = 0;
        }
        $full_data['winPercentage'] = number_format($full_data['winPercentage'], 2) ;

        return view('users.index', compact('full_data','kycTypes'));
    }
    

    public function news() {
        return view('users.news');
    }
}
