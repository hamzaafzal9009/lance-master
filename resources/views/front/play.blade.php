@extends('layout.front-master')
@section('title', 'Lance Master | Home Page')

    <?php
    // dd($video->video_path);
    ?>
@section('content')


    <div class="video">
        @php 
        if($video->continueWatches->first()){
            $v_time = round($video->continueWatches->first()->time);
        }
        else{
            $v_time = 0;
        }
        @endphp
        <video autoplay controls id="{{ $video->id }}" onseeked="writeVideoTime(this.id,this.currentTime);"
            onclick="writeVideoTime(this.id,this.currentTime);"
            class="recommended-videos" id="recommendedVideoPlayer{{ $video->id }}" data-id="{{ $video->id }}" data-time="{{ $v_time }}">
            <source src="{{ asset($video->video_path) }}" type="video/mp4">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            Your browser does not support the video tag.
        </video>
        {{-- <video autoplay controls id="{{ $video->id }}" onseeked="writeVideoTime(this.id,this.currentTime);"
            onclick="writeVideoTime(this.id,this.currentTime);">
            <source src="{{ asset($video->video_path) }}" type="video/mp4">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            Your browser does not support the video tag.
        </video> --}}
    </div>

    <div class="user-details my-3">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                @if ($video->user->profile == null)
                    <img src="{{ asset('assets/images/avatar-1.jpg') }}" alt="..." class="profile-image">
                @else
                    <img src="{{ asset($video->user->profile->profile_image) }}" alt="..." class="profile-image">
                @endif

                <div class="align-self-center px-3">
                    <h4> <a href="{{ route('channel.index', $video->user->id) }}"
                            class="text-light">{{ $video->user->name }}</a></h4>
                    <p>{{ sizeof($video->user->subscribers) }} Subscribers</p>
                </div>
            </div>
        </div>
    </div>


    <div class="videos mt-3">
        <div class="tabs">
            <ul id="myTab" class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#suggested" class="nav-link active" data-toggle="tab">Suggested</a>
                </li>
                <li class="nav-item">
                    <a href="#comments" class="nav-link" data-toggle="tab">Comments</a>
                </li>
                <li class="nav-item">
                    <a href="#details" class="nav-link" data-toggle="tab">Details</a>
                </li>
            </ul>
        </div>
    </div>



    <div class="tab-content">
        <div class="tab-pane fade show active" id="suggested">
            Hello
        </div>

        <div class="tab-pane fade text-left" id="comments">
            @include('front.videos.commentsDisplay', ['comments' => $video->comments , 'video_id' => $video->id])

            <hr>
            <h4 class="text-left">Add Comment</h4>
            <form action="{{ route('comments.store') }}" method="POST" class="col-md-4">
                @csrf
                <div class="form-group">
                    <textarea name="body" class="form-control"></textarea>
                    <input type="hidden" name="video_id" value="{{ $video->id }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Add Comment</button>
                </div>
            </form>
            {{-- {{ $video->comments }} --}}
        </div>

        <div class="tab-pane fade" id="details">

        </div>
    </div>

@endsection
