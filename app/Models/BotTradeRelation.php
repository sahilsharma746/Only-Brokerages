<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotTradeRelation extends Model
{
    protected $table = 'bot_trade_relation';

    protected $fillable = [
        'bot_id',
        'trade_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
