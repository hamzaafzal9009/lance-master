@extends('layout.front-master')
@section('title', 'Lance Master | Home Page')
<?php
// dd( $video);
?>
@section('content')


    <div class="video">
        <video autoplay controls id="watchVideos" vid="{{ $video->id }}" onseeked="writeVideoTime(this.getAttribute('vid'),this.currentTime);"
            onclick="writeVideoTime(this.getAttribute('vid'),this.currentTime);">
            <source src="{{ asset($video->video_path) }}" type="video/mp4">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            Your browser does not support the video tag.
        </video>
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

        <div class="tab-pane fade" id="comments">
            {{-- @include('front.') --}}
        </div>
    </div>

@endsection
