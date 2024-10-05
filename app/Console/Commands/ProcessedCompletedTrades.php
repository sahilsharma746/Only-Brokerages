<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Trade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessedCompletedTrades extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:processed-completed-trades';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the processed complete trades every 10 minutes';

    /**
     * Execute the console command.
     */
    public function handle(){

        Log::info("Processed completed trades command ran at " . now());

        // Fetch trades where processed = 0 and status = 1
        $trades = Trade::where('status', '1')
                    ->where('processed', '0')
                    ->get();

        foreach ($trades as $trade) {
            $user_id = $trade->user_id;
            $trade_win_loss_amount = $trade->pnl; 
            $user_trade_result = $trade->trade_result; 
            $user = User::find($user_id);

            if ($user) { 
                $user->balance += $trade_win_loss_amount;

                // Save the updated user balance
                $user->save();

                // Log user balance update
                Log::info("User ID: {$user_id}, New Balance: {$user->balance}, Result: {$user_trade_result}, Amount: {$trade_win_loss_amount}");

                // Mark trade as processed
                $trade->processed = 1;
                $trade->save(); // Save the trade to update the processed status

            } else {
                Log::warning("User not found for User ID: {$user_id}");
            }
        }
        
        Log::info("Processed completed trades command ends at " . now() . PHP_EOL);
    }
}
