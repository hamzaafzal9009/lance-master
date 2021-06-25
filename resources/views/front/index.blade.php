@extends('layout.front-master')
@section('title', 'Lance Master | Home Page')

@section('content')
    <div id="carousalTop" class="carousel slide mt-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousalTop" data-slide-to="0" class="active"></li>
            <li data-target="#carousalTop" data-slide-to="1"></li>
            <li data-target="#carousalTop" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/front/images/banner1.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/front/images/banner2.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/front/images/banner3.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousalTop" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousalTop" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="playRow mt-4">
        <div class="heading">
            <h2>Recommended For You</h2>
        </div>
        <div class="playList">
            @foreach ($recommendedVideos as $video)
                <div>
                    <div class="boxImg" onclick="playVideo(this.id);">
                        <img src="{{ asset($video->thumbnail) }}"  data-href="{{ URL::to('/video', $video->id) }}"
                            class="video-list clickable" />
                         <!-- <video controls width='100%' class"video_container" onseeked="writeVideoTime(this.currentTime);" id="recommendedVideoPlayer{{ $video->id }}" height='200px' onclick="playVideo(this.id,this.currentTime);">
                            <source src="{{ asset($video->video_path) }}"> -->
                        <!-- </video>  -->
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
                                        <a href="{{ route('channel.index', $video->user->id) }}" class="color-white">
                                            <span class="text-capitalize">{{ $video->user->name }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
