<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Playlist;

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
        $playlist = Playlist::with('videos')->get();
    }
}
