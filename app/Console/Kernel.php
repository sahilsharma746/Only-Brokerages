<?php

namespace App\Console;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\UpdatedTradesStatus;
use App\Console\Commands\ProcessedCompletedTrades;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\ProcessedCompletedTrades::class,
        \App\Console\Commands\UpdatedTradesStatus::class,
    ];
    

    protected function schedule(Schedule $schedule){
        $schedule->command('app:processed-completed-trades')->everyMinute();
        $schedule->command('app:updated-trades-status')->everyMinute();

        $schedule->command('app:get-crypto-data')->twiceDaily(1, 13);
        $schedule->command('app:get-forex-data')->twiceDaily(1, 13);
        // $schedule->command('app:get-indices-data')->twiceDaily(1, 13);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
