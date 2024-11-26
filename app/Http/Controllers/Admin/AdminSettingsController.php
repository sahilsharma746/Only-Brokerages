<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\StiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminSettingsController extends Controller
{

    protected $site_settings;

    public function __Construct(){
        $this->site_settings = new StiteSettings();
    }

    public function getAdminGeneralSettings(){
        $site_settings = new StiteSettings();
        $legal_link = $site_settings->getSetting('legal_links', 'legal_links_home');

        return view('admin.settings.general', compact('legal_link'));
    }


    public function getAdminSystemSettings(){
        return view('admin.settings.system');
    }


    public function saveLegalLinksSettings(Request $request){

         // Validate the incoming request
         $validatedData = $request->validate([
            'title.*' => 'required|string|max:255',
            'link.*' => '',
        ]);

        // Initialize an array to hold the legal links
        $legalLinks = [];

        // Loop through the titles and links
        foreach ($validatedData['title'] as $key => $title) {
            // Check if there is a corresponding link
                $legalLinks[] = [
                    'title' => $title,
                    'link' => $validatedData['link'][$key],
                ];
        }

        // Convert the array to JSON
        $jsonLegalLinks = json_encode($legalLinks);

        $this->site_settings->setSetting('legal_links', $jsonLegalLinks, 'legal_links_home');

        return redirect()->back()->with('success', 'Legal links saved successfully!');

    }

}