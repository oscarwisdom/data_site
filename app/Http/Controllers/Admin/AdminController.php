<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index() {
        $users = User::where('role',0)->get();

        return view('admin.index',
        ['users' => $users]
    );
    }

    public function users() {
        $users = User::where('role',0)->get();

        return view('admin.users',
        ['users' => $users]
    );
    }

    public function profile() {
        $user = User::where('id',Auth::user()->id)->get();

        return view('admin.profile',
        ['user' => $user]
    );
    }

    public function update_profile(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', 'Error Updating Admin Profile');
        }

        $admin = User::where('role','1')->first();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->update();

        return redirect('admin/profile')->with('message', 'Personal Information Updated Successfully');
    }

    public function update_password(Request $request) {

        // continue from last class

        
    }

    public function get_settings() {
        $settings = Settings::where('id','1')->first();

        return view('admin.settings', [
            'settings' => $settings
        ]);
    }

    public function update_settings(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'logo' => 'nullable',
            'favicon' => 'nullable',
            'description' => 'nullable',
            'keywords' => 'nullable'
        ]);

        /* if ($validator->fails()) {
            return redirect()->back()->with('message', 'All Field Are Required');
        } */

        $settings = Settings::where('id','1')->first();

        if ($settings) {
            
            $settings->website_title = $request->title;

            if ($request->hasfile('logo')) {
                $destination = 'uploads/'.$settings->logo;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('logo');
                $filename = uniqid() .'.'. $file->getClientOriginalExtension();
                $file->move('uploads/', $filename);
                $settings->logo = $filename;
            }

            if ($request->hasfile('favicon')) {
                $destination = 'uploads/'.$settings->favicon;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('favicon');
                $filename = uniqid() .'.'. $file->getClientOriginalExtension();
                $file->move('uploads/', $filename);
                $settings->favicon = $filename;
            }

            $settings->description = $request->description;
            $settings->keywords = $request->keywords;
            $settings->update();

            return redirect('admin/settings')->with('message', 'Settings Updated!');
        } else {
            $settings = new Settings;
            $settings->website_title = $request->title;

            if ($request->hasfile('logo')) {
                $file = $request->file('logo');
                $filename = uniqid() .'.'. $file->getClientOriginalExtension();
                $file->move('uploads/', $filename);
                $settings->logo = $filename;
            }

            if ($request->hasfile('favicon')) {
                $file = $request->file('favicon');
                $filename = uniqid() .'.'. $file->getClientOriginalExtension();
                $file->move('uploads/', $filename);
                $settings->favicon = $filename;
            }

            $settings->description = $request->description;
            $settings->keywords = $request->keywords;
            $settings->save();

            return redirect('admin/settings')->with('message', 'Settings Added!');
        }
    }
}
