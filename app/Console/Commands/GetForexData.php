<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetForexData extends Command
{
    protected $signature = 'app:get-forex-data';
    protected $description = 'Get combined Forex data from FCS API';
    protected $api_key = 'rtF3NH0L4i1DSkKZlCmVXc';

    public function handle() {

        Log::info("Updated Forex data command ran at " . now());

        // Step 1: Get the list of Forex pairs
        $list_url = "https://fcsapi.com/api-v3/forex/list?type=forex&access_key=$this->api_key";
        $forex_list = $this->makeApiRequest($list_url);

        if (!$forex_list || !isset($forex_list['response'])) {
            Log::error('Error fetching Forex list.');
            return;
        }

        // Extract the first 50 symbols and their IDs
        $forex_ids = [];
        $symbols = [];
        $combined_data = [];
        foreach (array_slice($forex_list['response'], 0, 150) as $pair) {
            $forex_ids[] = $pair['id'];
            $symbols[] = $pair['symbol'];
            $combined_data[$pair['symbol']] = [
                'name' => $pair['name'],
                'symbol' => $pair['symbol']
            ];
        }

        // Join the symbols into a comma-separated string for the profile API call
        $symbols_string = implode(',', $symbols);

        // Step 2: Get the base and quote currency icons using the profile API
        $profile_url = "https://fcsapi.com/api-v3/forex/profile?symbol=$symbols_string&access_key=$this->api_key";
        $profile_data = $this->makeApiRequest($profile_url);

        if (!$profile_data || !isset($profile_data['response'])) {
            Log::error('Error fetching Forex profile data.');
            return;
        }

        // Store icons based on currency short names
        $currency_icons = [];
        foreach ($profile_data['response'] as $profile) {
            $currency_icons[$profile['short_name']] = $profile['icon'];
        }

        // Step 3: Combine the icon URLs with the base and quote currencies
        foreach ($combined_data as $symbol => &$data) {
            list($base_currency, $quote_currency) = explode('/', $symbol);

            $base_icon = $currency_icons[$base_currency] ?? null;
            $quote_icon = $currency_icons[$quote_currency] ?? null;
        
            // Skip assets if either base or quote currency icon is not available
            if (!$base_icon || !$quote_icon) {
                unset($combined_data[$symbol]);
                continue;
            }
        
            $data['base_currency_image'] = $base_icon;
            $data['quote_currency_image'] = $quote_icon;
        }


        // Step 4: Get the latest price data
        $ids_string = implode(',', $forex_ids);
        $latest_url = "https://fcsapi.com/api-v3/forex/latest?id=$ids_string&access_key=$this->api_key";
        $latest_data = $this->makeApiRequest($latest_url);

        if (!$latest_data || !isset($latest_data['response'])) {
            Log::error('Error fetching Forex latest data.');
            return;
        }

        foreach ($latest_data['response'] as $latest) {
            $symbol = $latest['s'];
            if (isset($combined_data[$symbol])) {
                $combined_data[$symbol]['current_price'] = $latest['c'];
                $combined_data[$symbol]['percentage_change'] = $latest['cp'];
                $combined_data[$symbol]['open_price'] = $latest['o'];
                $combined_data[$symbol]['high_24h'] = $latest['h'];
                $combined_data[$symbol]['low_24h'] = $latest['l'];
                $combined_data[$symbol]['price_change'] = $latest['ch'];
                $combined_data[$symbol]['last_updated'] = $latest['tm'];
            }
        }

        // Save data to a JSON file
        $json_file = public_path('forex.json');
        file_put_contents($json_file, json_encode(array_values($combined_data), JSON_PRETTY_PRINT));

        Log::info("Forex data saved to $json_file");

        Log::info("Updated Forex data command ends at " . now() . PHP_EOL);
    }

    // Helper function to make API requests
    private function makeApiRequest($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: Mozilla/5.0'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}


function pr($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}   