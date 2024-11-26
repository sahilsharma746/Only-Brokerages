<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TradingBotJobs extends Model
{
    use HasFactory;

    protected $table = 'bot_jobs';
    protected $fillable = [
        'user_id',
        'bot_id',
        'status',
        'trade_asset',
        'percentage_gain_or_loss',
        'trade_result',
        'market',
        'capital',
        'time_frame',
        'trade_type',
        'margin',
        'order_type',
        'trade_count',
    ];

}
