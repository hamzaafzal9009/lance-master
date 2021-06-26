<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Notifies;
use App\Models\User;
use App\Models\VideoContent;
use App\Models\Subscriber;
use App\Models\ContinueWatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class MainController extends Controller
{
    public function index(Request $request)
    {

        $user = auth()->user();
        $user_id = $user->id;

        if($request->q){
            $v_ids = VideoContent::select("id")
            ->where("title","LIKE","%{$request->get('q')}%")
            ->pluck('id');

            $recommendedVideos = VideoContent::with(['views', 'user', 'continueWatches'])->whereIn('id', $v_ids)->inRandomOrder()->limit(8)->get();
        }
        else{
            $recommendedVideos = VideoContent::with(['views', 'user', 'continueWatches'])->inRandomOrder()->limit(8)->get();
        }
        // return $recommendedVideos->views;

        $subscriptions = Subscriber::where('subscriber_id', '=', $user->id)->orderBy('created_at','asc')->pluck('account_id');
        $watchlistVideos = VideoContent::with(['views', 'user', 'continueWatches'])->wherein('u_id',$subscriptions)->inRandomOrder()->get();

        $contWatches = ContinueWatch::where('u_id', $user_id)->orderBy('updated_at','desc')->pluck('v_id');
        $contWatchesVideos = VideoContent::with(['views', 'user', 'continueWatches'])->wherein('id',$contWatches)->inRandomOrder()->get();

        $trendingVideos = DB::table('video_contents')
                ->join('continue_watches', 'video_contents.id', '=', 'continue_watches.v_id')
                ->select('v_id', DB::raw('count(continue_watches.id) as count'))
                ->groupBy('v_id')
                ->orderBy('count', 'desc')
                ->get();

        foreach($trendingVideos as $key => $video){
            $record = VideoContent::with(['views', 'user', 'continueWatches'])
                ->where('id', $video->v_id)
                ->get()->first();
            $video->record =  $record;
        }       

        return view('front.index', compact(['user', 'recommendedVideos', 'watchlistVideos', 'contWatchesVideos', 'trendingVideos']));
    }

    public function playVideo($id)
    {
        // return $id;
        // $video = VideoContent::find($id);

        $video = VideoContent::with(['continueWatches'])->where('id', $id)->get()->first();
        // dd($video);
        return view('front.play', compact(['video']));
    }

    public function library()
    {
        $user = auth()->user();
        if($user === null){
            return response()->json(['message' => 'User not authenticated'], 403);
        }
        $user_id = $user->id;

        //use this one if you update the time instead of inserting a new row each time a time is saved.
        $historyVideos = ContinueWatch::with(['video'])->where('u_id', $user_id)->orderBy('updated_at', 'desc')->get(); 
        // dd($historyVideos);

        return view('front.library', compact(['user', 'historyVideos']));
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

    public function trending()
    {
        $user = auth()->user();

        $trendingVideos = DB::table('video_contents')
                ->join('continue_watches', 'video_contents.id', '=', 'continue_watches.v_id')
                ->select('v_id', DB::raw('count(continue_watches.id) as count'))
                ->groupBy('v_id')
                ->orderBy('count', 'desc')
                ->get();

        // dd($trendingVideos);

        foreach($trendingVideos as $key => $video){
            // echo $key;
            $record = VideoContent::with(['views', 'user', 'continueWatches'])
                ->where('id', $video->v_id)
                ->get()->first();

            $video->record =  $record;
        }       
        // dd('OK'); 
        // dd($trendingVideos);
        return view('front.trending', compact(['user', 'trendingVideos']));
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
