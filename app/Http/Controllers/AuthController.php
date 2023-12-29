<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_form() {
        if(session()->has('user')) {
            return redirect('home')->with('success','Welcome Back!');
        } else {
            return view('login');
        }
    }

    public function login(Request $request) {
        $request->validate([
            "email_or_phone" => "required",
            "password" => "required | min:6"
        ],[
            "email_or_phone.required" => "Phone Number or Email is required!",
            "password.required" => "Password is required!",
            "password.min" => "Password must contain 6 characters or more!" 
        ]);

        if (preg_match('/[a-zA-Z]/', $request->email_or_phone)) {
            $request->validate([
                "email_or_phone" => "email",
            ],[
                "email_or_phone.email" => "Email must be a valid email address!"
            ]);
        } else {
            $request->validate([
                "email_or_phone" => "numeric | digits_between:7,15",
            ],[
                "email_or_phone.digits_between" => "Phone number must be between 7 and 15 digits!"
            ]);
        }

        $user = user::where('email_or_phone',$request->email_or_phone)->first();
        if(!$user) {
            return redirect('/')->with('not_found','Phone Number or Email not found!');
        }

        if(!Hash::check($request->password,$user->password)) {
            return redirect('/')->with('error','Wrong password!');
        } else {
            $id = $user->id;
            session()->put('user',$id);
            session()->put('photo',$user->photo);
            return redirect('home')->with('success','Login Successfully');
        }
    }

    public function register_form() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            "name" => "required",
            "email_or_phone" => "required",
            "password" => "required | min:6",
            "confirm_password" => "required | min:6 | same:password"
        ],[
            "name.required" => "Name is required!",
            "email_or_phone.required" => "Phone Number or Email is required",
            "password.required" => "Password is required!",
            "password.min" => "Password must contain 6 characters or more",
            "confirm_password.required" => "Confirm Password is required!",
            "confirm_password.min" => "Confirm Password must contain 6 characters or more",
            "confirm_password.same" => "Confirm Password doesn't match password"
        ]);

        $file = $request->file('photo');
        if($file) {
            $request->validate([
                "photo" => "file | max:3048"
            ],[
                "photo.file" => "Photo must be an image file!",
                "photo.max" => "Photo must be less than 3 MB!"
            ]);

            $format = $file->getClientOriginalExtension();
            if(strtolower($format) === 'jpg' || strtolower($format) === 'jpeg' || strtolower($format) === 'png') {
                $photo = $request->file('photo')->store('photo');
            } else {
                return redirect('register')->with('format','The photo format must be jpg, jpeg, or png');
            }
        } else {
            $photo = null;
        }

        if (preg_match('/[a-zA-Z]/', $request->email_or_phone)) {
            $request->validate([
                "email_or_phone" => "email",
            ],[
                "email_or_phone.email" => "Email must be a valid email address!"
            ]);
        } else {
            $request->validate([
                "email_or_phone" => "numeric | digits_between:7,15",
            ],[
                "email_or_phone.digits_between" => "The phone number must be between 7 and 15 digits!",
            ]);
        }

        $same = User::where("email_or_phone",$request->input("email_or_phone"))->first();
        if($same) {
            return redirect('register')->with('registered','Email or Phone Number is registered!');
        }

        User::create([
            "name" => $request->input("name"),
            "photo" => $photo,
            "email_or_phone" => $request->input("email_or_phone"),
            "password" => bcrypt($request->input("password")),
        ]);

        $request->session()->flash('email_or_phone',$request->input('email_or_phone'));
        $request->session()->flash('password',$request->input('password'));
        return redirect('/')->with('register','Registrasion Successfully');
    }

    public function logout() {
        session()->flush();

        return redirect('/')->with('logout','Logout Successfully');
    }
}
