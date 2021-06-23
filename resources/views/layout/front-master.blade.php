<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&family=Open+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <style>
        .main-container {
            width: 95%;
            margin: auto;
            margin-top: 75px
        }


        .cover {
            width: 100%;
            height: 350px;
            padding-bottom: 20px
        }

        .cover img {
            width: 100%;
            height: 100%;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%
        }

        .nav-link {
            color: #fff;
        }

        .nav-link.active {
            background-color: transparent !important;
            border: none !important;
            color: #fff;
            border-bottom: 2px solid #fff !important;
            margin-bottom: 15px
        }

        .nav-link:hover {
            border: none !important;
            border-bottom: 2px solid #fff !important
        }

        .tab-content {
            background-color: #1b1b1b;
            margin-bottom: 20px
        }

        .video-list {
            width: 100% !important;
            height: 175px !important;
        }

        .show {
            background-color: transparent !important
        }

        .clickable {
            cursor: pointer;
        }

        .video {
            width: 100%;
            min-height: 88vh;
        }

        .video video {
            width: 100%;
            min-height: 100% !important;
        }

    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">

        <a class="navbar-brand logo" href="#">
            VID BITE
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./live.html">Live</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./library.php">Library</a>
                </li>
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <!-- Actual search box -->
                <div class="form-group has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </form>
            <div class="right d-flex">
                <div class="nav_right">
                    <ul>
                        <li class="nr_li dd_main">
                            @isset($user)
                                <a href="JavaScript:void​(0)">
                                    <i class="fas fa-user-plus mr-1"></i>
                                    {{ $user->name }}
                                </a>
                            @endisset

                            <div class="dd_menu">

                                <div class="dd_right">
                                    <ul>
                                        <li class="add_pro">
                                            <a href="{{ route('user.profile', auth()->user()) }}">Profile</a>
                                        </li>
                                        <li class="add_pro">
                                            <a href="studio.php">Studio</a>
                                        </li>
                                        <li><a href="" data-toggle="modal" data-target="#logout">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="account d-flex ml-4 mr-4">
                    <a href="#">
                        <i class="fas fa-video"></i>
                    </a>
                    <a href="./notification.html">
                        <i class="fas fa-bell"></i>
                    </a>
                    <a href="chatpage.php">
                        <i class="fas fa-comment"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="main-container">
        @yield('content')
    </div>

    <script src="https://kit.fontawesome.com/74d240b4ae.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $(".active-tab span").html(activeTab);
                $(".previous-tab span").html(previousTab);
            });
        });

        $(".video-list").click(function() {
            window.location.href = $(this).data('href');
        });

        var dd_main = document.querySelector(".dd_main");

        dd_main.addEventListener("click", function() {
            this.classList.toggle("active");
        })
    </script>
    <script>
        function playVideo(id) {
            $(`#${id}`).click(function() {
                this.paused ? this.play() : this.pause();
            });

        }
    </script>
</body>

</html>
