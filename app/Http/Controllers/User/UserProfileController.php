<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserSetting;
use App\Models\UserVerifiedStatus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class UserProfileController extends Controller
{

    public $user_setting;

    public function __construct() {
        $this->user_setting = new UserSetting();
    }

    public function personalInfo() {
        $user = Auth::user();
        $user_data = User::with('addresses')->where([['role', 'user'], ['id', $user->id]])->first();
        $total_depost_amount = Deposite::where('user_id', $user->id)->sum('amount');
        $countries = config('countries');
        return view('users.profile.personal-info', compact('user_data', 'countries','total_depost_amount'));
    }

    public function personalInfoUpdate(Request $request) {
        $user = Auth::user();
        $request->validate([
            'first_name' => 'required | string | max:255',
            'last_name' => 'required | string | max:255',
            'email' => 'required | email | unique:users,email,'.$user->id.',id',
            'phone' => 'required',
            'country' => 'required',
        ]);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        UserAddress::where('user_id', $user->id)
                ->update(['country' => $request->country]);

        session()->put('user_name', "{$request->first_name} {$request->last_name}");
        return back()->with('success', 'Updated successfully');
    }


    public function avatarUpdate(Request $request) {
        $user = Auth::user();
        $request->validate([
            'avatar' => 'required | image | mimes:jpg,png,jpeg'
        ]);
        $base_path = public_path('uploads/user_avatar/');
        if (!File::exists($base_path)) {
            File::makeDirectory($base_path, 0755, true);
        }
        $file = $request->file('avatar');
        $file_name = time() . '-user-avatar-' . $user->id . '.' . $file->getClientOriginalExtension();
        $file->move($base_path, $file_name);
        User::where('id', $user->id)
                ->update(['avatar' => $file_name]);
        return back()->with(['success' => 'Avatar updated successfully', 'user' => $user]);
    }


    public function verification() {
        $identification = Identification::where('user_id', auth()->user()->id)->first();
        return view('users.profile.verification', compact('identification'));
    }

    public function securitySetting() {
        return view('users.profile.security');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'password' => 'required | string | min:6 | max:16',
            'confirmation_password' => 'required_with:password|same:password'
        ]);
        $user = User::where('id', auth()->user()->id)->first();
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        return back()->with('success', 'Updated Successfully');
    }


    public function updateSettings(Request $request){
        $user = auth()->user(); 
        $settings = $request->only(['dashboard_currency', 'profile_language']);
        foreach ($settings as $option_name => $option_value) {
            $this->user_setting->updatUserSetting($option_name, $option_value, $user->id );
        }
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }



    public function saveKycDocuments(Request $request){
        $validated_data = $request->validate([
            'kyc_type' => 'required|string',
        ]);
        $kyc_type = $validated_data['kyc_type'];

        $user = Auth::user();

        $image_uploaded = false;
        $base_path = public_path('uploads/kyc_documents/');
        $user_id = $user->id;
        $user_folder_path = $base_path . $user_id . '/';

        if (!File::exists($user_folder_path)) {
            File::makeDirectory($user_folder_path, 0755, true);
        }

        // upload kyc id front
        if ($request->hasFile('kyc_id_front')) {
            $image_uploaded = true;
            $kyc_id_front_file = $request->file('kyc_id_front');
            $kyc_id_front_file_name = time() . '-kyc_id_front.' . $user_id . '.' . $kyc_id_front_file->getClientOriginalExtension();
            $kyc_id_front_file->move($user_folder_path, $kyc_id_front_file_name);
            $this->user_setting->updatUserSetting('kyc_id_front', $kyc_id_front_file_name, $user_id);
            UserVerifiedStatus::where('user_id', $user_id)->update(['kyc_id_front' => 1]);
        }

        // upload kyc id back
        if ($request->hasFile('kyc_id_back')) {
            $image_uploaded = true;
            $kyc_id_back_file = $request->file('kyc_id_back');
            $kyc_id_back_filename = time() . '-kyc_id_back.' . $user_id . '.' . $kyc_id_back_file->getClientOriginalExtension();
            $kyc_id_back_file->move($user_folder_path, $kyc_id_back_filename);
            $this->user_setting->updatUserSetting('kyc_id_back', $kyc_id_back_filename, $user_id);
            UserVerifiedStatus::where('user_id', $user_id)
            ->update(['kyc_id_back' => 1]);
        }

        // upload kyc address proof
        if ($request->hasFile('kyc_address_proof')) {
            $image_uploaded = true;
            $kyc_address_proof_file = $request->file('kyc_address_proof');
            $kyc_address_proof_file_name = time() . '-kyc_address_proof.' . $user_id . '.' . $kyc_address_proof_file->getClientOriginalExtension();
            $kyc_address_proof_file->move($user_folder_path, $kyc_address_proof_file_name);
            $this->user_setting->updatUserSetting('kyc_address_proof', $kyc_address_proof_file_name, $user_id);
            UserVerifiedStatus::where('user_id', $user_id)
            ->update(['kyc_address_proof' => 1]);
        }

        // upload kyc selfie proof
        if ($request->hasFile('kyc_selfie_proof')) {      
            $image_uploaded = true;
            $kyc_selfie_proof_file = $request->file('kyc_selfie_proof');
            $kyc_selfie_proof_file_name = time() . '-kyc_selfie_proof.' . $user_id . '.' . $kyc_selfie_proof_file->getClientOriginalExtension();
            $kyc_selfie_proof_file->move($user_folder_path, $kyc_selfie_proof_file_name);
            $this->user_setting->updatUserSetting('kyc_selfie_proof', $kyc_selfie_proof_file_name, $user_id);
            UserVerifiedStatus::where('user_id', $user_id)
            ->update(['kyc_selfie_proof' => 1]);
        }

    
        $this->user_setting->updatUserSetting('kyc_doc_type',$kyc_type, $user_id);

        UserVerifiedStatus::where('user_id', $user_id)->update(['kyc_verify_status' => 'pending']);

        if ($image_uploaded = true){
            return back()->with('success', 'Submitted successfully for review');
        }else{
            return back();
        }
    }



    public function restoreAdmin(){
        if (session()->has('admin_id')) {
            $adminId = session('admin_id');
            $admin = User::find($adminId);
            if ($admin) {
                Auth::login($admin); // Log back in as admin
                session()->forget('admin_id'); // Remove the stored admin ID
                return redirect()->route('admin.dashboard')->with('success', 'Restored to Admin session');
            }
        }
        return redirect()->route('admin.dashboard')->with('error', 'Unable to restore Admin session.');
    }

}