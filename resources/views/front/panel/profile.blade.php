@extends('layout.user-dashboard')
@section('title', 'Lance Master | Home Page')

@section('content')
    <section class="portal">

        <div class="heading">
            <h2>
                CREATOR DASHBOARD
            </h2>
        </div>
        <div class="dashContent">
            <div class="box1">
                <div>
                    <img src="{{ asset('assets/front/images/user1.png') }}" alt="User profile picture">
                </div>
                <div>
                    <p class="boxLight">
                    <ul class="list">
                        <li>20<br>
                            Following
                        </li>
                        <li>30<br>
                            Followers</li>
                    </ul>
                    </p>
                </div>
            </div>
            <div class="s_box">
                <div>
                    <p class="boxBold">
                        Profile Details
                    </p>

                    <div class="user-details">
                        <div class="d-flex justify-content-around">
                            <p><strong>Name : </strong></p>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="d-flex justify-content-around">
                            <p><strong>Email : </strong></p>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="d-flex justify-content-around">
                            <p><strong>Contact : </strong></p>
                            <p>{{ $user->phone_number }}</p>
                        </div>
                    </div>

                </div>
                <div class="dashBtn">
                    <a href="{{ route('user.editProfile', $user->id) }}" class="btn btn-primary d-block m-auto">
                        Edit Profile
                    </a>
                    {{-- <button class="button">
                        Edit Profile
                    </button> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
