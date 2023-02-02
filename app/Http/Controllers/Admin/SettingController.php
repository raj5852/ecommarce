<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    function index()
    {
        $setting = Setting::first();
        return view('admin.setting.index', compact('setting'));
    }
    function store(Request $request)
    {
        $setting = Setting::first();
        if ($setting) {
            //update
            $setting->update([
                'website_name' => $request->website_name,
                'website_url' => $request->website_url,
                'website_title' => $request->website_title,
                'website_keyword' => $request->website_keyword,
                'meta_description' => $request->meta_description,

                'address' => $request->address,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'email1' => $request->email1,
                'email2' => $request->email2,

                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instragram' => $request->instragram,
                'youtube' => $request->youtube,
            ]);

            return redirect()->back()->with('message', 'Setting Updated!');

        } else {
            //create
            Setting::create([
                'website_name' => $request->website_name,
                'website_url' => $request->website_url,
                'website_title' => $request->website_title,
                'website_keyword' => $request->website_keyword,
                'meta_description' => $request->meta_description,

                'address' => $request->address,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'email1' => $request->email1,
                'email2' => $request->email2,

                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instragram' => $request->instragram,
                'youtube' => $request->youtube,
            ]);

            return redirect()->back()->with('message', 'Setting created!');
        }
    }
}
