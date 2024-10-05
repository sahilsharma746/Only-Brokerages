<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'option_name', 'option_value'];
    protected $table = 'user_settings_info';


    public function getUserSetting( $setting_name, $user_id ) {
        $result = UserSetting::select('option_value')->where('user_id', $user_id)
                                ->where('option_name', $setting_name)
                                ->first();
        return ( isset($result->option_value) ) ? $result->option_value : false;
    }


    public function getUserAllSetting( $user_id ) {
        // return UserSetting::where('user_id', $user_id)->get();
        return UserSetting::where('user_id', $user_id)
                        ->pluck('option_value', 'option_name')
                        ->toArray();

    }


    public function updatUserSetting( $setting_name, $setting_value, $user_id ){
        return UserSetting::updateOrCreate(
                        [
                            'user_id' => $user_id, // Search criteria
                            'option_name' => $setting_name
                        ],
                        [
                            'option_value' => $setting_value // Update this value or create if doesn't exist
                        ]
                );
    }



}
