<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAccountType;
use App\Models\UserVerifiedStatus;
use App\Models\UserAddress;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'account_type' => ['required', 'numeric'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'phone' => ['required'],
            'country' => ['required', 'string', 'max:255'],
            'time-zone' => ['required'],
        ]);
    }



    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(Request $request)
    {
        // Access GET parameters
        $requested_account_type = ( $request->query('plan_type') != null ) ? $request->query('plan_type') : '1';
        $user_account_types = UserAccountType::all();
        $countries = config('countries');
        
        return view('auth.register', compact('user_account_types', 'requested_account_type', 'countries'));
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::latest()->first();
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'account_type' => $data['account_type'],
            'username' => $data['username'],
            'phone' => $data['phone'],
            'avatar' => 'avatar.png',
            'referal_id' => $data['referal_id'],
            'time_zone'=>$data['time-zone'],
        ]);

        UserVerifiedStatus::create([
            'user_id' => $user->id,
            'kyc_verify_status' => 'unverified',
            'email_verify_status' => 'verified',
            'phone_verify_status' => 'verified',
            '2fa_verify_status' => 0,
            'kyc_id_front' => 0,
            'kyc_id_back'=>0,
            'kyc_address_proof'=>0,
            'kyc_selfie_proof'=>0,
            'upgrade_prompt' => 0,
            'certificate_prompt'=>0,
            'identity_prompt'=>0,
            'custom_prompt'=>0,
            'demo'=>0,
        ]);

         UserAddress::create([
            'user_id' => $user->id,
            'country' => $data['country'],
        ]);

        $user_account_type = UserAccountType::where('id', $user->account_type)->pluck('name')->first();

        session()->put('user_name', $user->first_name . ' ' . $user->last_name);
        session()->put('user_account_type', $user_account_type);

        return  $user;
    }


    protected function registered(Request $request, $user)
    {
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'user') {
            return redirect()->route('user.dashboard');
        }

        return redirect($this->redirectPath());
    }



}
