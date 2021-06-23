<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\VideoContent;

class MainController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $recommendedVideos = VideoContent::with(['views', 'user'])->inRandomOrder()->limit(8)->get();
        // return $recommendedVideos;
        return view('front.index', compact(['user', 'recommendedVideos']));
    }

    public function playVideo($id)
    {
        // return $id;
        $video = VideoContent::find($id);
        return view('front.play', compact(['video']));
    }
}
