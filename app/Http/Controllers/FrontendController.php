<?php

namespace App\Http\Controllers;

use App\Models\Contact_us_message;
use App\Models\UserAccountType;
use App\Models\UserAccountTypeFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FrontendController extends Controller
{
    public function index() {


        $plan_with_features = UserAccountType::leftJoin('user_account_types_features', 'user_account_types.id', '=', 'user_account_types_features.plan_id')
        ->select(
            'user_account_types.id as plan_id',
            'user_account_types.name',
            'user_account_types.price',
            'user_account_types_features.feature_description',
            'user_account_types_features.feature_order',
            'user_account_types_features.feature_available'
        )
        ->orderBy('user_account_types.id')
        ->orderBy('user_account_types_features.id')
        ->get();
    

    $plans = $plan_with_features->groupBy('plan_id')->take(6);
         // Check if the user is logged in
        if (!Auth::check()) {
            return view('index',compact('plans'));
        }

         // Check if the logged-in user has the specified role
        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('admin.login');
        }else if ($user->role == 'user') {
            return redirect()->route('user.dashboard');
        } else{
            return redirect()->route('admin.login');
        }

        return view('index');
    }

    public function about() {
        return view('about');
    }

    public function contact() {
        return view('contact');
    }

    public function accountPlan() {
        $plan_with_features = DB::table('user_account_types')
            ->leftJoin('user_account_types_features', 'user_account_types.id', '=', 'user_account_types_features.plan_id')
            ->select('user_account_types.id as plan_id', 'user_account_types.name', 'user_account_types.price',
                    'user_account_types_features.feature_description', 'user_account_types_features.feature_order', 
                    'user_account_types_features.feature_available')
            ->orderBy('user_account_types.id')  // Add this line to order by 'id'
            ->orderBy('user_account_types_features.id')  // Order features by 'feature_order'
            ->get();

        $plans = $plan_with_features->groupBy('plan_id');

        return view('accountPlan', compact('plans'));
    }

    public function faq() {
        return view('faq');
    }

    public function message(Request $request)
    {
        $request->validate([
            'email' => 'required|email', 
            'message' => 'required|string|max:255', 
        ]);

        Contact_us_message::create([
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]);
        return back()->with('success', 'Your message has been sent successfully!');

    }
}
