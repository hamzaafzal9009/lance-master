<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Playlist;
use App\Models\User;
use App\Models\VideoContent;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index($id)
    {
        $user = auth()->user();
        return view('front.panel.profile', compact(['user']));
    }

    public function studio()
    {

        $user = User::with(['videos'])->find(auth()->id());
        // return $user->videos;

        return view('front.panel.studio', compact(['user']));

    }

    public function upload()
    {
        $categories = Category::get();
        $userID = auth()->user()->id;
        $user = User::find($userID);
        $playlists = $user->playlists;
        // return $playlist;
        return view('front.panel.upload', compact(['categories', 'playlists']));
    }

    public function storeVideo(Request $request)
    {
        $video = $request->file('video');
        $videoName = time() . '_' . $video->getClientOriginalName();
        $videoPath = public_path() . '/uploads/videos/';
        $video->move($videoPath, $videoName);

        $video_title = $request->video_title;
        $video_description = $request->video_description;
        $video_category = $request->video_category;
        $playList = $request->playList;
        $video_playlist = $request->video_playlist;
        $video_tags = $request->video_tags;

        $videoModel = new VideoContent;
        $videoModel->u_id = auth()->id();
        $videoModel->title = $video_title;
        $videoModel->description = $video_description;
        $videoModel->category_id = $video_category;
        $videoModel->video_path = '/uploads/videos/' . $videoName;
        $videoModel->videoname = $videoName;
        $videoModel->tags = $video_tags;

        $videoModel->save();

        if ($playList == 'yes') {
            $videoModel->playlists()->attach($video_playlist);
        }
        return redirect()->back()->with('success', "Video Uploaded Successful");

    }

    public function editVideo($id)
    {
        $video = VideoContent::with(['category', 'playlists'])->find($id);
        $categories = Category::get();
        $playlists = Playlist::get();
        return view('front.panel.edit-video', compact(['video', 'categories', 'playlists']));
    }

    public function updateVideo(Request $request, $id)
    {
        // return $request->all();
        $video = $request->file('video');

        $thumbnail = $request->file('thumbnail');

        $video_title = $request->video_title;
        $video_description = $request->description;
        $video_category = $request->video_category;
        $playList = $request->playList;
        $video_playlist = $request->video_playlist;
        $video_tags = $request->video_tags;

        $videoModel = VideoContent::find($id);
        $videoModel->u_id = auth()->id();
        $videoModel->title = $video_title;
        $videoModel->description = $video_description;
        $videoModel->category_id = $video_category;

        $videoModel->tags = $video_tags;
        if ($video != null) {
            $videoName = time() . '_' . $video->getClientOriginalName();
            $videoPath = public_path() . '/uploads/videos/';
            $video->move($videoPath, $videoName);
            $videoModel->video_path = '/uploads/videos/' . $videoName;
            $videoModel->videoname = $videoName;
        }

        if ($thumbnail != null) {

            $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnailPath = public_path() . '/uploads/thumbnails/';
            $thumbnail->move($videoPath, $thumbnailName);
            $videoModel->thumbnail = $thumbnail;
        }
        $videoModel->save();
        return redirect()->back()->with('success', 'Updated Successfully');
        // dd($videoName = time() . '_' . $video->getClientOriginalName());

    }

    public function deleteVideo($id)
    {
        $video = VideoContent::find($id);
        $video->delete();
        return redirect()->back();
    }
}
