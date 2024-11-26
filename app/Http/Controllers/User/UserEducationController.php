<?php

namespace App\Http\Controllers\User;


use App\Models\EducationPost;
use App\Models\EducationType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class UserEducationController extends Controller
{

    public function education(Request $request) {
        $full_data = [];
        $full_data['educationTypes'] = EducationType::all();
        $full_data['educationPosts'] = EducationPost::all();
        return view('users.education.index', compact('full_data'));
    }


    public function GetEducationPostById(Request $request){
        $education_id = $request->input('id');
        $educationPosts = EducationPost::where('id', $education_id)->first();
        return response()->json(['success' => true, 'data' => $educationPosts ]);
    }


    public function GetEducationPostsByType(Request $request){
        $education_type_id = $request->input('id');
        $educationPosts = EducationPost::where('type', $education_type_id)->get();
        return response()->json([ 'success' => true, 'data' => $educationPosts ]);
    }

}


