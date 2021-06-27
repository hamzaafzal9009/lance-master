@extends('layout.front-master')
@section('title', 'Lance Master | Trending')

@section('content')
    <div class="playRow mt-4">
        <div class="heading">
            <h2><i class="fa fa-flame"></i> Search Results</h2>
        </div>
        <div class="historyList" style="width: 70%">
            @foreach ($searchVideos as $video)
                <table>
                    <br><br>
                    <tr >
                        <th><div style="border-bottom: 1px solid white;"></th>
                    </tr>
                    <tr>
                        <th style="padding-top: 10px;"><h6>{{ $video->updated_at->format('M d') }}</h6></th>
                    </tr>
                    <tr>
                        <td style="width: 300px;height: 200px;max-width: 300px;padding-right: 30px;">
                            <img src="{{ asset($video->thumbnail) }}" data-href="{{ URL::to('/video', $video->id) }}"
                            class="video-list clickable" />    
                        </td>
                        <td>
                            <h5 style="text-decoration-line: underline">{{$video->title}}<h5>
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
                            <p style="font-size: 13px;color: goldenrod;font-weight: bold;line-height: normal;">
                                @if (isset($video->views))
                                    {{ sizeof($video->views) }} Views
                                @endif
                            </p>
                            <small>{{$video->description}}</small>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <div class="px-3">
                                <div class="title">
                                    <div>
                                        {{ $video->title }}
                                    </div>
                                </div>
                            </div>        
                        </th>
                    </tr>
                </table>
            @endforeach
        </div>
    </div>

@endsection
