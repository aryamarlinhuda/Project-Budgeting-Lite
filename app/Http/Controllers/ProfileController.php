<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile() {
        $id = session('user');
        $data = User::find($id);

        return view('profile.profile')->with('data',$data);
    }

    public function edit_profile() {
        $id = session('user');
        $data = User::find($id);

        return view('profile.edit-profile')->with('data',$data);
    }

    public function edit_profile_process(Request $request) {
        $id = session('user');
        $data = User::find($id);

        $request->validate([
            "name" => "required",
            "photo" => "max:3048",
            "email_or_phone" => "required",
        ],[
            "name.required" => "Name is required!",
            "photo.max" => "Photo size must be less than 3MB!",
            "email_or_phone.required" => "Phone Number or Email is required!",
        ]);

        if (preg_match('/[a-zA-Z]/', $request->email_or_phone)) {
            $request->validate([
                "email_or_phone" => "email",
            ],[
                "email_or_phone.email" => "Email must be a valid email address!"
            ]);

            $same = user::where('email_or_phone',$request->email_or_phone)->whereNotIn('id',[$id])->first();
            if($same) {
                return redirect('edit-profile')->with('credentials','Email is already in use!');
            }
        } else {
            $request->validate([
                "email_or_phone" => "numeric | digits_between:7,15",
            ],[
                "email_or_phone.digits_between" => "Phone number must be between 7 and 15 digits!"
            ]);

            $code = substr($request->email_or_phone, 0, 1);
            if($code === "0") {
                return redirect('edit-profile')->with('credentials','Country code on the phone number is invalid!');
            }

            $same = user::where('email_or_phone',$request->email_or_phone)->whereNotIn('id',[$id])->first();
            if($same) {
                return redirect('edit-profile')->with('credentials','Phone Number is already in use!');
            }
        }

        $file = $request->file('photo');
        dd($file);
        if($file) {
            $format = $file->getClientOriginalExtension();
            if(strtolower($format) === 'jpg' || strtolower($format) === 'jpeg' || strtolower($format) === 'png') {
                $photo = $request->file('photo')->store('photo');
            } else {
                return redirect('edit-profile')->with('format','The photo format must be jpg, jpeg, or png!');
            }
        } else {
            $photo = $data->photo; 
        }

        user::where('id',$id)->update([
            "name" => $request->name,
            "photo" => $photo,
            "email_or_phone" => $request->email_or_phone,
        ]);

        session()->forget('photo');
        session()->put('photo',$photo);
        return redirect('profile')->with('success','Profile edited successfully');
    }

    public function change_password() {
        return view('profile.change-password');
    }

    public function change_password_process(Request $request) {
        $id = session('user');
        $user = user::where('id',$id)->first();

        $request->validate([
            "old_password" => "required | min:6",
            "new_password" => "required | min:6",
            "confirm_new_password" => "required | min:6 | same:new_password"
        ],[
            "old_password.required" => "Old password is required!",
            "old_password.min" => "Old Password must contain 6 characters or more",
            "new_password.required" => "New password is required!",
            "new_password.min" => "New Password must contain 6 characters or more",
            "confirm_new_password.required" => "Confirm the new password first!",
            "confirm_new_password.min" => "Confirm New Password must contain 6 characters or more",
            "confirm_new_password.same" => "New password confirmation is not the same!"
        ]);

        if(!Hash::check($request->old_password,$user['password'])) {
            return redirect('change-password')->with('wrong','Old password is wrong!');
        }

        if($request->old_password === $request->new_password) {
            return redirect('change-password')->with('same','The new password is the same as the old password');
        }

        $user['password'] = bcrypt($request->new_password);
        $user->save();

        return redirect('profile')->with('success','Change Password Successfully');
    }

    public function delete_photo() {
        $id = session('user');
        $user = User::find($id);

        $user->photo = null;
        $user->save();

        return redirect('profile')->with('success','Photo Profile Successfully Deleted!');
    }
}
