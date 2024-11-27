<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetStockData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-stock-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch real-time stock data for US stocks.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stocks_json_data = [];
        $apiKey = 'cs937i1r01qu0vk4lh0gcs937i1r01qu0vk4lh10';
        $exchange = 'US';
        $limit = 100;
        $counter = 0;

        $url = "https://finnhub.io/api/v1/stock/symbol?exchange=$exchange&token=$apiKey";
        $response = Http::get($url);

        if ($response->successful()) {
            $stocks = $response->json();

            foreach ($stocks as $stock) {
                $symbol = $stock['symbol'];

                if (empty($symbol)) {
                    continue;
                }

                $stock_data = [
                    'symbol' => $stock['symbol'],
                    'currency' => $stock['currency'],
                    'description' => $stock['description'],
                    'displaySymbol' => $stock['displaySymbol'],
                    'figi' => $stock['figi'],
                    'isin' => $stock['isin'] ?? 'N/A',
                    'mic' => $stock['mic'],
                    'shareClassFIGI' => $stock['shareClassFIGI'],
                    'symbol2' => $stock['symbol2'] ?? 'N/A',
                    'type' => $stock['type'],
                ];

                $profileUrl = "https://finnhub.io/api/v1/stock/profile2?symbol=$symbol&token=$apiKey";
                $stock_profile_response = Http::get($profileUrl);

                if ($stock_profile_response->successful()) {
                    $stock_profile_data = $stock_profile_response->json();

                    if (empty($stock_profile_data['logo'])) {
                        continue;
                    }

                    $stock_data = array_merge($stock_data, [
                        'country' => $stock_profile_data['country'] ?? 'N/A',
                        'currency' => $stock_profile_data['currency'] ?? 'N/A',
                        'exchange' => $stock_profile_data['exchange'] ?? 'N/A',
                        'finnhubIndustry' => $stock_profile_data['finnhubIndustry'] ?? 'N/A',
                        'ipo' => $stock_profile_data['ipo'] ?? 'N/A',
                        'logo' => $stock_profile_data['logo'] ?? 'N/A',
                        'marketCapitalization' => $stock_profile_data['marketCapitalization'] ?? 'N/A',
                        'name' => $stock_profile_data['name'] ?? 'N/A',
                        'phone' => $stock_profile_data['phone'] ?? 'N/A',
                        'shareOutstanding' => $stock_profile_data['shareOutstanding'] ?? 'N/A',
                        'ticker' => $stock_profile_data['ticker'] ?? 'N/A',
                        'weburl' => $stock_profile_data['weburl'] ?? 'N/A',
                    ]);
                } else {
                    Log::error("Error fetching profile data for $symbol.");
                    continue;
                }

                $quoteUrl = "https://finnhub.io/api/v1/quote?symbol=$symbol&token=$apiKey";
                $stock_market_response = Http::get($quoteUrl);

                if ($stock_market_response->successful()) {
                    $stock_market_data = $stock_market_response->json();

                    if (empty($stock_market_data['c']) || empty($stock_market_data['dp'])) {
                        continue;
                    }

                    $stock_data = array_merge($stock_data, [
                        'current_price' => $stock_market_data['c'] ?? 'N/A',
                        'change' => $stock_market_data['d'] ?? 'N/A',
                        'percent_change' => $stock_market_data['dp'] ?? 'N/A',
                        'high' => $stock_market_data['h'] ?? 'N/A',
                        'low' => $stock_market_data['l'] ?? 'N/A',
                        'open' => $stock_market_data['o'] ?? 'N/A',
                        'previous_close' => $stock_market_data['pc'] ?? 'N/A',
                    ]);
                } else {
                    Log::error("Error fetching market data for $symbol.");
                    continue;
                }

                $stocks_json_data[$symbol] = $stock_data;
                $counter++;

                if ($counter >= $limit) {
                    break;
                }
            }

            if (!empty($stocks_json_data)) {
                $json_file = public_path('stocks.json');
                file_put_contents($json_file, json_encode(array_values($stocks_json_data), JSON_PRETTY_PRINT));

                Log::info("Stock data saved to $json_file");
            } else {
                Log::warning("No valid stock data to save.");
            }

        } else {
            $this->error('Failed to fetch stock data. Status: ' . $response->status());
        }
    }
}
