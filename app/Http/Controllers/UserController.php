<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //
    public function editUserDetails($id){
        // dd('Hello');
        $user = User::find($id);
        return view('users.accounts-edits',compact('user'));
    }
    public function updateUser(Request $request,$id){
        $user = User::find($id);
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        $user->save(); 
        Mail::to($user->email)->send(new PasswordReset($user));
         
        return redirect('/home')->with('Success', 'User Edit Successfully.');
}
}
