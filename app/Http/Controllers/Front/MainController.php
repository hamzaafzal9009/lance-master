<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Notifies;
use App\Models\User;
use App\Models\VideoContent;

class MainController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $recommendedVideos = VideoContent::with(['views', 'user', 'continueWatches'])->inRandomOrder()->limit(8)->get();
        // return $recommendedVideos->views;
        return view('front.index', compact(['user', 'recommendedVideos']));
    }

    public function playVideo($id)
    {
        // return $id;
        // $video = VideoContent::find($id);

        $video = VideoContent::with(['continueWatches'])->where('id', $id)->get()->first();
        // dd($video);
        return view('front.play', compact(['video']));
    }

    public function notifications()
    {
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }

    public function notifies()
    {
        $userID = auth()->id();
        $user = User::with('notifications')->find(auth()->id());

        // return $user->notifications[0]->notification_by_id;
        return view('front.notifications', compact(['user']));
    }

    // public function test()
    // {

    //     $user = User::with('subscribers')->find(auth()->id());
        
    //     foreach ($user->subscribers as $subscriber) {
    //         $notification = new Notifies();
    //         $notification->notification_by_id = $user->id;
    //         $notification->notification_to_id = $subscriber->id;
    //         $notification->message = $user->name  . ' has posted a new video';
    //         $notification->save();
    //     }
    // }
}
