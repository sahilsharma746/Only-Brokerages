<?php

namespace App\Http\Controllers\Admin;

use App\Models\TradingBot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\TradingBotJobs;
use App\Models\User;
use App\Models\BotTradeRelation;
use App\Models\Trade;
use App\Models\StiteSettings;
use App\Models\UserSetting;

class AdminSoftwareController extends Controller
{


    public $site_setting;

    public function __construct()
    {
        $this->site_setting = new StiteSettings();
    }
    public function getSoftwares()
    {

        $tradingBots = TradingBot::all();
        return view('admin.software.index',compact('tradingBots'));
    }

    public function saveSoftware(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'deposit_amount' => 'required|numeric',
            'license_key' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Define the base upload path
        $base_path = public_path('uploads/trading_bot/');

        // Create the directory if it doesn't exist
        if (!File::exists($base_path)) {
            File::makeDirectory($base_path, 0755, true);
        }

        // Handle the uploaded image
        $file = $request->file('image');
        $file_name = time() . '-image.' . $file->getClientOriginalExtension();
        $file->move($base_path, $file_name);

        // Create a new TradingBot instance and fill it with validated data
        $tradingBot = TradingBot::create([
            'name' => $validatedData['name'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'deposit_amount' => $validatedData['deposit_amount'],
            'license_key' => $validatedData['license_key'],
            'image' => $file_name,
        ]);

        return back()->with('success', 'Your request submitted successfully!');
    }

    public function updateSoftwares(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'nullable|string|max:255',
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'deposit_amount' => 'nullable|numeric',
        'license_key' => 'nullable|string|max:255',
    ]);

    $bot = TradingBot::findOrFail($request->id);

    if (isset($validatedData['name'])) {
        $bot->name = $validatedData['name'];
    }
    if (isset($validatedData['title'])) {
        $bot->title = $validatedData['title'];
    }
    if (isset($validatedData['description'])) {
        $bot->description = $validatedData['description'];
    }
    if (isset($validatedData['deposit_amount'])) {
        $bot->deposit_amount = $validatedData['deposit_amount'];
    }
    if (isset($validatedData['license_key'])) {
        $bot->license_key = $validatedData['license_key'];
    }

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $base_path = public_path('uploads/trading_bot/');
        $file_name = time() . '-image.' . $file->getClientOriginalExtension();
        $file->move($base_path, $file_name);
        $bot->image = $file_name;
    }

    $bot->save();
    return response()->json(['status' => 'success', 'message' => 'Trading bot updated successfully!']);
}


public function enableDisableSoftwares(Request $request)
{

    $validatedData  = $request->validate([
        'status' => 'required|in:enable,disable',
    ]);
    $status = $validatedData['status'];
    $this->site_setting->setSetting('enable_disable_software', $status,'enable_disable_software');
    return response()->json(['status' => 'success', 'message' => 'Trading bot updated successfully!']);
}



    public function deleteSoftwares($id){
        $bot = TradingBot::findOrFail($id);

        $bot->delete();

        return back()->with('success', 'Trading bot DELETED successfully.');

    }

    public function editSoftwares($bot_id){
        $bot_name = TradingBot::findOrFail($bot_id)->name;
        $tradeIds = BotTradeRelation::where('bot_id', $bot_id)->pluck('trade_id');
        $tradesData = Trade::whereIn('id', $tradeIds)->where('processed', 1)->where('status', 1)->get();
        return view('admin.software.history',compact('tradesData','bot_name'));
    }

    public function editBotInfomation(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|integer',
        'bot_id' => 'required|integer',
        'bot_trade_result' => 'required|string',
        'bot_percentage' => 'required|numeric|min:0|max:100',
        'bot_duration' => 'required|string',
        'bot_market' => 'required|string',
        'bot_asset' => 'required|string|max:255',
        'bot_capital' => 'required|numeric|min:0',
        'bot_trade_count' => 'required|numeric|min:0',
        'margin' => 'required|numeric|min:0',
        'order_type' => 'required|string',
    ]);


    $user_id = $validatedData['user_id'];
    $bot_id = $validatedData['bot_id'];

    $user = User::find($user_id);
    $balance = $user->balance;

    $alltradeamount = $validatedData['bot_trade_count'] * $validatedData['bot_capital'];

    if ($balance < $alltradeamount) {
        return response()->json(['status' => 'insufficient_amount', 'message' => 'Insufficient balance!']);
    }

    TradingBotJobs::updateOrCreate(
        [
            'user_id' => $user_id,
            'bot_id' => $bot_id,
        ],
        [
            'trade_result' => $validatedData['bot_trade_result'],
            'percentage_gain_or_loss' => $validatedData['bot_percentage'],
            'market' => $validatedData['bot_market'],
            'trade_asset' => $validatedData['bot_asset'],
            'capital' => $validatedData['bot_capital'],
            'time_frame' => $validatedData['bot_duration'],
            'trade_count' => $validatedData['bot_trade_count'],
            'order_type' => $validatedData['order_type'],
            'margin' => $validatedData['margin'],
            'status' => 'in_progress',
        ]
    );

    return response()->json(['status' => 'success', 'message' => 'Trading bot information updated successfully!']);
}



    function deleteBotInfomation(Request $request){
        // dd($request);
    }




}
