<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    
    public function index($id)
    {
        $user = User::with(['videos', 'playlists', 'subscribers'])->find($id);
        // return $user;
        return view('front.channel', compact(['user']));
    }
}
