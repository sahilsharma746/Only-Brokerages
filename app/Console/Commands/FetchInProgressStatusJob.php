<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TradingBotJobs;
use App\Models\Trade;
use App\Models\User;
use App\Models\UserSetting;
use App\Models\BotTradeRelation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Exception;

class FetchInProgressStatusJob extends Command
{
    protected $signature = 'app:fetch-in-progress-job';
    protected $description = 'Process in-progress trading bot jobs';

    public function handle()
    {
        Log::info("Start processing in-progress trading bot jobs " . now());

        try {
            $botJobs = TradingBotJobs::where('status', 'in_progress')->get();

            if ($botJobs->isEmpty()) {
                Log::info("No 'in-progress' jobs found. Exiting.");
                return;
            }

            foreach ($botJobs as $job) {
                $bot_id = $job->bot_id;
                $user_id = $job->user_id;
                $user = User::find($user_id);
                $balance = $user->balance;

                $this->info("Processing job ID: {$job->id}");
                $trade_count = $job->trade_count;

                for ($i = 0; $i < $trade_count; $i++) {
                    $margin = $job->margin;
                    $capital = $job->capital;
                    $contract_size = $margin * $capital;
                    $market = strtolower($job->market);
                    $symbol = strtolower($job->trade_asset);
                    $filePath = public_path("{$market}.json");

                    $priceKey = ($market === 'futures') ? 'regularMarketPrice' : 'current_price';
                    $imageKey = match ($market) {
                        'crypto' => 'image',
                        'forex' => 'base_currency_image',
                        'indices' => 'logo',
                        'etfs', 'futures' => 'logo_url',
                        'stocks' => 'logo',
                        default => 'image',
                    };

                    if ($market === 'futures') {
                        $symbol .= '=f';
                    }

                    if (file_exists($filePath)) {
                        $data = json_decode(file_get_contents($filePath), true);
                        $asset = collect($data)->first(function ($item) use ($symbol) {
                            return strtolower($item['symbol']) === $symbol;
                        });

                        if ($asset) {
                            $price = $asset[$priceKey];
                            $image = $asset[$imageKey];
                            $asset_unit_price = $contract_size / $price;
                            $gain_loss_amount = ($job->percentage_gain_or_loss / 100) * $contract_size;
                            $pnl = $job->trade_result === 'win'
                                ? $job->capital + $gain_loss_amount
                                : $job->capital - $gain_loss_amount;

                            $trading_amount = $capital * $trade_count;
                            $user_balance = $balance - $trading_amount;
                            $user->balance = $user_balance;
                            $user->save();

                            date_default_timezone_set($user->time_zone);
                            $user_time_zone = Carbon::now($user->time_zone)->format('Y-m-d H:i:s');
                            $trade = Trade::create([
                                'user_id' => $job->user_id,
                                'asset' => $job->trade_asset,
                                'name' => $job->trade_asset,
                                'market'=>$job->market,
                                'capital' => $job->capital,
                                'time_frame' => $job->time_frame,
                                'trade_type' => 'live',
                                'admin_trade_result_percentage' => $job->percentage_gain_or_loss,
                                'status' => 0,
                                'trade_execution_method' => 'auto',
                                'trade_result' => $job->trade_result,
                                'contract_size' => $contract_size,
                                'pnl' => $pnl,
                                'margin' => $job->margin,
                                'order_type' => $job->order_type,
                                'entry' => $price,
                                'units' => $asset_unit_price,
                                'image' => $image,
                                'created_at' => $user_time_zone,
                            ]);

                            $bot = BotTradeRelation::create([
                                'user_id' => $user_id,
                                'trade_id' => $trade->id,
                                'bot_id' => $bot_id,
                                'created_at' => now(),
                            ]);
                        } else {
                            Log::warning("Asset symbol '{$symbol}' not found in {$market}.json");
                        }
                    } else {
                        Log::warning("File {$market}.json not found.");
                    }
                }

                // Update the job status to completed
                $job->update(['status' => 'completed']);
            }

            Log::info("Finished processing all jobs " . now() . PHP_EOL);

        } catch (Exception $e) {
            Log::error("Error in FetchInProgressStatusJob: " . $e->getMessage());
            $this->error("An error occurred: " . $e->getMessage());
        }
    }
}
