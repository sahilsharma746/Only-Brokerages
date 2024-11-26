<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact_us_message;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function getcontactmesages()
    {

        $messages = Contact_us_message::all();

        return view('admin.contact.index', compact('messages'));
     
    }

    public function delete_contact_message($id){
        Contact_us_message::where('id', $id)->delete();
        return redirect()->back()->with('success', 'contact us message deleted successfully!');
    }
}
