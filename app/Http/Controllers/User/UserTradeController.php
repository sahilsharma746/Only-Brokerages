<?php

namespace App\Http\Controllers\User;


use App\Models\User;
use App\Models\Trade;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PDF;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use App\Models\TradingBot;
use App\Models\Deposit;
use App\Models\TradingBotJobs;
use App\Models\BotTradeRelation;
use App\Models\StiteSettings;

class UserTradeController extends Controller
{


    public $user_setting;
    public $site_setting;
    public function __construct() {
        $this->user_setting = new UserSetting();
        $this->site_setting = new StiteSettings();

    }

    public function index() {

        $user = Auth::user();
        $user_id = $user->id;

        $trades = Trade::where('user_id', $user_id)->where('status', 0)
        ->get();

        $user_trade_percentage = $this->user_setting->getUserSetting('trade_percentage', $user_id);

        if ( $user_trade_percentage === false) {
            $user_trade_percentage = $user_trade_percentage === false ? 10 : $user_trade_percentage;
        }

        $user_balance = $user->balance;

        $axillary_system_status = $this->user_setting->getUserSetting('axillary_system_status', $user_id);
        $trading_bot_status = $this->user_setting->getUserSetting('trading_bot_status', $user_id);

        $full_data['setting_info'] = [
            'axillary_system_status' => $axillary_system_status ? $axillary_system_status : '0',
            'trading_bot_status' => $trading_bot_status ? $trading_bot_status : '0'
        ];

        return view('users.trade.index', compact('user_balance','user_trade_percentage','trades','full_data'));
    }


    public function storeTrades(Request $request) {

        $user = Auth::user();
        $user_id = $user->id;

        $user_trade_result = $this->user_setting->getUserSetting('trade_result', $user_id);

        if ($user_trade_result == false ) {
            $user_trade_result = $user_trade_result == false ? 'random' : $user_trade_result;
        }

        if ($user_trade_result == 'random') {
            $user_trade_result = rand(1, 2) == 1 ? 'win' : 'loss';
        }
        $validate_data =  $request->validate([
            'name' => 'required',
            'asset_market'=>'required|string',
            'margin' => 'required|numeric',
            'contract_size' => 'required|numeric',
            'amount' => 'required|numeric|min:1',
            'units' => 'required|numeric',
            'payout' => 'required|numeric',
            'fees' => 'required|numeric',
            'action' => 'required|string',
            'time_frame' => ['required', 'string', 'not_in:0'],
            'trade_result_percentage' => 'required|numeric',

        ], [
            'time_frame.not_in' => 'Please select the time frame',
            'amount.required' => 'The amount field is required.',
        ]);

        $trade_result_percentage = $validate_data['trade_result_percentage'];
        $contract_size = $request->contract_size;

        $win_loss_amount = ($trade_result_percentage / 100) * $contract_size;
        $amount = $request->amount;
        $user_balance =  $user->balance;
        $total_user_balance = $user_balance - $amount ;

        User::where('id', $user_id)->update([
            'balance' => $total_user_balance
        ]);

        if($user_trade_result == 'win'){
            $trade_result_amount =  $amount + ($win_loss_amount);
        } else {
            $trade_result_amount = $amount - ($win_loss_amount);
        }

        $trade_win_loss_amount = abs($trade_result_amount) - abs($win_loss_amount);
        $image = ( $request->image) ? $request->image : 'no_image.png';

        $data = [
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'asset' => $request->name,
            'market'=>$request->asset_market,
            'margin' => (int) $request->margin,
            'contract_size' => (float)$request->contract_size,
            'capital' => (float)$request->amount,
            'trade_type' => 'live',
            'entry' => (float)$request->price,
            'units' => (float)$request->units,
            'pnl' => (float)$trade_result_amount,
            'fees' => (float)$request->fees,
            'order_type' => $request->action,
            'time_frame' => $request->time_frame,
            'trade_result' => $user_trade_result,
            'admin_trade_result_percentage' => (float)$request->trade_result_percentage,
            'image'=>   $image,
            'trade_execution_method' => 'manual',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')
        ];
        $trade = Trade::create( $data);

        return redirect()->back()->with('success', 'Your trade has been successfully placed!');
    }

    public function tradingHistoryView(){
        $user = Auth::user();
        $user_id = $user->id;
        $full_data = [];
        $trades = Trade::where('user_id', $user_id)
        ->where('status', 1)
        ->get();

        return view('users.trading-history.index', compact('trades'));

    }

    public function generatePDF()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $trades = Trade::where('user_id', $user_id)->where('status', 1)
        ->get();

        $pdf = PDF::loadView('users.trading-history.trade-history-download-pdf', ['trades' => $trades]);

        return $pdf->download('trading_history.pdf');
    }

    public function tradingBotsView(){
        $user = Auth::user();
        $user_id = $user->id;
        $trading_bots = TradingBot::all();
        $activatedBotsJson = $this->user_setting->getUserSetting('activated_bots', $user_id);
        $activatedBots = json_decode($activatedBotsJson, true) ?: [];
        return view('users.trading-bots.index', compact('trading_bots', 'activatedBots'));
    }


    public function tradingBotsDeposit(Request $request)
{
    $trading_bots_deposit = $request->deposit_amount;
    $bot_id = $request->bot_id;
    $user = auth()->user();
    $user_balance = $user->balance;

    if ($trading_bots_deposit > $user_balance) {
        return response()->json([
            'success' => false,
            'message' => 'Insufficient balance.',
            'bot_id'=> $bot_id,
            'deposit_amount' => $trading_bots_deposit,
        ]);
    } else {
        return response()->json([
            'success' => true,
            'message' => ' sufficient balance.',
            'bot_id'=> $bot_id,
            'deposit_amount' => $trading_bots_deposit,
        ]);
    }
}
    public function checktradingBotslicenseKey(Request $request)
{
    $user = auth()->user();
    $user_id = $user->id;

    $botJob = new TradingBotJobs();

    $botJob->user_id = $user_id;
    $botJob->bot_id = $request->bot_id;
    $botJob->license_key = $request->user_license_key;
    $botJob->save();

    return redirect()->back()->with('success', 'Your trading bot has been successfully activated!');
}


public function saveBotkey(Request $request)
{
    $user = auth()->user();
    $user_id = $user->id;

    $botIds = $request->bot_id;

    $existingData = $this->user_setting->getUserSetting('activated_bots', $user_id);

    if (!empty($existingData)) {
        $existingBotIds = json_decode($existingData, true);

        if (is_array($existingBotIds)) {
            if (!in_array($botIds, $existingBotIds)) {
                $existingBotIds[] = $botIds;
            }

            $jsonData = json_encode($existingBotIds);
        } else {
            $jsonData = json_encode([$botIds]);
        }
    } else {
        $jsonData = json_encode([$botIds]);
    }
    $this->user_setting->updatUserSetting('activated_bots', $jsonData, $user_id);
    $this->user_setting->updatUserSetting('trading_bot_status','1',$user_id);

    return redirect()->back();
}

public function saveBotJobs(Request $request, $bot_id)
{
    $user = auth()->user();
    $user_id = $user->id;
    $existingJob = TradingBotJobs::where('user_id', $user_id)
                                  ->where('bot_id', $bot_id)
                                  ->first();

    if ($existingJob) {
        return redirect()->back()->with('error', 'Please wait - this bot currently has an active trading session in progress.');
      }

    $botJob = new TradingBotJobs();
    $botJob->user_id = $user_id;
    $botJob->bot_id = $bot_id;

    $botJob->status = "pending";
    $botJob->capital = $request->input('trade_amount', null);
    $botJob->trade_asset = $request->input('trade_asset', null);
    $botJob->percentage_gain_or_loss = $request->input('percentage_gain_or_loss', null);
    $botJob->trade_result = $request->input('trade_result', null);
    $botJob->market = $request->input('market', null);
    $botJob->capital = $request->input('capital', null);

    $botJob->save();

    $botJobData = TradingBotJobs::find($botJob->id);

    return redirect()->back()->with('success', 'Your auto trade is now in the queue. Please check back later for your trade transactions.')
                             ->with('botJobData', $botJobData);
}



public function historyBotJobs(Request $request, $bot_id){

    $user = auth()->user();
    $user_id = $user->id;
    $bot_name = TradingBot::find($bot_id)->name;
    $tradeIds = BotTradeRelation::where('user_id', $user_id)->where('bot_id', $bot_id)->pluck('trade_id');

    $tradesData = Trade::where('user_id', $user_id)->whereIn('id', $tradeIds)->where('processed', 1)
    ->where('status', 1)->get();

    return view('users.trading-bots.bot-history', compact('tradesData', 'bot_name'));
}


public function checkEnableDisableBotStatus()
 {

    // $this->site_setting->getSetting('enable_disable_software', $status,'enable_disable_software');
    $status = $this->site_setting->getSetting('enable_disable_software','enable_disable_software' );

    return response()->json(['status' => $status]);
}






}




