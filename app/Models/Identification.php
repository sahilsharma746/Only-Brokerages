<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identification extends Model
{
    use HasFactory;
    protected $table = 'identifications';
    protected $guarded = [];

    public function withUser() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
