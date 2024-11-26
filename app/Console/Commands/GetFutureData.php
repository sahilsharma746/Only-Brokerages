<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class GetFutureData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-future-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $symbols = [
            'GC=F', // Gold
            'MGC=F', // Micro Gold Futures
            'SI=F', // Silver
            'SIL=F', // Micro Silver Futures
            'PL=F', // Platinum
            'HG=F', // Copper
            'PA=F', // Palladium
            'CL=F', // Crude Oil
            'HO=F', // Heating Oil
            'NG=F', // Natural Gas
            'RB=F', // RBOB Gasoline
            'BZ=F', // Brent Crude Oil
            'B0=F', // Mont Belvieu LDH Propane
            'ZC=F', // Corn Futures
            'ZO=F', // Oat Futures
            'KE=F', // KC HRW Wheat Futures
            'ZR=F', // Rough Rice Futures
            'ZM=F', // Soybean Meal Futures
            'ZL=F', // Soybean Oil Futures
            'ZS=F', // Soybean Futures
            'GF=F', // Feeder Cattle Futures
            'HE=F', // Lean Hogs Futures
            'LE=F', // Live Cattle Futures
            'CC=F', // Cocoa
            'KC=F', // Coffee
            'CT=F', // Cotton
            'LBS=F', // Lumber
            'OJ=F', // Orange Juice
            'SB=F', // Sugar
            'ZS=F', // Soybean
            'HG=F', // Copper
            'RB=F', // Gasoline
            'SB=F', // Sugar
            'KC=F', // Coffee
            'CC=F', // Cocoa
            'W=F',  // Wheat
            'C=F',  // Corn
            'LE=F', // Live Cattle
            'GF=F', // Feeder Cattle
            'HE=F', // Lean Hogs
            'YO=F', // Soybean Oil
            'ZC=F', // Corn
            'ZL=F', // Soybeans
            'ZF=F', // 10 Year Treasury Note
            'ZN=F', // 5 Year Treasury Note
            'ZB=F', // 30 Year Treasury Bond
            'ZT=F', // 2 Year Treasury Note
            'XAU=F', // Gold Ounce
            'SIL=F', // Silver
            'PL=F',  // Platinum
            'NQ=F',  // Nasdaq 100
            'ES=F',  // S&P 500
            'YM=F',  // Dow Jones
            'RTY=F', // Russell 2000
            'MCD=F', // McDonald's Corp


        ];

        $logos = [
            'GC=F' => 'https://logo.clearbit.com/preciousmetals.com',
            'MGC=F' => 'https://logo.clearbit.com/preciousmetals.com',
            'SI=F' => 'https://logo.clearbit.com/preciousmetals.com',
            'SIL=F' => 'https://logo.clearbit.com/preciousmetals.com',
            'PL=F' => 'https://logo.clearbit.com/preciousmetals.com',
            'HG=F' => 'https://logo.clearbit.com/metals.com',
            'PA=F' => 'https://logo.clearbit.com/preciousmetals.com',
            'CL=F' => 'https://logo.clearbit.com/energy.com',
            'HO=F' => 'https://logo.clearbit.com/energy.com',
            'NG=F' => 'https://logo.clearbit.com/energy.com',
            'RB=F' => 'https://logo.clearbit.com/energy.com',
            'BZ=F' => 'https://logo.clearbit.com/energy.com',
            'B0=F' => 'https://logo.clearbit.com/energy.com',
            'ZC=F' => 'https://logo.clearbit.com/agriculture.com',
            'ZO=F' => 'https://logo.clearbit.com/agriculture.com',
            'KE=F' => 'https://logo.clearbit.com/agriculture.com',
            'ZR=F' => 'https://logo.clearbit.com/agriculture.com',
            'ZM=F' => 'https://logo.clearbit.com/agriculture.com',
            'ZL=F' => 'https://logo.clearbit.com/agriculture.com',
            'ZS=F' => 'https://logo.clearbit.com/agriculture.com',
            'GF=F' => 'https://logo.clearbit.com/agriculture.com',
            'HE=F' => 'https://logo.clearbit.com/agriculture.com',
            'LE=F' => 'https://logo.clearbit.com/agriculture.com',
            'CC=F' => 'https://logo.clearbit.com/agriculture.com',
            'KC=F' => 'https://logo.clearbit.com/agriculture.com',
            'CT=F' => 'https://logo.clearbit.com/agriculture.com',
            'LBS=F' => 'https://logo.clearbit.com/agriculture.com',
            'OJ=F' => 'https://logo.clearbit.com/agriculture.com',
            'SB=F' => 'https://logo.clearbit.com/agriculture.com',
            'NG=F' => 'https://logo.clearbit.com/energy.com',
            'ZS=F' => 'https://logo.clearbit.com/agriculture.com',
            'HG=F' => 'https://logo.clearbit.com/metals.com',
            'RB=F' => 'https://logo.clearbit.com/fuels.com',
            'SB=F' => 'https://logo.clearbit.com/agriculture.com',
            'KC=F' => 'https://logo.clearbit.com/agriculture.com',
            'CC=F' => 'https://logo.clearbit.com/agriculture.com',
            'OJ=F' => 'https://logo.clearbit.com/agriculture.com',
            'W=F' => 'https://logo.clearbit.com/agriculture.com',
            'C=F' => 'https://logo.clearbit.com/agriculture.com',
            'LE=F' => 'https://logo.clearbit.com/agriculture.com',
            'GF=F' => 'https://logo.clearbit.com/agriculture.com',
            'HE=F' => 'https://logo.clearbit.com/agriculture.com',
            'YO=F' => 'https://logo.clearbit.com/agriculture.com',
            'ZC=F' => 'https://logo.clearbit.com/agriculture.com',
            'ZL=F' => 'https://logo.clearbit.com/agriculture.com',
            'ZF=F' => 'https://logo.clearbit.com/finance.com',
            'ZN=F' => 'https://logo.clearbit.com/finance.com',
            'ZB=F' => 'https://logo.clearbit.com/finance.com',
            'ZT=F' => 'https://logo.clearbit.com/finance.com',
            'XAU=F' => 'https://logo.clearbit.com/preciousmetals.com',
            'SIL=F' => 'https://logo.clearbit.com/preciousmetals.com',
            'PL=F' => 'https://logo.clearbit.com/preciousmetals.com',
            'NQ=F' => 'https://logo.clearbit.com/finance.com',
            'ES=F' => 'https://logo.clearbit.com/finance.com',
            'YM=F' => 'https://logo.clearbit.com/finance.com',
            'RTY=F' => 'https://logo.clearbit.com/finance.com',
            'MCD=F' => 'https://logo.clearbit.com/fastfood.com',


        ];

        $companyNames = [
            'GC=F' => 'Gold',
            'MGC=F' => 'Micro Gold',
            'SI=F' => 'Silver',
            'SIL=F' => 'Micro Silver',
            'PL=F' => 'Platinum',
            'HG=F' => 'Copper',
            'PA=F' => 'Palladium',
            'CL=F' => 'Crude Oil',
            'HO=F' => 'Heating Oil',
            'NG=F' => 'Natural Gas',
            'RB=F' => 'RBOB Gasoline',
            'BZ=F' => 'Brent Crude Oil',
            'B0=F' => 'Mont Belvieu LDH Propane',
            'ZC=F' => 'Corn',
            'ZO=F' => 'Oats',
            'KE=F' => 'KC HRW Wheat',
            'ZR=F' => 'Rough Rice',
            'ZM=F' => 'Soybean Meal',
            'ZL=F' => 'Soybean Oil',
            'ZS=F' => 'Soybeans',
            'GF=F' => 'Feeder Cattle',
            'HE=F' => 'Lean Hogs',
            'LE=F' => 'Live Cattle',
            'CC=F' => 'Cocoa',
            'KC=F' => 'Coffee',
            'CT=F' => 'Cotton',
            'LBS=F' => 'Lumber',
            'OJ=F' => 'Orange Juice',
            'SB=F' => 'Sugar',
            'CL=F' => 'Crude Oil',
            'ZS=F' => 'Soybean',
            'HG=F' => 'Copper',
            'RB=F' => 'Gasoline',
            'SB=F' => 'Sugar',
            'KC=F' => 'Coffee',
            'CC=F' => 'Cocoa',
            'OJ=F' => 'Orange Juice',
            'W=F' => 'Wheat',
            'C=F' => 'Corn',
            'LE=F' => 'Live Cattle',
            'GF=F' => 'Feeder Cattle',
            'HE=F' => 'Lean Hogs',
            'YO=F' => 'Soybean Oil',
            'ZC=F' => 'Corn',
            'ZL=F' => 'Soybeans',
            'ZF=F' => '10 Year Treasury Note',
            'ZN=F' => '5 Year Treasury Note',
            'ZB=F' => '30 Year Treasury Bond',
            'ZT=F' => '2 Year Treasury Note',
            'XAU=F' => 'Gold Ounce',
            'SIL=F' => 'Silver',
            'PL=F' => 'Platinum',
            'NQ=F' => 'Nasdaq 100',
            'ES=F' => 'S&P 500',
            'YM=F' => 'Dow Jones',
            'RTY=F' => 'Russell 2000',
            'MCD=F' => 'McDonald\'s Corp',
        ];


        $client = new Client();
        $combined_data = [];
        foreach ($symbols as $symbol) {
            $url = "https://query1.finance.yahoo.com/v8/finance/chart/$symbol";

            try {
                $response = $client->get($url);
                if ($response->getStatusCode() === 200) {
                    $data = json_decode($response->getBody(), true);
                    if (empty($data['chart']['result'])) {
                        $this->warn("No data found for $symbol: may be delisted.");
                        continue;
                    }
                    $result = $data['chart']['result'][0];
                    $meta = $result['meta'];

                    $currency = $meta['currency'] ?? 'N/A';
                    $exchangeName = $meta['exchangeName'] ?? 'N/A';
                    $fullExchangeName = $meta['fullExchangeName'] ?? 'N/A';
                    $marketHigh = $meta['regularMarketDayHigh'] ?? 'Data not available';
                    $marketLow = $meta['regularMarketDayLow'] ?? 'Data not available';
                    $marketVolume = $meta['regularMarketVolume'] ?? 'Data not available';
                    $currentPrice = $meta['regularMarketPrice'] ?? 'Data not available';

                    $companyName = $companyNames[$symbol] ?? 'Unknown Company';
                    $logoUrl = $logos[$symbol] ?? 'https://logo.clearbit.com/default.com';

                    $changePercentage = isset($meta['chartPreviousClose'])
                        ? (($currentPrice - $meta['chartPreviousClose']) / $meta['chartPreviousClose']) * 100
                        : null;

                    $combined_data[] = [
                        'symbol' => $symbol,
                        'company_name' => $companyName,
                        'currency' => $currency,
                        'exchangeName' => $exchangeName,
                        'fullExchangeName' => $fullExchangeName,
                        'regularMarketDayHigh' => $marketHigh,
                        'regularMarketDayLow' => $marketLow,
                        'regularMarketVolume' => $marketVolume,
                        'regularMarketPrice' => $currentPrice,
                        'logo_url' => $logoUrl,
                        'change_percentage' => $changePercentage !== null ? round($changePercentage, 2) : 'Data not available',
                    ];

                    $this->info("Data for $companyName:");
                    $this->info("Current Price: $$currentPrice");
                    $this->info("Change Percentage: " . ($changePercentage !== null ? round($changePercentage, 2) . '%' : 'Data not available'));
                }
            } catch (ClientException $e) {
                $this->error("Error fetching data for $symbol: " . $e->getResponse()->getBody());
            }

            sleep(12);
        }

        $json_file = public_path('futures.json');
        file_put_contents($json_file, json_encode($combined_data, JSON_PRETTY_PRINT));

        Log::info("Futures data saved to $json_file");
        Log::info("Fetch futures data command ends at " . now() . PHP_EOL);
    }
}
