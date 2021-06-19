<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{

    public function index($id)
    {
        $user = auth()->user();
        return view('front.panel.profile', compact(['user']));
    }

    public function studio()
    {
        $authUser = auth()->user();
        $user = User::with(['videos'])->find($authUser->id);

        return view('front.panel.studio', compact(['user']));
    }

}
