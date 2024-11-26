<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccountType;
use App\Models\Deposit;
use App\Models\Trade;
use App\Models\StiteSettings;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $user_data = Auth::user(); // Get the authenticated user
            if ($user_data) {

                $total_loan = Deposit::where('user_id', $user_data->id)
                                    ->where('payment_method', 'admin_loan')
                                    ->sum('amount');
                $total_profit = Trade::where('user_id', $user_data->id)
                                    ->where('trade_result', 'win')
                                    ->sum('pnl');

                $plan_name = UserAccountType::select('name')->where('id', $user_data->account_type)->first();
                $view->with('user_plan', $plan_name->name);
                $view->with('user_data', $user_data);
                $view->with('account_profit',  $total_loan + $total_profit);

            } else {
                $view->with('user_plan', 'User data not available'); // handle the case where user_data is null
            }

            $site_settings = new StiteSettings();
            $legal_link = $site_settings->getSetting('legal_links', 'legal_links_home');
            $bot_status = $site_settings->getSetting('enable_disable_software','enable_disable_software' );

            $view->with('bot_status', $bot_status ? $bot_status->option_value : null);
            $view->with('legal_links', $legal_link ? $legal_link->option_value : null);

        });
    }

}
