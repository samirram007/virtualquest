<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {

            font-family: 'Roboto', sans-serif;
        }

        .fade-left {
            animation: fade 1s ease-in-out;

        }

        .fade {
            animation: fade 2s ease-in-out;
        }

        .max-height {
            height: calc(100vh - 100px);
            overflow-y: hidden;
        }

        .bg-orange {
            background-color: #f8f5f2;
        }


        .slider-one {
            /* background: url(images/slider/1.jpg); */
            background-size: cover;

            background-image: url("images/slider/1.jpg");
        }

        .slider-two {
            /* background: url(images/slider/2.jpg); */
            background-size: cover;
            background-repeat: no-repeat, repeat;
            background-image: url("images/slider/2.jpg"), url("images/slider/1.jpg");
            background-blend-mode: normal, darken;
        }

        .slider-three {
            /* background-image: url(images/slider/3.jpg); */
            background-size: cover;
            background-repeat: no-repeat, repeat;
            background-image: url("images/slider/3.jpg"), url("images/slider/2.jpg");



        }

        @keyframes change-background {
            0% {
                background-blend-mode: normal, lighten;
            }

            50% {
                background-image: url("images/slider/3.jpg"), url("images/slider/2.jpg");
                background-blend-mode: normal, darken;
            }

            100% {
                background-blend-mode: normal, lighten;
            }
        }

        .slider-four {
            background: url(images/slider/4.jpg);
            background-size: cover;
        }

        .slider-five {
            background: url(images/slider/5.jpg);
            background-size: cover;
        }

        .slider-six {
            background: url(images/slider/6.jpg);
            background-size: cover;
        }

        .slider-seven {
            background: url(images/slider/7.jpg);
            background-size: cover;
        }

        .slider-eight {
            background: url(images/slider/8.jpg);
            background-size: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.952);
            opacity: .6;
            z-index: 3;
            transition: all .3s linear;
            transition-delay: 1s;
            transform: translateZ(0);
        }


        .owl-item.active .overlay {
            transform: translateX(0);
            display: none;

            opacity: 0.1;

        }

        .left-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 25%;
            height: 10%;
            border-top: 1px solid #fff;
            border-left: 1px solid #fff;
            margin: 30px 20px;
            transition: all 0.5s ease-in-out;
            animation: border-move 11s ease-in-out infinite;
            animation-delay: 2s;
        }

        .left-top:hover {
            width: 50%;
            height: 8%;

        }

        .right-bottom {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 25%;
            height: 10%;
            border-bottom: 1px solid #fff;
            border-right: 1px solid #fff;
            margin: 30px 20px;
            transition: all 0.5s ease-in-out;
            animation: border-move 12s linear infinite;
            animation-delay: 6s;
        }

        .right-bottom:hover {
            width: 50%;
            height: 8%;
        }

        .left-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 25%;
            height: 10%;
            border-bottom: 1px solid #fff;
            border-left: 1px solid #fff;
            margin: 30px 20px;
            transition: all 0.5s ease-in-out;
            animation: border-move 15s ease-in-out infinite;
            animation-delay: 4s;

        }

        .left-top:hover {
            width: 50%;
            height: 8%;
        }

        .right-top {
            position: absolute;
            top: 0;
            right: 0;
            width: 25%;
            height: 10%;
            border-top: 1px solid #fff;
            border-right: 1px solid #fff;
            margin: 30px 20px;
            transition: all 0.5s ease-in-out;
            cursor: pointer;
            animation: border-move 10s ease-in-out infinite;
            animation-delay: 3s;
        }

        .right-top:hover {
            width: 50%;
            height: 10%;
        }

        @keyframes border-move {
            0% {
                width: 25%;
                height: 10%;
            }

            50% {
                width: 50%;
                height: 8%;
            }

            100% {
                width: 25%;
                height: 10%;
            }
        }

        .border-blue {
            border-left: 5px solid #0dd5f8;
            padding-left: 10px;
            cursor: pointer;
            padding-bottom: 10px;
            background: linear-gradient(90deg, #0dd5f800, #0dd5f800);
            transition: all 0.5s ease-in-out;
            text-shadow: 0 0 15px #0dd5f8;
        }

        .border-blue:hover {
            background: linear-gradient(90deg, #0dd5f8, #0dd5f800);
            color: rgb(5, 45, 105)
        }

        .border-orange {
            border-left: 5px solid #f58923;
            padding-left: 10px;
            transform: all 1s ease-in-out;
            cursor: pointer;
            padding-bottom: 10px;
            background: transparent;
        }

        .border-orange:hover {
            background: linear-gradient(90deg, #f58923, #0dd5f800);
            color: rgb(88, 32, 6)
        }

        .border-green {
            border-left: 5px solid #0df853;
            padding-left: 10px;
            cursor: pointer;
            padding-bottom: 10px;
            background: transparent;
            transition: all 1s ease-in-out;
        }

        .border-green:hover {
            background: linear-gradient(90deg, #0df853, #0dd5f800);
            color: #064418
        }

        .border-red {
            border-left: 5px solid #f52358;
            padding-left: 10px;
            cursor: pointer;
            padding-bottom: 10px;
            background: transparent;
            transition: all 1s ease-in-out;
        }

        .border-red:hover {
            background: linear-gradient(90deg, #f52358, #0dd5f800);
            color: rgb(73, 4, 19)
        }

        .border-yellow {
            border-left: 5px solid #f5f523;
            padding-left: 10px;
            cursor: pointer;
            padding-bottom: 10px;
            background: transparent;
            transition: all 1s ease-in-out;
        }

        .border-yellow:hover {
            background: linear-gradient(90deg, #f5f523, #0dd5f800);
            color: rgb(37, 21, 10)
        }

        .border-violet {
            border-left: 5px solid #c423f5;
            padding-left: 10px;
            cursor: pointer;
            padding-bottom: 10px;
            background: transparent;
            transition: all 1s ease-in-out;
        }

        .border-violet:hover {
            background: linear-gradient(90deg, #c423f5, #0dd5f800);
        }

        .tag {
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            font-size: 1.2rem;
            color: #fff;

            bottom: 10;
            left: 0;
            width: 98%;
            height: 100%;
            background: rgba(0, 0, 0, 0.952);
            opacity: .6;
            z-index: 3;
            transition: all .3s ease-out;
            transition-delay: 0.1s;
            transform: translateZ(0);
            padding: 10px;
            margin: 2rem 1% 0 1%;
            border-radius: 0.3rem;
            box-sizing: border-box;
            border: 2px solid #4f5152a2;
            cursor: pointer;
            height: 10rem;

        }

        .tag:hover {
            border: 2px solid #8a9192cc;
            background: rgb(75, 71, 71);
        }

        .owl-item.active .tag {
            bottom: 5;
        }

        .tag-head {
            position: relative;
            margin-top: -5rem;
            top: 5;
            left: 5;
            color: #fff;
            margin-bottom: 10px;
        }

        .btn-panel {
            position: relative;
            text-align: center;

        }

        .btn-vq {
            position: relative;
            margin: 2rem auto;
            color: rgb(201, 196, 196);
            text-align: center;
            border: 1px solid #fff;
            font-size: 1.2rem;
            padding: 0.5rem 2rem;
            display: inline-block;
            align-self: center;
            background: rgba(255, 255, 255, 0.171);
            cursor: pointer;
            transition: all 0.5s ease-in-out;
            border-radius: 1.5rem;

        }

        .btn-vq:hover {
            background: rgba(255, 255, 255, 0.432);
            color: rgb(255, 255, 255);
            border: 1px solid rgb(155, 150, 150);
        }

        .circle-left {
            position: relative;
            top: -30px;
            left: -4px;
            opacity: 0;
            transform: translateY(0px);
            animation: drop 2s ease-in-out;
            animation-delay: 0.2s;
            animation-fill-mode: forwards;
            animation-iteration-count: 1;
        }

        @keyframes drop {
            0% {
                opacity: 1;
                display: block;
                transform: translateY(0px);
            }

            5%,
            15%,
            25% {
                transform: translateX(50px);
            }

            10%,
            20%,
            30% {
                transform: translateX(-10px);
            }

            35% {
                transform: translateX(0px);
            }

            70% {
                opacity: 0.8;
            }

            80% {
                opacity: 0.4;
            }

            90% {
                opacity: 0.2;
            }

            100% {
                opacity: 0;
                transform: translateY(200px);
            }
        }

        footer {
            color: #fff;
            background-color: #171a16;
            padding: 2px 10px;
            text-align: center;
            font-size: 0.9rem;



            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            box-shadow: 1px -1px 6px 7px #dd93f31e;
            z-index: 1001;
            border-top: 2px solid #aa2adf;
            bottom: 0;
            position: absolute;
            width: 100%;
        }

        footer .nav-pills .nav-link.active,
        footer .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #dfe7dc2d;
        }
    </style>
</head>

<body class="bg-dark">
    <div id="particles-js" style="position: absolute;"></div>
    <div id="app ">
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm navbar-custom d-none">
            <div class="container">

                <button class="navbar-toggler d-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse1 navbar-collapse d-none" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto d-none">
                        <!-- Authentication Links -->
                        @php
                            $prefix = Request::route()->getPrefix();
                            $route = Route::current()->getName();
                            $guard='';
                            if (str_contains($prefix, 'admin')) {
                                $guard = 'admin';
                            }
                        @endphp

                        @guest
                            @if (Route::has('login'))
                                @if ($guard == 'admin')
                                    <li class="nav-item ">
                                        <a class="nav-link text-light" href="{{ route('login') }}">
                                            <span class="iconify" data-icon="bx:user-pin" style="color: white;"
                                                data-width="35" data-height="35"></span>
                                            {{ __('User Login') }}</a>
                                    </li>
                                @else
                                    <li class="nav-item ">
                                        <a class="nav-link text-light" href="{{ route('admin.login.create') }}">
                                            <span class="iconify" data-icon="eos-icons:admin-outlined" style="color: white;"
                                                data-width="35" data-height="35"></span>
                                            {{ __('Admin Login') }}</a>
                                    </li>
                                @endif
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item d-none">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @include ('partials.messages')

        <main class="py-4">
            @yield('content')
            <ul class="navbar-nav ms-auto mx-auto text-center ">
                <!-- Authentication Links -->
                @php
                    $prefix = Request::route()->getPrefix();
                    $route = Route::current()->getName();
                    $guard='';
                    if (str_contains($prefix, 'admin')) {
                        $guard = 'admin';
                    }
                @endphp

                @guest
                    @if (Route::has('login'))
                        @if ($guard == 'admin')
                            {{-- <li class="nav-item ">
                                <a class="nav-link text-light" href="{{ route('login') }}">
                                    {{ __(' switch to : ') }}
                                    <span class="iconify" data-icon="bx:user-pin" style="color: white;" data-width="35"
                                        data-height="35"></span>
                                    {{ __('User Login') }}</a>
                            </li> --}}
                        @else
                            {{-- <li class="nav-item ">

                                <a class="nav-link text-light" href="{{ route('admin.login.create') }}">
                                    {{ __(' switch to : ') }}
                                    <span class="iconify" data-icon="eos-icons:admin-outlined" style="color: white;"
                                        data-width="35" data-height="35"></span>
                                    {{ __('Admin Login') }}</a>
                            </li> --}}
                        @endif
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item d-none">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </main>
    </div>
    <script>
        $(document).ready(function() {
            $('.navbar-toggler').click(function() {
                $('.collapse1').toggleClass('d-none');
                $('.d-none').toggleClass('d-block');
            });
        });
    </script>
      <script src="{{ asset('images/slider/particles/particles.js') }}"></script>
      <script src="{{ asset('images/slider/particles/demo/js/app.js') }}"></script>

      <!-- stats.js -->
      <script src="{{ asset('images/slider/particles/demo/js/lib/stats.js') }}"></script>

      <script src="{{ asset('/sw.js') }}"></script>
      <script>
          if (!navigator.serviceWorker.controller) {
              navigator.serviceWorker.register("/sw.js").then(function (reg) {
                  console.log("Service worker has been registered for scope: " + reg.scope);
              });
          }
      </script>
</body>

</html>
