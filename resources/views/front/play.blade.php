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
        <video controls class="recommended-videos" id="recommendedVideoPlayer{{ $video->id }}" data-id="{{ $video->id }}" data-time="{{ $v_time }}">
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

    <div class="v-description">
        <p>{{ $video->description }}</p>
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


@section('jscripts')

<script>

    function syncWatchTime(videoId, currentTime){//pass video id to this function where you call it.
        // console.log(videoId);
        // console.log(currentTime);

        var data = {time: currentTime}; //data to send to server 
        var dataType = "json";//expected datatype from server 
        var headers = { 'X-CSRF-TOKEN': $('input[name="_token"]').val()};
        $.ajax({   
            url: '/store/'+videoId,   //url of the server which stores time data   
            data: data,
            headers: headers,
            dataType: dataType,
            success: function(data,status){
                    // alert(status);
                    // var data = JSON.parse(data)
                    // console.log(data['message']);
            }   
        });
    }

    $(function() {

        var elements = document.getElementsByClassName("recommended-videos");

        var loadVideoFunction = function(vid_id, vid_time) {
            let myvideo = document.getElementById(vid_id);
            videoStartTime = vid_time;
            myvideo.currentTime = videoStartTime;
            console.log('Current Time', myvideo.currentTime);
            console.log('Video ID:', vid_id);
            // $('.video').click();
            // video = jQuery('#'+vid_id).get()[0];
            myvideo.play();
            // $('#'+vid_id)[0].addEventListener('play', event => {console.log('PLAY');});
        };

        for (var i = 0; i < elements.length; i++) {
            var vid_id = elements[i].getAttribute("id");
            var vid_time = elements[i].getAttribute("data-time");
            elements[i].addEventListener('loadedmetadata', loadVideoFunction(vid_id, vid_time), false);
        }

        document.querySelectorAll('.recommended-videos').forEach(item => {
            item.addEventListener('play', event => {
                console.log('PLAY');
            });

            item.addEventListener('pause', event => {
                console.log('PAUSE');                
            });

            item.addEventListener('timeupdate', event => {
                let req_stat = item.currentTime % 3;
                if(req_stat <= 0.4){
                    let vid_id = item.getAttribute("data-id");
                    console.log(req_stat);
                    syncWatchTime(vid_id, item.currentTime)
                }

            });
        })

        function onPlayProgress(data) {
            status.text(data.seconds + 's played');
        }

    });


    // function playVideo(id) {
    //     $(`#${id}`).click(function() {
    //         this.paused ? this.play() : this.pause();
    //     });

    // }
</script>

@endsection
