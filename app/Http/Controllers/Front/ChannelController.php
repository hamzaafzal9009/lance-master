<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Notifies;
use App\Models\Playlist;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\VideoContent;
use Illuminate\Http\Request;

class ChannelController extends Controller
{

    public function index($id)
    {
        $user = User::with(['videos', 'playlists', 'subscribers', 'profile'])->find($id);
        // return $user;
        return view('front.channel', compact(['user']));
    }

    public function subscribe($id)
    {

        $subscriber = new Subscriber;
        $subscriber->subscriber_id = auth()->id();
        $subscriber->account_id = $id;
        if ($subscriber->save()) {

            $notification = new Notifies;
            $notification->notification_by_id = auth()->id();
            $notification->notification_to_id = $id;
            $notification->message = auth()->user()->name . 'has started following you';
            $notification->save();

            // $user->notify(new UserFollowed(auth()->user()));

            return redirect()->back()->with('success', 'Subscribed');
        }

    }

    public function unsubscribe($subscriberId, $accountID)
    {
        $subscriber = Subscriber::where('account_id', $accountID)->where('subscriber_id', $subscriberId)->first();
        $subscriber->delete();
        return redirect()->back();
    }

    public function playlist($id)
    {
        $playlist = Playlist::with('videos')->find($id);
        // return $playlist;

        return view('front.playlist', compact(['playlist']));
    }

    public function createPlaylist($id)
    {

        $user = User::find($id);
        return view('front.create-playlist', compact(['user']));
    }

    public function storePlaylist(Request $request, $id)
    {
        // return $requset->all();
        $playlist = new Playlist;
        $playlist->u_id = $id;
        $playlist->playlist_name = $request->playlist_name;
        $playlist->save();

        return redirect()->back()->with('success', 'Playlist created successfully');
    }

    public function assignVideoToPlaylistView($id)
    {
        $playlist = Playlist::find($id);
        $videos = VideoContent::where('u_id', auth()->id())->with('playlists')->get();
        return view('front.assign-video', compact(['playlist', 'videos']));
    }

    public function assignVideoToPlaylist(Request $request, $id)
    {
        $playlist = Playlist::find($id);
        $playlist->videos()->attach($request->videos);
        return redirect()->back()->with('success', 'Videos assigned successfully');
        // return $requset->all();
    }
}
