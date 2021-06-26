@extends('layout.front-master')
@section('title', 'Lance Master | Library')

@section('content')
    <div class="playRow mt-6">
        <div class="heading">
            <h2><i class="fa fa-history"></i> History</h2>
        </div>
        <div class="playList">
            @foreach ($historyVideos as $video)
                <div>
                    <div class="boxImg">
                        <img src="{{ asset($video->video->thumbnail) }}" data-href="{{ URL::to('/video', $video->video->id) }}"
                            class="video-list clickable" />
                        {{-- <video controls width='100%' id="recommendedVideoPlayer{{ $video->video->id }}" height='200px' onclick="playVideo(this.id);">
                            <source src="{{ asset($video->video->video_path) }}">
                        </video> --}}
                        <div class="px-3">
                            <div class="title">
                                <div>
                                    {{ $video->video->title }}
                                    <p class="float-right">
                                        @if (isset($video->video->views))
                                            {{ sizeof($video->video->views) }} Views
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
                                        <a href="{{ route('channel.index', $video->video->user->id) }}" class="color-white">
                                            <span class="text-capitalize">{{ $video->video->user->name }}</span>
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
