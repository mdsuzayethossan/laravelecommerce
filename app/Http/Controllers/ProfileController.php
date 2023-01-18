<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    function profile_edit()
    {
        return view('admin.profile.edit');
    }
    function profile_update(ProfileRequest $request)
    {
        $request->validate([
            'photo' => 'image',
            'photo' => 'file|max:4000',
            'password' => 'required|confirmed',
            'password' => Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised(),
        ]);

        if (Auth::user()->photo != 'default.png') {

            $path = public_path() . "/uploads/users/" . Auth::user()->photo;

            if(is_file($path)){
                unlink($path);
                $new_profile_photo = $request->photo;
                $extension = $new_profile_photo->getClientoriginalExtension();
                $new_profile_name = Auth::id() . '.' . $extension;
                image::make($new_profile_photo)->save(base_path('public/uploads/users/' . $new_profile_name));

            }
            else {
                $new_profile_photo = $request->photo;
                $extension = $new_profile_photo->getClientoriginalExtension();
                $new_profile_name = Auth::id() . '.' . $extension;
                image::make($new_profile_photo)->save(base_path('public/uploads/users/' . $new_profile_name));

            }

        }

        if (Hash::check($request->ol_password, Auth::user()->password)) {
            $new_profile_photo = $request->photo;
            $extension = $new_profile_photo->getClientoriginalExtension();
            $new_profile_name = Auth::id() . '.' . $extension;
            image::make($new_profile_photo)->save(base_path('public/uploads/users/' . $new_profile_name));
            User::find(Auth::id())->update([
                'name' => $request->profile_name,
                'password' => bcrypt($request->password),
                'photo' => $new_profile_name,

            ]);
            return back()->with('update_pass', 'Password Updated Successfully');
        } else {
            return back()->with('error_update_pass', 'Old Password thik hoi nai');
        }
    }
}
