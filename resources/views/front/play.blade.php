@extends('layout.front-master')
@section('title', 'Lance Master | Home Page')

@section('content')

    <div class="video">
        <video autoplay controls>
            <source src="{{ asset($video->video_path) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>


@endsection
