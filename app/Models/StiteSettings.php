<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StiteSettings extends Model
{
    use HasFactory;

    protected $fillable = ['option_group', 'option_name', 'option_value'];
    protected $table = 'stite_settings';

    public function getSetting( $setting_name ) {
        return StiteSettings::where('option_name', $setting_name)->first();
    }

}
