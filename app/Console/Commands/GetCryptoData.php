<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetCryptoData extends Command
{
    protected $signature = 'app:get-crypto-data';
    protected $description = 'Get Cryptocurrency data';

    public function handle() {
        
        Log::info("Updated crypto data command ran at " . now());

        $api_url = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=50&page=1&sparkline=false";

        // Create a stream context with the appropriate headers
        $options = [
            'http' => [
                'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3\r\n"
            ]
        ];

        $context = stream_context_create($options);

        // Fetch the data from the API
        $response = file_get_contents($api_url, false, $context);


        if ($response === FALSE) {
            Log::error('Error occurred while fetching cryptocurrency data.');
            throw new \Exception('Error occurred while fetching cryptocurrency data.');
        }

        $crypto_data = json_decode($response, true);

        if (is_array($crypto_data) && !empty($crypto_data)) {
            $crypto_list = [];

            foreach ($crypto_data as $crypto) {
                $crypto_list[] = [
                    'symbol' => $crypto['symbol'] ?? 'N/A',
                    'name' => $crypto['name'] ?? 'N/A',
                    'image' => $crypto['image'] ?? 'N/A',
                    'current_price' => $crypto['current_price'] ?? 'N/A',
                    'market_cap' => $crypto['market_cap'] ?? 'N/A',
                    'total_volume' => $crypto['total_volume'] ?? 'N/A',
                    'price_change_percentage_24h' => $crypto['price_change_percentage_24h'] ?? 'N/A',
                    'circulating_supply' => $crypto['circulating_supply'] ?? 'N/A',
                    'high_24h' => $crypto['high_24h'] ?? 'N/A',
                    'low_24h' => $crypto['low_24h'] ?? 'N/A',
                    'last_updated' => $crypto['last_updated'] ?? 'N/A',
                ];
            }

            $json_file = public_path('crypto.json');
            file_put_contents($json_file, json_encode($crypto_list, JSON_PRETTY_PRINT));

            Log::info("Cryptocurrency data saved to $json_file");
        } else {
            Log::warning("No data found in the API response.");
        }
        Log::info("Updated crypto data command ends at " . now() . PHP_EOL);
    }
}
