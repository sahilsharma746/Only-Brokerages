<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GetwaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('getways')->insert([
            [
                'name' => 'Bitcoin',
                'tab_id' => 'bitcoin',
                'address' => 'bitcoin_netwark_address',
                'deposit' => 'yes',
                'withdraw' => 'yes',
                'logo' => 'assets/img/company-bitcoin_symbol.svg.png',
                'created_at' => Carbon::now()
            ],[
                'name' => 'USDT',
                'tab_id' => 'usdt',
                'address' => 'usdt_netwark_address',
                'deposit' => 'yes',
                'withdraw' => 'yes',
                'logo' => 'assets/img/payment-usdt logo 1.png',
                'created_at' => Carbon::now()
            ],[
                'name' => 'XMR',
                'tab_id' => 'xmr',
                'address' => 'xmr_netwark_address',
                'deposit' => 'yes',
                'withdraw' => 'yes',
                'logo' => 'assets/img/payment-xmrig_logo.svg.png',
                'created_at' => Carbon::now()
            ],[
                'name' => 'Paypal',
                'tab_id' => 'paypal',
                'address' => 'paypal_email_address',
                'deposit' => 'yes',
                'withdraw' => 'yes',
                'logo' => 'assets/img/payment-paypal_symbol.svg.png',
                'created_at' => Carbon::now()
            ],[
                'name' => 'Bank',
                'tab_id' => 'bank',
                'address' => 'account_number',
                'deposit' => 'yes',
                'withdraw' => 'yes',
                'logo' => 'assets/img/payment-Icon.png',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
