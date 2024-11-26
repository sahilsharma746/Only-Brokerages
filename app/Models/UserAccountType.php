<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccountType extends Model
{
    use HasFactory;

    protected $table = 'user_account_types';

    public function features(){
        return $this->hasMany(UserAccountTypeFeature::class, 'plan_id', 'id');
    }

    public static function getUserPlan($user_id){
        return UserAccountType::where('id', $user_id ?? null)->value('name');
    }

    public static function allPlansIds(){
        return UserAccountType::pluck('id')->toArray();
    }



}
