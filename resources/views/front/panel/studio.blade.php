@extends('layout.user-dashboard')
@section('title', 'Lance Master | Home Page')

@section('content')
    <section class="streamManager">
        <div class="heading">
            <h2>
                Videos
            </h2>
        </div>

        <div class="playList">
            @foreach ($user->videos as $video)
                <div>
                    <div class="boxImg">
                        <video controls width='100%' id="recommendedVideoPlayer{{ $video->id }}"
                            onclick="playVideo(this.id);">
                            <source src="{{ asset($video->video_path) }}">
                        </video>
                        <div class="px-3">
                            <div class="title">
                                <div>
                                    {{ $video->title }}
                                    <p class="float-right">
                                        @if (isset($video->view))
                                            @if (sizeof($video->view) > 0)
                                                {{ $video->views->total_views }} Views
                                            @endif
                                        @else
                                            0 Views
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="details">
                                <div class="profile-pic">
                                    <img src="{{ asset('assets/front/images/dummy.jpg') }}" alt="">
                                </div>
                                <div class="video-details">
                                    <div class="channel">
                                        <a href="" class="color-white">
                                            <span class="text-capitalize">{{ $video->user->name }}</span> Channel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
