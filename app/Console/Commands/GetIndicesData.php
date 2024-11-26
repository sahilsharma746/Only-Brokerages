<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetIndicesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-indices-data';

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
        $apiKey = 'LgzjqouNa8hNgydNPMkyS6SsN8y8yJOj';

        $symbols = [
            'IBM', 'AAPL', 'GOOGL', 'MSFT', 'AMZN', 'FB', 'TSLA',
            'NFLX', 'NVDA', 'ADBE', 'INTC', 'CSCO', 'CMCSA',
            'V', 'JNJ', 'PG', 'DIS', 'PFE', 'VZ', 'PEP',
            'KO', 'T', 'XOM', 'WMT', 'NKE', 'MRK', 'ABT',
            'CRM', 'COST', 'NVS', 'TMO', 'MDT', 'AVGO',
            'AMGN', 'TXN', 'QCOM', 'ORCL', 'BA', 'GE',
            'F', 'GM', 'MCD', 'SBUX', 'BABA', 'SAP',
            'BIDU', 'UBER', 'LYFT', 'HPQ', 'TWTR', 'PYPL'
        ];

        $companyNames = [
            'IBM' => 'International Business Machines Corporation',
            'AAPL' => 'Apple Inc.',
            'GOOGL' => 'Alphabet Inc.',
            'MSFT' => 'Microsoft Corporation',
            'AMZN' => 'Amazon.com, Inc.',
            'FB' => 'Meta Platforms, Inc.',
            'TSLA' => 'Tesla, Inc.',
            'NFLX' => 'Netflix, Inc.',
            'NVDA' => 'NVIDIA Corporation',
            'ADBE' => 'Adobe Inc.',
            'INTC' => 'Intel Corporation',
            'CSCO' => 'Cisco Systems, Inc.',
            'CMCSA' => 'Comcast Corporation',
            'V' => 'Visa Inc.',
            'JNJ' => 'Johnson & Johnson',
            'PG' => 'Procter & Gamble Co.',
            'DIS' => 'The Walt Disney Company',
            'PFE' => 'Pfizer Inc.',
            'VZ' => 'Verizon Communications Inc.',
            'PEP' => 'PepsiCo, Inc.',
            'KO' => 'The Coca-Cola Company',
            'T' => 'AT&T Inc.',
            'XOM' => 'Exxon Mobil Corporation',
            'WMT' => 'Walmart Inc.',
            'NKE' => 'Nike, Inc.',
            'MRK' => 'Merck & Co., Inc.',
            'ABT' => 'Abbott Laboratories',
            'CRM' => 'Salesforce.com, Inc.',
            'COST' => 'Costco Wholesale Corporation',
            'NVS' => 'Novartis AG',
            'TMO' => 'Thermo Fisher Scientific Inc.',
            'MDT' => 'Medtronic plc',
            'AVGO' => 'Broadcom Inc.',
            'AMGN' => 'Amgen Inc.',
            'TXN' => 'Texas Instruments Incorporated',
            'QCOM' => 'Qualcomm Incorporated',
            'ORCL' => 'Oracle Corporation',
            'BA' => 'The Boeing Company',
            'GE' => 'General Electric Company',
            'F' => 'Ford Motor Company',
            'GM' => 'General Motors Company',
            'MCD' => 'McDonald\'s Corporation',
            'SBUX' => 'Starbucks Corporation',
            'BABA' => 'Alibaba Group Holding Limited',
            'SAP' => 'SAP SE',
            'BIDU' => 'Baidu, Inc.',
            'UBER' => 'Uber Technologies, Inc.',
            'LYFT' => 'Lyft, Inc.',
            'HPQ' => 'HP Inc.',
            'TWTR' => 'Twitter, Inc.',
            'PYPL' => 'PayPal Holdings, Inc.'
        ];

        $combined_data = [];
        $i = 0;
        foreach ($symbols as $symbol) {
            $url = "https://api.polygon.io/v2/aggs/ticker/$symbol/prev?apiKey=$apiKey";

            $response = Http::get($url);
            if ($response->successful()) {
                $data = $response->json();

                $this->info("API Response for $symbol: " . json_encode($data, JSON_PRETTY_PRINT));

                if (isset($data['results']) && count($data['results']) > 0) {
                    $results = $data['results'][0];

                    $currentPrice = $results['c'];
                    $openPrice = $results['o'] ?? null;
                    $highPrice = $results['h'] ?? null;
                    $lowPrice = $results['l'] ?? null;
                    $volume = $results['v'] ?? null;
                    $timestamp = date('Y-m-d H:i:s', $results['t'] / 1000);

                    $changePercentage = $openPrice !== null
                        ? (($currentPrice - $openPrice) / $openPrice) * 100
                        : null;

                    $logoUrl = $this->getLogoUrl($symbol);

                    $companyName = $companyNames[$symbol] ?? 'Unknown Company';

                    $combined_data[$symbol] = [
                        'symbol' => $symbol,
                        'company_name' => $companyName,
                        'current_price' => $currentPrice,
                        'open_price' => $openPrice,
                        'high_price' => $highPrice,
                        'low_price' => $lowPrice,
                        'volume' => $volume,
                        'change_percentage' => $changePercentage !== null ? round($changePercentage, 2) : 'Data not available',
                        'timestamp' => $timestamp,
                        'logo' => $logoUrl,
                    ];

                    $this->info("Current Price of $symbol: $$currentPrice");
                    if ($changePercentage !== null) {
                        $this->info("Change Percentage for $symbol: " . round($changePercentage, 2) . "%");
                    } else {
                        $this->info("Change Percentage for $symbol: Data not available");
                    }
                } else {
                    $this->error("No data available for $symbol.");
                }
            } else {
                $this->error('Error occurred while fetching data for ' . $symbol . ': ' . $response->body());
            }

            // if( $i == 5 ){
            //     break;
            // }
            $i++;
            sleep(12);
        }

        $json_file = public_path('indices.json');
        file_put_contents($json_file, json_encode(array_values($combined_data), JSON_PRETTY_PRINT));

        dd( $combined_data );

        Log::info("Stock indices data saved to $json_file");
        Log::info("Fetch stock indices command ends at " . now() . PHP_EOL);
    }

    /**
     * Get the logo URL for a given stock symbol.
     *
     * @param string $symbol
     * @return string
     */
    private function getLogoUrl($symbol)
    {
        $logos = [
            'AAPL' => 'https://logo.clearbit.com/apple.com',
            'MSFT' => 'https://logo.clearbit.com/microsoft.com',
            'GOOGL' => 'https://logo.clearbit.com/google.com',
            'AMZN' => 'https://logo.clearbit.com/amazon.com',
            'FB' => 'https://logo.clearbit.com/meta.com',
            'TSLA' => 'https://logo.clearbit.com/tesla.com',
            'NFLX' => 'https://logo.clearbit.com/netflix.com',
            'NVDA' => 'https://logo.clearbit.com/nvidia.com',
            'ADBE' => 'https://logo.clearbit.com/adobe.com',
            'INTC' => 'https://logo.clearbit.com/intel.com',
            'CSCO' => 'https://logo.clearbit.com/cisco.com',
            'CMCSA' => 'https://logo.clearbit.com/comcast.com',
            'V' => 'https://logo.clearbit.com/visa.com',
            'JNJ' => 'https://logo.clearbit.com/jnj.com',
            'PG' => 'https://logo.clearbit.com/pg.com',
            'DIS' => 'https://logo.clearbit.com/disney.com',
            'PFE' => 'https://logo.clearbit.com/pfizer.com',
            'VZ' => 'https://logo.clearbit.com/verizon.com',
            'PEP' => 'https://logo.clearbit.com/pepsico.com',
            'KO' => 'https://logo.clearbit.com/coca-cola.com',
            'T' => 'https://logo.clearbit.com/att.com',
            'XOM' => 'https://logo.clearbit.com/exxonmobil.com',
            'WMT' => 'https://logo.clearbit.com/walmart.com',
            'NKE' => 'https://logo.clearbit.com/nike.com',
            'MRK' => 'https://logo.clearbit.com/merck.com',
            'ABT' => 'https://logo.clearbit.com/abbott.com',
            'CRM' => 'https://logo.clearbit.com/salesforce.com',
            'COST' => 'https://logo.clearbit.com/costco.com',
            'NVS' => 'https://logo.clearbit.com/novartis.com',
            'TMO' => 'https://logo.clearbit.com/thermofisher.com',
            'MDT' => 'https://logo.clearbit.com/medtronic.com',
            'AVGO' => 'https://logo.clearbit.com/broadcom.com',
            'AMGN' => 'https://logo.clearbit.com/amgen.com',
            'TXN' => 'https://logo.clearbit.com/ti.com',
            'QCOM' => 'https://logo.clearbit.com/qualcomm.com',
            'ORCL' => 'https://logo.clearbit.com/oracle.com',
            'BA' => 'https://logo.clearbit.com/boeing.com',
            'GE' => 'https://logo.clearbit.com/ge.com',
            'F' => 'https://logo.clearbit.com/ford.com',
            'GM' => 'https://logo.clearbit.com/gm.com',
            'MCD' => 'https://logo.clearbit.com/mcdonalds.com',
            'SBUX' => 'https://logo.clearbit.com/starbucks.com',
            'BABA' => 'https://logo.clearbit.com/alibaba.com',
            'SAP' => 'https://logo.clearbit.com/sap.com',
            'BIDU' => 'https://logo.clearbit.com/baidu.com',
            'UBER' => 'https://logo.clearbit.com/uber.com',
            'LYFT' => 'https://logo.clearbit.com/lyft.com',
            'HPQ' => 'https://logo.clearbit.com/hp.com',
            'TWTR' => 'https://logo.clearbit.com/twitter.com',
            'PYPL' => 'https://logo.clearbit.com/paypal.com'
        ];

        return $logos[$symbol] ?? 'https://logo.clearbit.com/default.com';
    }
}
