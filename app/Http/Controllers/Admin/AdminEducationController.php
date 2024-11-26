<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationPost;
use App\Models\EducationType ;
use Illuminate\Support\Facades\File;

class AdminEducationController extends Controller
{

    public function create_education_posts_view(Request $request){
        $education_types = EducationType::all();
        return view('admin.education.add' , compact('education_types'));
    }


    public function save_education_type(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $existingEducationType = EducationType::where('name', $request->input('name'))->first();

        if ($existingEducationType) {
            return redirect()->back()->with('error', 'Education Type already exists!');
        }

        EducationType::create([
            'name' => $request->input('name'),
        ]);
        return redirect()->back()->with('success', 'Education Type added successfully!');
    }



    public function save_education_topic(Request $request){

        $request->validate([
            'education_title' => 'required|string|max:255',
            'education_short_description' => 'required|string|max:50',
            'education_description' => 'required|string',
            'education_type' => 'required|integer',
            'education_image' => 'required | image | mimes:jpg,png,jpeg',
        ]);

        if ($request->hasFile('education_image')) {
            $file = $request->file('education_image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/education_images');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true); // Create directory and set permissions
            }
            $file->move($uploadPath, $fileName);
        }

        EducationPost::create([
            'title' => $request->input('education_title'),
            'short_description' => $request->input('education_short_description'),
            'description' => $request->input('education_description'),
            'type' => $request->input('education_type'),
            'image' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Education Topic added successfully!');
    }

    public function delete_education_topic($id){
        EducationPost::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Education post deleted successfully!');
    }


    public  function show_edit_education_topic($id){
        $education_types = EducationType::all();
        $educationPosts = EducationPost::where('id', $id)->first();
        return(view('admin.education.edit', compact('educationPosts','education_types')));
    }


    public function edit_education_topic(Request $request, $id){
        // Validate the incoming request data
        $request->validate([
            'education_title' => 'nullable|string|max:255',
            'education_short_description' => 'nullable|string',
            'education_description' => 'nullable|string',
            'education_type' => 'nullable|integer',
            'education_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image if present
        ]);

        // Find the post to update
        $post = EducationPost::findOrFail($id);

        // Update the fields only if they are provided in the request
        if ($request->filled('education_title')) {
            $post->title = $request->input('education_title');
        }

        if ($request->filled('education_short_description')) {
            $post->short_description = $request->input('education_short_description');
        }

        if ($request->filled('education_description')) {
            $post->description = $request->input('education_description');
        }

        if ($request->filled('education_type')) {
            $post->type = $request->input('education_type');
        }

        // Handle the image upload if a new image is provided
        if ($request->hasFile('education_image')) {
            $image = $request->file('education_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/education_images'), $imageName);

            // Update the image field in the post
            $post->image = $imageName;
        }

        // Save the updated post
        $post->save();

        // Redirect back with a success message
        return redirect()->route('admin.education.index')->with('success', 'Education topic updated successfully!');
    }

    public function educations(){
        $educationPosts = EducationPost::with('educationType')->get();
        return view('admin.education.index', compact('educationPosts'));
    }

}
