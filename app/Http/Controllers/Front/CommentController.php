<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        Comment::create($input);

        return back();
    }

    public function like(Request $request)
    {

        // return $request->all();
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        CommentLike::create($input);
        return back();
    }
}
