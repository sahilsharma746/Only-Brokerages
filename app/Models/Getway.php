<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Getway extends Model
{
    use HasFactory;
    protected $table = 'getways';
    protected $guarded = [];


    public static function getAdminGatewayID(){
         return Getway::select('id')->where('name', 'admin')->first();
    }

    public static function getAdminCreditGatewayID(){
        return Getway::select('id')->where('name', 'admin_credit')->first();
    }

   public static function getAdminLoanGatewayID(){
        return Getway::select('id')->where('name', 'admin_loan')->first();
    }


}
