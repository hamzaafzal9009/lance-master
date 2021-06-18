<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\VideoContent;
use Illuminate\Http\Request;

class VideoContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videocontent = VideoContent::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('form-upload', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $req->validate([
            //'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'video' => 'required | mimes:mp4,mov,ogg',
        ]);

        $videoModel = new VideoContent();

        if ($req->file()) {
            $videoName = time() . '_' . $req->video->getClientOriginalName();
            $videoPath = $req->file('video')
                ->storeAs('uploads', $videoName, 'public');

            $videoModel->videoname = time() . '_' . $req->video
                ->getClientOriginalName();
            $videoModel->video_path = '/storage/' . $videoPath;
            $videoModel->name = $req->name;
            $videoModel->title = $req->title;
            $videoModel->description = $req->description;
            $videoModel->category_id = $req->category;
            $videoModel->save();

            return back()
                ->with('success', 'video has been uploaded.')
                ->with('video', $videoName);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VideoContent  $videoContent
     * @return \Illuminate\Http\Response
     */
    public function show(VideoContent $videoContent)
    {
        return view('video.show', compact('$id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoContent  $videoContent
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoContent $videoContent)
    {
        return view('video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoContent  $videoContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoContent $videoContent)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'video' => 'required | mimes:mp4,mov,ogg',
        ]);

        $video->update($request->all());

        return redirect()->route('video.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoContent  $videoContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoContent $videoContent)
    {
        $video->delete();

        return redirect()->route('video.index')
            ->with('success', 'post deleted successfully');
    }
}
