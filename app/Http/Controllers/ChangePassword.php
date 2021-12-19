<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Controller
{
    public function ChangePassword()
    {
        $user = User::find(Auth::user()->id);
        return view('admin.body.change_password', compact('user'));
    }

    public function UpdatePassword(Request $request)
    {
        $validateData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification = array(
                'message' => 'Password Updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('login')->with($notification);
        } else {
            $notification = array(
                'message' => 'Current Password is Invalid',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    //========= USER PROFILE =========//
    public function EditProfile()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            if ($user) {
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }
    public function UpdateProfile(Request $request)
    {
        $user = User::find(auth::user()->id);
        if($user) {

            $old_image = $request->old_image;
            $image = $request->file('profile_photo_path');

            if($image) {
                $name_gen = hexdec(uniqid());
                $img_ext = strtolower($image->getClientOriginalExtension());
                $img_name = $name_gen . '.' . $img_ext;
                $up_location = 'image/profilepic/';
                $last_img = $up_location . $img_name;
                $image->move($up_location, $img_name);
                
                if($old_image){
                    unlink($old_image);
                }

                // $user->name = $request->name;
                // $user->email = $request->email;
                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->profile_photo_path = $last_img;
                $user->save();

                $notification = array(
                    'message' => 'Profile Updated Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }else{
                // $user->name = $request->name;
                // $user->email = $request->email;
                $user->name = $request['name'];
                $user->email = $request['email'];
                $user->save();

                $notification = array(
                    'message' => 'Profile Updated Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }

        }else{
            return redirect()->back();
        }
    }
}
