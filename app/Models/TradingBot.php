<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradingBot extends Model
{
    protected $table = 'trading_bots';

    protected $fillable = [
        'name',
        'title',
        'description',
        'image',
        'deposit_amount',
        'license_key'
    ];
}
