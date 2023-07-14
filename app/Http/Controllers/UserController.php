<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function myAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);

        $data['header_title'] = "My Account";
        if (Auth::user()->user_type == 2) {
            return view('teacher.my-account', $data);
        } else if (Auth::user()->user_type == 3) {
            return view('student.my-account', $data);
        }
    }

    public function parentAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";
        return view('parent.my-account', $data);
    }



    public function changePassword()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change-password', $data);
    }




    public function updateChangePassword(Request $request)
    {
        $user  = User::getSingle(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', 'Password Successfully Updated');
        } else {
            return redirect()->back()->with('error', 'Old Password not Correct');
        }
    }
}
