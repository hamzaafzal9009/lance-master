@extends('layout.front-master')
@section('title', 'Lance Master | Home Page')

<?php
// dd($video->video_path);
?>
@section('content')


    <div class="video">
        <video autoplay controls id="watchVideos" vid="{{ $video->id }}"  onseeked="writeVideoTime(this.getAttribute('vid'),this.currentTime)" onclick="writeVideoTime(this.getAttribute('vid'),this.currentTime);">
            <source src="{{ asset($video->video_path) }}" type="video/mp4" >
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            Your browser does not support the video tag.
        </video>
    </div>


@endsection
