<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContinueWatch;
use App\Models\VideoContent;

class MainController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $recommendedVideos = VideoContent::with(['views', 'user'])->inRandomOrder()->limit(8)->get();
        $watchListVideos = VideoContent::whereHas('category' ,function($q){$q->where('id', '=', '3');})->get();
        $watchedHistory = ContinueWatch::with(['userHistory','videoHistory'])->where('u_id',$user->id)->get();
        return view('front.index', compact(['user', 'recommendedVideos','watchListVideos','watchedHistory']));
    }

    public function playVideo($id)
    {
        // return $id;
        $video = VideoContent::find($id);
        return view('front.play', compact(['video']));
    }
}
