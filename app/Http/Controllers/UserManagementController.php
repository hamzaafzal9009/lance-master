<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\SignupEmail;
use Illuminate\Support\Facades\Mail;

class UserManagementController extends Controller
{
    //
    public function allUser(){
        $users = User::all();
        return view('user-management',compact('users'));
    }
    public function create(){
        return view('create-user');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'is_active' => 'required',
        ]);
            $user = new User;
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->password     = Hash::make($request->password);
            $user->user_type    = $request->user_type;
            $user->is_active    = $request->is_active;
            $user->save();
            
            return redirect('/usermanagement')->with('Success', 'User Created Successfully.');
    }
    public function editUser($id){
        $user = User::find($id);
        return view('edit-user',compact('user'));
    }
    public function updateUser(Request $request,$id){
            $user = User::find($id);
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->password     = Hash::make($request->password);
            $user->user_type    = $request->user_type;
            $user->is_active    = $request->is_active;
            $user->save();
            
            Mail::to($user->email)->send(new ConfirmationEmail($user->email,$request->password));

            return redirect('/usermanagement')->with('Success', 'User Edit Successfully.');
    }
    public function delete($id){
            $user = User::find($id);
            $user->delete();
            return redirect('/usermanagement')->with('Success', 'User Deleted Successfully.');
    }
}
