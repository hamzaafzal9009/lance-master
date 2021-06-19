<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio</title>
    <link rel="stylesheet" href="{{ asset('assets/front/css/sidenav.css') }}">
    <script src="{{ asset('assets/front/js/main.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&family=Open+Sans:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/front/css/creator_portal.css') }}">

    <script src="https://kit.fontawesome.com/74d240b4ae.js" crossorigin="anonymous"></script>
    <style>
        .wrapper {
            margin-top: 80px !important;
        }

    </style>

</head>

<body>

    <header>
        <nav class="navbar">
            <ul class="left-icons">
                <li id="navbtn">
                    <i class="fas fa-bars"></i>
                </li>

                <li id="logo">
                    <a href="{{ route('user.profile', auth()->user()) }}">
                        <span>VID BITE</span>
                    </a>
                </li>
            </ul>
            <!--
            <div class="search">
                <input type="text" placeholder="Search">
                <span class="searchbtn">
                    <i class="fas fa-search"></i>
                </span>
            </div> -->

            <ul class="right-icons">
                <li class="search-icon">
                    <i class="fas fa-search"></i>
                </li>

                <li class="create">
                    <a href="video.php">
                        <svg viewBox="0 0 28 28" preserveAspectRatio="xMidYMid meet" focusable="false"
                            class="style-scope yt-icon" style="display: block; width: 100%; height: 100%;">
                            <g class="style-scope yt-icon">
                                <path
                                    d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4zM14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2z"
                                    class="style-scope yt-icon"></path>
                            </g>
                        </svg>
                    </a>
                </li>

                <li class="bell">
                    <i class="fas fa-bell"></i>
                </li>

                <li class="bell">
                    <a href="" data-toggle="modal" data-target="#logout"><i class="fas fa-power-off"></i></a>

                </li>

                <!-- <li class="profile">
                    <img src="./assets/images/profile.jpeg" alt="">
                </li> -->
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="sidebar">
            <ul class="left-icons">
                <li id="navbtn_mobile">
                    <i class="fas fa-bars"></i>
                </li>

                <li id="logo">
                    <span>LOGO</span>
                </li>
            </ul>

            <ul id="sidebar-content">
                <li class="active trigger">
                    <a href="{{ route('user.profile', auth()->user()) }}">
                        <i class="fas fa-home"></i>
                        <span style="color: #fff;">Home</span>
                    </a>

                </li>

                <li class="trigger">
                    <i class="fas fa-satellite-dish"></i>
                    <span>Stream Manager</span>
                </li>
                <li class="trigger">
                    <a href="{{ route('user.studio') }}">
                        <i class="fas fa-video"></i>
                        <span>Studio</span>
                    </a>

                </li>
                <li class="trigger">
                    <i class="fas fa-signal"></i>
                    <span>Insights</span>
                </li>

                <li class="trigger">
                    <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false"
                        class="style-scope yt-icon" style="display: block; width: 100%; height: 100%;color: #fff;">
                        <g class="style-scope yt-icon">
                            <path
                                d="M18.7 8.7H5.3V7h13.4v1.7zm-1.7-5H7v1.6h10V3.7zm3.3 8.3v6.7c0 1-.7 1.6-1.6 1.6H5.3c-1 0-1.6-.7-1.6-1.6V12c0-1 .7-1.7 1.6-1.7h13.4c1 0 1.6.8 1.6 1.7zm-5 3.3l-5-2.7V18l5-2.7z"
                                class="style-scope yt-icon"></path>
                        </g>
                    </svg>
                    <span>
                        Community
                    </span>
                </li>

                <li class="trigger">
                    <i class="fas fa-fire"></i>
                    <span>Content</span>
                </li>

                <li class="trigger">
                    <i class="fas fa-cog"></i>
                    <span>Preference</span>
                </li>

                <li class="trigger">
                    <svg viewBox="0 0 28 28" preserveAspectRatio="xMidYMid meet" focusable="false"
                        class="style-scope yt-icon" style="display: block; width: 100%; height: 100%;">
                        <g class="style-scope yt-icon">
                            <path
                                d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4zM14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2z"
                                class="style-scope yt-icon"></path>
                        </g>
                    </svg>
                    <span>Streaming Tools</span>
                </li>

                <li class="trigger">
                    <i class="fas fa-puzzle-piece"></i>
                    <span>Extensions</span>
                </li>
            </ul>
        </div>
        <div class="container">
            <div class="wrapper">
                @yield('content')
            </div>

        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
</body>

</html>
