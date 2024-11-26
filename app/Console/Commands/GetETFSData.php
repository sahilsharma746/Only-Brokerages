<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Scheb\YahooFinanceApi\ApiClientFactory;
use Scheb\YahooFinanceApi\Exception\ApiException;
use Illuminate\Support\Facades\Log;
class GetETFSData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-e-t-f-s-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch ETFs stock data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $client = ApiClientFactory::createApiClient();
            $etfs = [
                'XLK',
                 'VUG','VOOG','SPYG', 'SMH','PRN','PPA','NULG','IYW','GOEX','FTEC', 'ESPO', 'BLOK', 'YLD','UTES','TMFC','SDCI','QTUM','PJUL', 'HYHG', 'FLBL','BCD', 'VNLA','PULS','ONEQ','JPST',
                'KGRN','CXSE','DINT','FLRT','FLHK','LMBS','WEED','MSOX','NFXL','GDXU','LITP','BTGD','USO','MCHS','SETM','DGP','NBCE','ASHS','CORN','COPX','FPA','HGER','SEEM','TZA'

            ];

            $combined_data = [];

            foreach ($etfs as $symbol) {
                $quote = $client->getQuote($symbol);

                $etf_data = [
                    'symbol' => $quote->getSymbol(),
                    'name' => $quote->getLongName(),
                    'current_price' => $quote->getRegularMarketPrice(),
                    'change_percent' => $quote->getRegularMarketChangePercent(),
                    'fifty_day_average' => $quote->getFiftyDayAverage(),
                    'fifty_two_week_high' => $quote->getFiftyTwoWeekHigh(),
                    'fifty_two_week_low' => $quote->getFiftyTwoWeekLow(),
                    'market_state' => $quote->getMarketState(),
                    'exchange_name' => $quote->getFullExchangeName(),
                    'logo_url' => $this->getCompanyLogo($symbol),
                ];

                $combined_data[] = $etf_data;

                $this->info("Symbol: " . $quote->getSymbol());
                $this->info("Name: " . $quote->getLongName());
                $this->info("Current_Price: $" . $quote->getRegularMarketPrice());
                $this->info("Change: " . $quote->getRegularMarketChangePercent() . "%");
                $this->info("Fifty-Day Avg: " . $quote->getFiftyDayAverage());
                $this->info("52-Week High: " . $quote->getFiftyTwoWeekHigh());
                $this->info("52-Week Low: " . $quote->getFiftyTwoWeekLow());
                $this->info("Market State: " . $quote->getMarketState());
                $this->info("Exchange: " . $quote->getFullExchangeName());
                $this->info("Logo URL: " . $etf_data['logo_url']);
                $this->info("---------------------------------------------");

                sleep(2);
            }

            // Save the data to a JSON file
            $json_file = public_path('etfs.json');
            file_put_contents($json_file, json_encode($combined_data, JSON_PRETTY_PRINT));

            Log::info("ETFs data saved to $json_file");
            Log::info("Fetch ETFs data command ends at " . now() . PHP_EOL);

        } catch (ApiException $e) {
            $this->error('Error fetching data from Yahoo Finance: ' . $e->getMessage());
            Log::error('Error fetching data from Yahoo Finance: ' . $e->getMessage());
        }
    }

    /**
     * Fetch the logo for the given symbol
     */
  private function getCompanyLogo($symbol) {
    $etfLogos = [
        'XLK' => 'ssga.com',
        'VUG' => 'vanguard.com',
        'VOOG' => 'vanguard.com',
        'SPYG' => 'ssga.com',
        'SMH' => 'vaneck.com',
        'PRN' => 'invesco.com',
        'PPA' => 'invesco.com',
        'NULG' => 'nuveen.com',
        'IYW' => 'ishares.com',
        'GOEX' => 'globalxetfs.com',
        'FTEC' => 'institutional.fidelity.com',
        'ESPO' => 'vaneck.com',
        'BLOK' => 'amplifyetfs.com',
        'YLD' => 'principalam.com',
        'UTES' => 'virtus.com',
        'TMFC' => 'fool.com',
        'SDCI' => 'uscfinvestments.com',
        'QTUM' => 'defianceetfs.com',
        'PJUL' => 'innovatoretfs.com',
        'HYHG' => 'www.proshares.com',
        'FLBL' => 'franklintempleton.com',
        'BCD' => 'abrdn.com',
        'VNLA' => 'www.janushenderson.com',
        'PULS' => 'www.pgim.com',
        'ONEQ' => 'www.nasdaq.com',
        'JPST' => 'am.jpmorgan.com',
        'KGRN' => 'kraneshares.com',
        'CXSE' => 'www.wisdomtree.com',
        'DINT' =>'www.davisetfs.com',
        'FLRT' =>'www.paceretfs.com',
        'FLHK' =>'www.franklintempleton.com',
        'LMBS'=> 'www.ftportfolios.com',
        'WEED'=> 'www.roundhillinvestments.com',
        'MSOX'=> 'advisorshares.com',
        'NFXL'=> 'www.direxion.com',
        'GDXU'=> 'microsectors.com',
        'LITP'=> 'www.globalxetfs.com',
        'BTGD'=> 'quantifyfunds.com',
        'USO'=> 'www.uscfinvestments.com',
        'MCHS'=> 'www.matthewsasia.com',
        'SETM'=> 'sprott.com',
        'DGP'=> 'www.bloomberg.com',
        'NBCE'=> 'www.nb.com',
        'ASHS'=> 'etf.dws.com',
        'CORN'=> 'teucrium.com',
        'COPX'=> 'www.globalxetfs.com',
        'FPA'=> 'www.ftportfolios.com',
        'HGER'=> 'www.harborcapital.com',
        'SEEM'=> 'www.seic.com',
        'TZA'=> 'www.direxion.com',

    ];


    $logoSource = isset($etfLogos[$symbol]) ? $etfLogos[$symbol] : null;
    if ($logoSource) {
        $url = "https://logo.clearbit.com/{$logoSource}";

        $apiKey = '626fb81b27msh942cf2c9490b891p1beb24jsncc36133b09bc';

        $options = [
            'http' => [
                'header' => "X-RapidAPI-Key: $apiKey\r\n"
            ]
        ];

        $context = stream_context_create($options);
        $response = @file_get_contents($url, false, $context);


        return $response !== false ? $url : null;
    }

    return null;
}
}
