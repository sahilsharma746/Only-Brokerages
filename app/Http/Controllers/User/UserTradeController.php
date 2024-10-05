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



class UserTradeController extends Controller
{

    public function index() {

        $user = Auth::user();
        $user_id = $user->id;
        
        $trades = Trade::where('user_id', $user_id)->where('status', 0)
        ->get();
      
        $user_setting = new UserSetting();
        
        $user_trade_percentage = $user_setting->getUserSetting('trade_percentage', $user_id);

        if ( $user_trade_percentage === false) {
            $user_trade_percentage = $user_trade_percentage === false ? 10 : $user_trade_percentage;
        }
   
        $user_balance = $user->balance;

        return view('users.trade.index', compact('user_balance','user_trade_percentage','trades'));
    }


    public function storeTrades(Request $request) {

        $user = Auth::user();
        $user_id = $user->id;
        $user_setting = new UserSetting();

        $user_trade_result = $user_setting->getUserSetting('trade_result', $user_id);

        if ($user_trade_result == false ) {
            $user_trade_result = $user_trade_result == false ? 'random' : $user_trade_result;
        }

        if ($user_trade_result == 'random') {
            $user_trade_result = rand(1, 2) == 1 ? 'win' : 'loss';
        }

        $validate_data =  $request->validate([
            'name' => 'required',
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
            'created_at' => date('Y-m-d h:i:s'), 
            'updated_at' => date('Y-m-d h:i:s')
        ];

        $trade = Trade::create( $data);

        return redirect()->back()->with('success', 'Your trade has been successfully placed!');
    }
    
    public function tradingHistoryView(){
        $user = Auth::user();
        $user_id = $user->id;
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
        $user_trades = [];
        return view('users.trading-bots.index', compact('user_trades'));
    }


 


}




