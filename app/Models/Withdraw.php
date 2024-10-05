<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Withdraw extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'withdraws';

    public function getway() {
        return $this->hasOne(Getway::class, 'id', 'getway_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


    public static function updateWithdrawalByAdmin($user_id, $amount, $gateway_id, $remarks){
        return Withdraw::insert([
            'user_id' => $user_id,
            'getway_id' => $gateway_id,
            'amount' => $amount,
            'wallet_address' => '',  
            'address_tag' => '',
            'payment_method' => 'admin',
            'remarks' => $remarks,
            'withdrawl_by' => 'admin',
            'status' => 'approved',
            'created_at' => Carbon::now()
         ]);
 
     }


}
