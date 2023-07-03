<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Str;


class AuthController extends Controller
{
    public function login()
    {
        // return view('auth/login');
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } else if (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');
            } else if (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            } else if (Auth::user()->user_type == 4) {
                return redirect('parent/dashboard');
            }
        }
        return view('auth.login');
    }

    public function authLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {

            if (Auth::user()->user_type == 1 && Auth::user()->is_delete == 0) {
                return redirect('admin/dashboard');
            } else if (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');
            } else if (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            } else if (Auth::user()->user_type == 4) {
                return redirect('parent/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Please enter correct email and password');
        }
    }

    public function forgotPassword()
    {
        return view('auth.forgot');
    }

    public function postForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) {


            $user->remember_token =  Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgetPasswordMail($user));
            return redirect()->back()->with('success', 'Please check your email for reset link');
        } else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }

    public function resetPassword($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if (!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function postResetPassword($token, Request $request)
    {
        if ($request->password == $request->cpassword) {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect('login')->with('success', 'Password successfully reset');
        } else {
            return redirect()->back()->with('error', 'Passwords does not match');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url('login'));
    }
}
