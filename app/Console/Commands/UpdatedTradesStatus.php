<?php

namespace App\Console\Commands;

use App\Models\Trade;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\User;


class UpdatedTradesStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:updated-trades-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
 
    
     public function handle() {

        Log::info("Updated trades status command ran at " . now());
     
        $trades = Trade::where('status', '0')->get();
         
        foreach ($trades as $trade) {
             // Ensure the time frame is set
             $user_id = $trade->user_id;
             $user = User::where('id', $user_id)->first();
             $user_timezone = $user->time_zone;
             if (empty($trade->time_frame)) {
                Log::info( "Time frame is not set for trade ID: " . $trade->id . PHP_EOL );
                 continue;
             }
     
             preg_match('/(\d+)\s*(\w+)/', $trade->time_frame, $matches);
             
             if (count($matches) !== 3) {
                Log::info( "Invalid time frame format for trade ID: " . $trade->id );
                 continue;
             }
     
             $time_value = (int)$matches[1];   
             $time_unit = strtolower($matches[2]);
     
             $trade_time = \Carbon\Carbon::parse($trade->created_at);
     
             // Use match to determine the complete time based on the time unit
             $trade_complete_time = match ($time_unit) {
                 'minutes' => $trade_time->addMinutes($time_value),
                 'hour', 'hours' => $trade_time->addHours($time_value),                 
                 'day', 'days' => $trade_time->addDays($time_value),
                 'week', 'weeks' => $trade_time->addWeeks($time_value),
                 'month', 'months' => $trade_time->addMonths($time_value),
                 'year' , 'years' => $trade_time->addYears($time_value),
                 default => null,
             };
     
             // If trade_complete_time is null, the time unit was invalid
             if ($trade_complete_time === null) {
                Log::info( "Invalid time unit for trade ID: " . $trade->id );
                 continue;
             }
     
             $current_time = Carbon::now($user_timezone);
             if ($current_time >= $trade_complete_time) {
                 $trade->status = 1;
                 $trade->save();
            
                 Log::info( "Trade status updated to 1 for user_id: " . $trade->user_id . " at " . $current_time->format('Y-m-d H:i:s') );
            
                } else {
                 $time_remaining = $current_time->diff($trade_complete_time);
                 $remaining_string = sprintf(
                     '%d days, %d hours, %d minutes, %d seconds',
                     $time_remaining->d,
                     $time_remaining->h,
                     $time_remaining->i,
                     $time_remaining->s
                 );
     
                 $for_humans = $trade_complete_time->diffForHumans($current_time, [
                     'parts' => 4,
                     'short' => true,
                     'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE
                 ]);
     
                 Log::info( "Time remaining for trade to complete: " . $for_humans . " for user id " . $trade->user_id . ":" );
             }
         }

         Log::info("Updated trades status command ends at " . now() . PHP_EOL);
     }
    
}