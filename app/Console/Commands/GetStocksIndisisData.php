<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetStocksIndisisData extends Command
{
    protected $signature = 'app:get-indices-data';
    protected $description = 'Get combined Indices data from FCS API';

    public function handle() {
        $api_key = 'rtF3NH0L4i1DSkKZlCmVXc';

        // Step 1: Get the list of indices for all specified countries in a single request
        $countries = ['united-states', 'switzerland', 'germany', 'france', 'sweden'];
        $countries_string = implode(',', $countries);
        $list_url = "https://fcsapi.com/api-v3/stock/indices?country=$countries_string&access_key=$api_key";
        $indices_list = $this->makeApiRequest($list_url);

        if (!$indices_list || !isset($indices_list['response'])) {
            Log::error('Error fetching indices list.');
            return;
        }

        $index_ids = [];
        $combined_data = [];

        // Step 2: Loop through the response to extract up to 10 indices per country
        $country_counts = array_fill_keys($countries, 0); // Initialize counters for each country
        foreach ($indices_list['response'] as $index) {
            $country = $index['country'];
            if (isset($country_counts[$country]) && $country_counts[$country] < 10) {
                $index_ids[] = $index['index_id'];
                $combined_data[$index['index_name']] = [
                    'name' => $index['index_name'],
                    'full_name' => $index['full_name'],
                    'country' => $index['country'],
                    'index_id' => $index['index_id'],
                    'icon' => $this->getCountryFlag($index['country']) // Get the flag icon
                ];
                $country_counts[$country]++; // Increment the counter for the country
            }
        }

        // Step 3: Get the latest indices price data
        $ids_string = implode(',', $index_ids);
        $latest_url = "https://fcsapi.com/api-v3/stock/indices_latest?id=$ids_string&access_key=$api_key";
        $latest_data = $this->makeApiRequest($latest_url);

        if (!$latest_data || !isset($latest_data['response'])) {
            Log::error('Error fetching latest indices data.');
            return;
        }

        // Combine latest data with the indices list
        foreach ($latest_data['response'] as $latest) {
            $index_name = $latest['name'];
            if (isset($combined_data[$index_name])) {
                $combined_data[$index_name]['current_price'] = isset($latest['c']) ? $latest['c'] : 'N/A';
                $combined_data[$index_name]['high'] = isset($latest['h']) ? $latest['h'] : 'N/A';
                $combined_data[$index_name]['low'] = isset($latest['l']) ? $latest['l'] : 'N/A';
                $combined_data[$index_name]['price_change'] = isset($latest['ch']) ? $latest['ch'] : 'N/A';
                $combined_data[$index_name]['percentage_change'] = isset($latest['cp']) ? $latest['cp'] : 'N/A';
                $combined_data[$index_name]['last_updated'] = isset($latest['dateTime']) ? $latest['dateTime'] : 'N/A';
            }
        }

        // Save data to a JSON file
        $json_file = public_path('indices.json');
        file_put_contents($json_file, json_encode(array_values($combined_data), JSON_PRETTY_PRINT));

        Log::info("Indices data saved to $json_file");
    }

    // Helper function to get the country flag image URL
    private function getCountryFlag($country) {
        $country_flags = [
            'united-states' => 'https://example.com/images/flags/us.png',
            'switzerland' => 'https://example.com/images/flags/ch.png',
            'germany' => 'https://example.com/images/flags/de.png',
            'france' => 'https://example.com/images/flags/fr.png',
            'sweden' => 'https://example.com/images/flags/se.png'
        ];

        return $country_flags[strtolower($country)] ?? 'https://example.com/images/flags/default.png';
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
