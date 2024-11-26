<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StiteSettings extends Model
{
    use HasFactory;

    protected $fillable = ['option_group', 'option_name', 'option_value'];
    protected $table = 'stite_settings';

    public function getSetting( $setting_name, $setting_group ){
        return StiteSettings::where('option_name', $setting_name)->where('option_group', $setting_group)->select('option_value')->first();
    }

    public function setSetting( $setting_name, $setting_value, $setting_group ){
        return StiteSettings::updateOrCreate(
                        [
                            'option_name' => $setting_name
                        ],
                        [
                            'option_value' => $setting_value,
                            'option_group' => $setting_group
                        ]
                );
    }

}
