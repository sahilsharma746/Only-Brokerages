<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccountTypeFeature extends Model
{
    use HasFactory;
    protected $table = 'user_account_types_features';

    public function features()
    {
        return $this->hasMany(UserAccountTypeFeature::class, 'plan_id', 'id');
    }

}
