<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function index()
    {
        return view('frontend.user.profile');
    }
    function updateUserDetails(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'pin_code' => 'required',
            'address' => 'required',
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
        ]);
        $user->userDetails()->updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'phone' => $request->phone,
                'pin_code' => $request->pin_code,
                'address' => $request->address,
                'address' => $request->address,
            ]
        );

        return redirect()->back()->with('message', 'Profile Updated successfully');
    }
    function passwordCreate()
    {
        return view('frontend.user.change-password');
    }
    function changepassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if ($currentPasswordStatus) {

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message', 'Password Updated Successfully');
        } else {

            return redirect()->back()->with('message', 'Current Password does not match with Old Password');
        }
    }
}
