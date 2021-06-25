@foreach ($comments as $comment)
    <div class="display-comments text-left" @if ($comment->parent_id != null) style="margin-left:40px" @endif>

        <h6>{{ $comment->user->name }}</h6>

        <p>{{ $comment->body }}</p>

        <a href="" id="reply"></a>

        <form action="{{ route('comments.store') }}" method="POST" class="col-md-4">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control">
                <input type="hidden" name="video_id" value="{{ $video_id }}">
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            </div>

            <button type="submit" class="btn btn-primary">Reply</button>
        </form>
        @isset($comment->like)

            @if ($comment->like->user_id != auth()->user()->id && $comment->like->comment_id != $comment->id)

                <form action="{{ route('comments.like') }}" method="POST">
                    @csrf
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <button type="submit" class="btn btn-link">Like</button>
                </form>

            @endif

        @endisset

        @include('front.videos.commentsDisplay', ['comments' => $comment->replies] )

    </div>
@endforeach
