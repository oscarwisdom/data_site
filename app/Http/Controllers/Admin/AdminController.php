<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Help;
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

    public function add_help(Request $request) {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255',
            'content' => 'required|string',
            'help_video' => 'nullable|mimes:mp4,mov,avi|max:20480',
            'help_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $help = new Help;
        $help->category = $request->category;
        $help->content = $request->content;

        // Handle video upload
        if ($request->hasFile('help_video')) {
            $videoFile = $request->file('help_video');
            $videoFileName = time() . '_' . $videoFile->getClientOriginalName();
            $videoFile->move(public_path('uploads/videos'), $videoFileName);
            $help->video = 'uploads/videos/' . $videoFileName;
        }

        // Handle image upload
        if ($request->hasFile('help_img')) {
            $imageFile = $request->file('help_img');
            $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move(public_path('uploads/images'), $imageFileName);
            $help->img = 'uploads/images/' . $imageFileName;
        }
        $help->save();

        return redirect()->back()->with('message', 'Help Content Added Successfully');
    }


    public function delete_help(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Category is required');
        }

        $help = Help::where('category', $request->category)->first();

        if (!$help) {
            return redirect()->back()->with('error', 'Help content not found');
        }

        // Delete associated files if they exist
        if ($help->video) {
            $videoPath = public_path('uploads/' . $help->video);
            if (File::exists($videoPath)) {
                File::delete($videoPath);
            }
        }

        if ($help->img) {
            $imagePath = public_path('uploads/' . $help->img);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $help->delete();

        return redirect()->back()->with('message', 'Help content deleted successfully');
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
