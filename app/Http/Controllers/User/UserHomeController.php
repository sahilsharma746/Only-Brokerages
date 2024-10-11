<?php

namespace App\Http\Controllers\User;
use App\Models\User;
use App\Models\Trade;
use App\Models\Deposit;
use DOMDocument;

use App\Models\Withdraw;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use App\Models\UserAccountType;
use App\Models\UserVerifiedStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class UserHomeController extends Controller
{
  

    public function index() {
        $user_setting = new UserSetting();
        $full_data = [];
        $user = Auth::user();
        $user_data = User::with('addresses')
            ->where([['role', 'user'], ['id', $user->id]])
            ->first();
        $full_data['userVerifiedStatus'] = UserVerifiedStatus::where('user_id', $user->id)->first();

        $full_data['total_deposit'] = Deposit::getUserDepositAmount($user->id);
        $full_data['total_approved_deposit'] = Deposit::getUserDepositAmount($user->id, 'approved');

        $currentBalance = $user->balance; 

        $user_old_value = $user_setting->getUserSetting('user_old_balance', $user->id); 

        if (!$user_old_value) {
            // Set percentage to 0 if there is no old balance
            $full_data['usertotoalpercentage'] = 0;
        } else {
       
        if ($user_old_value > $currentBalance) {
            // Decrease
            $difference = $user_old_value - $currentBalance; 
            $usertotoalpercentage = ($difference / $user_old_value) * 100; 
        
        } else {
            // Increase
            $difference = $currentBalance - $user_old_value; 
            $usertotoalpercentage = ($difference / $user_old_value) * 100; 
                }
        $full_data['usertotoalpercentage']  = number_format($usertotoalpercentage, 2);

            }

        $settings = UserSetting::where('user_id', $user->id)
            ->whereIn('option_name', ['dashboard_currency', 'profile_language'])
            ->get()->keyBy('option_name');
            
        $full_data['setting_info'] = [
            'dashboard_currency' => $settings['dashboard_currency']->option_value ?? 'USD',
            'profile_language' => $settings['profile_language']->option_value ?? 'en',
        ];
        $user_verifications = UserVerifiedStatus::where('user_id', $user->id)->first();

        $full_data['user_verifications'] = $user_verifications;
        $full_data['countries'] = config('countries');
        $full_data['languages'] = config('languages');
        $full_data['currencies'] = config('currencies');
        $kycTypes = config('settingkeys.kyc_type');
        $full_data['user_data'] = $user_data;


        $full_data['totalAdminCreditDeposits'] = Deposit::where('user_id', $user->id)
            ->where('payment_method', 'admin_credit')
            ->sum('amount');

        $full_data['totalAdminLoanDeposits'] = Deposit::where('user_id', $user->id)
            ->where('payment_method', 'admin_loan')
            ->sum('amount');

        $full_data['totalAdminDeposits'] = Deposit::where('user_id', $user->id)
            ->whereIn('payment_method', ['admin_credit', 'admin_loan'])
            ->sum('amount');

        $totalCapital = $full_data['totalAdminDeposits'];

        if ($totalCapital > 0) {
            $full_data['adminCreditPercentage'] = number_format(($full_data['totalAdminCreditDeposits'] / $totalCapital) * 100, 2);

            $full_data['adminLoanPercentage'] = number_format(($full_data['totalAdminLoanDeposits'] / $totalCapital) * 100, 2);
        } else {
            $full_data['adminCreditPercentage'] = 0;
            $full_data['adminLoanPercentage'] = 0;
        }


        $full_data['totalAmountWinTrade'] = Trade::where('user_id', $user->id)->where('trade_result', 'win')->sum('capital');
        $full_data['totalAmountLossTrade'] = Trade::where('user_id', $user->id)->where('trade_result', 'loss')->sum('capital');
        
        $full_data['totalWinAmount'] = Trade::where('user_id', $user->id)
                                            ->where('trade_result', 'win')
                                            ->sum('pnl');
        $full_data['totalLossAmount'] = Trade::where('user_id', $user->id)
                                        ->where('trade_result', 'loss')
                                        ->selectRaw('SUM(ABS(pnl)) as total_loss') // Sum absolute values
                                        ->value('total_loss'); // Get the result

        if( $full_data['totalAmountWinTrade'] > 0 ) {
            $full_data['win_percentage'] = ($full_data['totalWinAmount'] / $full_data['totalAmountWinTrade']) * 100;
        }else{
            $full_data['win_percentage'] = 0;
        }

        if( $full_data['totalAmountLossTrade'] > 0 ) {
            $full_data['loss_percentage'] = ($full_data['totalLossAmount'] / $full_data['totalAmountLossTrade']) * 100;
        }else{
            $full_data['loss_percentage'] = 0;
        }

        $full_data['win_percentage'] = number_format($full_data['win_percentage'], 2);
        $full_data['loss_percentage'] = number_format($full_data['loss_percentage'], 2);

        $full_data['totalTradesCount'] = Trade::where('user_id', $user->id)->count();
        $full_data['totalWinTradesCount'] = Trade::where('user_id', $user->id)->where('trade_result', 'win')
        ->where('status', 1)->where('processed', 1)->count();
   

        if ($full_data['totalTradesCount'] > 0) {
            $full_data['winPercentage'] = ($full_data['totalWinTradesCount'] / $full_data['totalTradesCount']) * 100;
        } else {
            $full_data['winPercentage'] = 0;
        }
        $full_data['winPercentage'] = number_format($full_data['winPercentage'], 2) ;

        return view('users.index', compact('full_data','kycTypes'));
    }
    

    public function news() {

        $crypto_feed_data = $this->get_feed_for_crypto();
        $forex_feed_data = $this->get_feed_for_forex();
        $indices_feed_data = $this->get_feed_for_indices();

        return view('users.news' , compact('crypto_feed_data','forex_feed_data','indices_feed_data'));
    }




    public function get_feed_for_crypto(){
        $crypto_feed_data = [];

        $rss_feed_newsBTC = 'https://www.newsbtc.com/feed/';
        $newsBTC_feed = simplexml_load_file($rss_feed_newsBTC);
        
        if ($newsBTC_feed !== false) {
            $namespaces = $newsBTC_feed->getNamespaces(true);
            $i = 0;
            foreach ($newsBTC_feed->channel->item as $key => $item) {
                // Get media content using the correct namespace
                $mediaContent = $item->children($namespaces['media'])->content;
                $imageUrl = (string) $mediaContent->attributes()->url;
        
                $description = trim(preg_replace('/<.*?>/i', '', (string) $item->description));
        
                // Initialize DOMDocument to parse description
                $doc = new DOMDocument();
                @$doc->loadHTML($description);
        
                $crypto_feed_data[$i]['title'] = htmlspecialchars($item->title);
                $crypto_feed_data[$i]['link'] = htmlspecialchars($item->link);
                $crypto_feed_data[$i]['pub_date'] = date('M d, Y', strtotime($item->pubDate));
                $crypto_feed_data[$i]['description'] = $description;
                $crypto_feed_data[$i]['image'] = $imageUrl;
                $i++;
            }
        }

        $rss_feed_crypto = 'https://cointelegraph.com/rss'; 
        $crypto_feed = simplexml_load_file($rss_feed_crypto);
        if ($crypto_feed != false) {
            foreach ($crypto_feed->channel->item as $key => $item) {
                $crypto_feed_data[$i]['title'] = htmlspecialchars($item->title);
                $crypto_feed_data[$i]['link'] = htmlspecialchars($item->link);
                $crypto_feed_data[$i]['pub_date'] = date('M d, Y', strtotime($item->pubDate));
                $crypto_feed_data[$i]['description'] = trim(preg_replace('/<.*?>/i', '', (string) $item->description));
                $crypto_feed_data[$i]['image'] = (string) $item->enclosure['url'];
                $i++;
            }
        }
        return $crypto_feed_data;
    }


    public function get_feed_for_forex() {
        $rss_feed_url = 'https://www.actionforex.com/feed/';
        $feed_data = [];

        // Fetch the RSS feed
        $rss_content = @file_get_contents($rss_feed_url);
        if ($rss_content === false) {
            return ['error' => 'Failed to load RSS feed.'];
        }

        // Load the RSS feed into a SimpleXMLElement
        $rss = simplexml_load_string($rss_content);
        if ($rss === false) {
            return ['error' => 'Failed to parse RSS feed.'];
        }

        // Iterate over each item in the RSS feed
        foreach ($rss->channel->item as $item) {
            $title = (string) $item->title;
            $link = (string) $item->link;
            $description = strip_tags((string) $item->description);
            preg_match('/<img.*?src=["\'](.*?)["\']/', $item->description, $matches);
            $image = $matches[1] ?? '';  // Get the first matched image URL
            $feed_data[] = [
                'title' => $title,
                'link' => $link,
                'description' => $description,
                'pub_date' => date('M d, Y', strtotime($item->pubDate)),
                'image' => $image
            ];
        }
        return $feed_data;
    }
    
    


    public function get_feed_for_Indices() {
        $indices_feed_data = [];
        // Valid RSS feed for indices news
        $rss_feed_indices = 'https://finance.yahoo.com/rss/';
    
        $options = [
            "http" => [
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = @file_get_contents($rss_feed_indices, false, $context);

        if ($response !== false) {
            $indices_feed = simplexml_load_string($response);

            if ($indices_feed !== false) {
                $i = 0;
                foreach ($indices_feed->channel->item as $item) {

                    $media = $item->children('media', true); // Handling media namespace
                    $indices_feed_data[$i]['title'] = (string) $item->title;
                    $indices_feed_data[$i]['link'] = (string) $item->link;
                    $indices_feed_data[$i]['pub_date'] = date('M d, Y', strtotime((string) $item->pubDate));
                    $indices_feed_data[$i]['description'] = strip_tags((string) $item->description);
                    
                    // Extract image from the 'media:content' element
                    $indices_feed_data[$i]['image'] = isset($media->content) ? (string) $media->content->attributes()->url : '';
                    $i++;
                }
            } else {
                return ['error' => 'Failed to parse the RSS feed.'];
            }
        } else {
            return ['error' => 'Failed to load RSS feed.'];
        }

        return $indices_feed_data;
    }


}
