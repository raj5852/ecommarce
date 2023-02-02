<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function index(){
        $users = User::paginate(10);
        return view('admin.users.index',compact('users'));
    }
    function create(){
        return  view('admin.users.create');
    }
    function srore(Request $request){
        $validated = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'role_as'=>'required'
        ]);

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'role_as'=>$request->role_as
        ]);

        return redirect('admin/users')->with('message','User created successfully!');

    }
    function edit($userId){
        $user = User::findOrFail($userId);
        return view('admin.users.edit',compact('user'));
    }
    function update(Request $request, int $userId){
        $validated = $request->validate([
            'name'=>'required',
            'password'=>'required',
            'role_as'=>'required'
        ]);

         User::findOrFail($userId)->update([
            'name'=> $request->name,
            'password'=> bcrypt($request->password),
            'role_as'=>$request->role_as
        ]);

        return redirect('admin/users')->with('message','User Updated successfully!');

    }
    function delete($userId){
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('admin/users')->with('message','User Deleted successfully!');

    }
}
