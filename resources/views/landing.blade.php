<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    {{-- google font --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- bootstrap --}}
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('owl.carousel/dist/assets/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('owl.carousel/dist/assets/owl.theme.default.min.css') }}" />
    {{-- jquery link --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- owl carusal --}}



    {{-- font awesome --}}
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
    color: rgb(42, 45, 46);
    text-shadow: -1px 1px 0px #abccd3;
    bottom: 10;
    left: 0;
    width: 98%;
    background: rgba(206, 206, 206, 0.952);
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
    min-height: 7rem;
}

        .tag:hover {
            border: 2px solid #8a9192cc;
            background: rgb(236, 233, 233);
            box-shadow: 1px 1px 20px #000000e0;
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
    <style>
        .openBtn {
            display: flex;
            justify-content: left;
        }

        .openButton {
            border: none;
            border-radius: 5px;
            background-color: #1c87c9;
            color: white;
            padding: 14px 20px;
            cursor: pointer;
            position: fixed;
        }

        .loginPopup,.registerPopup {
            position: relative;
            text-align: center;
            width: 100%;
        }

        .notifyPopup {
            position: relative;
            text-align: center;
            width: 200px;
        }

        .formPopup {
            display: none;
            position: fixed;
            right: -8rem;
            bottom: 5rem;
            transform: translate(-50%, 5%);
            /* border: 3px solid #999999; */
            box-shadow: -7px 1px 10px 3px #222;
            z-index: 1002;
            border-radius: 0.5rem;
        }

        .loginFormPopup, .registerFormPopup{
            display: none;
            position: fixed;
            right: 0;
            top: 0;
            transform: translate(-5%, 5%);
            /* border: 3px solid #999999; */
            box-shadow: -7px 1px 10px 3px #222;
            z-index: 1002;
            border-radius: 0.5rem;
        }

        .formContainer {
            max-width: 300px;
            margin: 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 0.5rem;
        }


        .formContainer .cancel {
            background-color: #cc0000;
        }

        .formContainer .btn:hover,
        .openButton:hover {
            opacity: 1;
        }

        .popup-header {
            color: #fff;
            padding: 10px;
            text-align: center;
            min-height: 50px;
        }

        .login-popup-header, .register-popup-header {
            color: #fff;
            padding: 10px 60px;
            text-align: center;
            min-height: 50px;
        }
    </style>
</head>

<body class="bg-dark">
    <div id="particles-js" style="position: absolute;"></div>
    <nav class="navbar navbar-expand-md navbar-light  shadow-sm  " data-aos="fade-in" data-aos-duration="1000"
        data-aos-easing="ease-in-out">


        <div class="container-fluid">


            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between border-0">
                <a class="navbar-brand text-light" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>

            </div>


            {{-- <div class="collapse navbar-collapse d-none" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    {{ __('LOGIN') }}
                    <i class="fas fa-sign-in-alt"></i>
                </ul>

                <!-- Right Side Of Navbar -->

            </div> --}}
            <div class="navbar-menu-wrapper d-flex align-items-right align-self-end justify-content-between border-0">
                <a class="navbar-brand text-light login" href="javascript:" onclick="openLoginForm()">
                    {{ __('LOGIN') }}
                    <i class="fas fa-sign-in-alt"></i>

                </a>

            </div>
        </div>
    </nav>


    <div class="container-fluid p-0">

        <div class="row max-height mx-0 p-0 ">
            <div class="col-md-12 p-0" style="margin:0">
                <div class="owl-carousel   owl-theme owl-loaded owl-drag">
                    <div class="slider-one max-height   text-light p-3 d-flex flex-column justify-content-center">
                        <div class="left-top"> </div>
                        <div class="right-bottom  "> </div>

                        <svg class="circle-left" width="100" height="100">
                            <circle cx="30" cy="30" r="10" stroke="ffffffbb" stroke-width="2"
                                fill="#ffffffaa" />
                        </svg>



                        <div data-aos="fade-in " class="px-4">
                            <h1 class="border-red tag-head"> Begin </h1>
                            <h3 class="tag">Let Us Begin The Quest To Unearth Our Virtual Identity</h3>
                            <div class="btn-panel">
                                <div class="btn-vq" onclick="openRegisterForm();"> Register Now</div>
                            </div>

                        </div>

                        {{-- <div class="overlay"></div> --}}


                    </div>
                    <div class="slider-two max-height   text-light p-3 d-flex flex-column justify-content-center">


                        <div class="right-top"> </div>
                        <div class="left-bottom"> </div>

                        <svg class="circle-left" width="100" height="100">
                            <circle cx="30" cy="30" r="10" stroke="ffffffbb" stroke-width="2"
                                fill="#ffffffaa" />
                        </svg>

                        <div data-aos="fade-in " class="px-4">

                            <h1 class="border-blue tag-head"> Tourism </h1>
                            <h3 class="tag"> Begin Your Journey Around The Globe
                                <div>Be a Wanderlust </div>
                                <a class="btn btn-secondary" href="https://vqholidays.com" target="blank">Connect</a>
                            </h3>
                            <div class="btn-panel">
                                <div class="btn-vq"  onclick="openRegisterForm();"> Register Now</div>
                            </div>
                        </div>

                        {{-- <div class="overlay"></div> --}}


                    </div>

                    <div class="slider-three max-height   text-light p-3 d-flex flex-column justify-content-center">
                        <div class="left-top"> </div>
                        <div class="right-bottom"> </div>
                        <svg class="circle-left" width="100" height="100">
                            <circle cx="30" cy="30" r="10" stroke="ffffffbb" stroke-width="2"
                                fill="#ffffffaa" />
                        </svg>

                        <div data-aos="fade-in " class="px-4">

                            <h1 class="border-yellow tag-head"> Trading </h1>
                            <h3 class="tag"> Teade Sense ...
                                <div> Sensible Trading Secure Earning</div>
                            </h3>
                            <div class="btn-panel">
                                <div class="btn-vq"  onclick="openRegisterForm();"> Register Now</div>
                            </div>
                        </div>
                        {{-- <div class="overlay"></div> --}}
                    </div>
                    <div class="slider-four max-height  text-light p-3 d-flex flex-column justify-content-center">
                        <div class="right-top"> </div>
                        <div class="left-bottom"> </div>
                        <svg class="circle-left" width="100" height="100">
                            <circle cx="30" cy="30" r="10" stroke="ffffffbb" stroke-width="2"
                                fill="#ffffffaa" />
                        </svg>

                        <div data-aos="fade-in " class="px-4">

                            <h1 class="border-green tag-head"> Gaming </h1>
                            <h3 class="tag"> Hone your skills...
                                <div> Connect Compete...</div>
                                <div> Be a Champion...</div>
                            </h3>

                            <div class="btn-panel">
                                <div class="btn-vq"  onclick="openRegisterForm();"> Register Now</div>
                            </div>
                        </div>
                        {{-- <div class="overlay"></div> --}}
                    </div>
                    <div class="slider-five max-height   text-light p-3 d-flex flex-column justify-content-center">
                        <div class="right-top"> </div>
                        <div class="left-bottom"> </div>
                        <svg class="circle-left" width="100" height="100">
                            <circle cx="30" cy="30" r="10" stroke="ffffffbb" stroke-width="2"
                                fill="#ffffffaa" />
                        </svg>

                        <div data-aos="fade-in " class="px-4">

                            <h1 class="border-red tag-head"> E-Commerce </h1>
                            <h3 class="tag"> The World At Your Fingertips
                                <div>It Is Realy Global</div>
                            </h3>
                            <div class="btn-panel">
                                <div class="btn-vq"  onclick="openRegisterForm();"> Register Now</div>
                            </div>

                        </div>
                        {{-- <div class="overlay"></div> --}}
                    </div>
                    <div class="slider-six max-height  text-light p-3 d-flex flex-column justify-content-center">
                        <div class="left-top"> </div>
                        <div class="right-bottom"> </div>
                        <svg class="circle-left" width="100" height="100">
                            <circle cx="30" cy="30" r="10" stroke="ffffffbb" stroke-width="2"
                                fill="#ffffffaa" />
                        </svg>

                        <div data-aos="fade-in " class="px-4">

                            <h1 class="border-green tag-head"> NFT </h1>
                            <h3 class="tag"> Your Next Asset Is In The Digital World</h3>
                            <div class="btn-panel">
                                <div class="btn-vq"  onclick="openRegisterForm();"> Register Now</div>
                            </div>

                        </div>
                        {{-- <div class="overlay"></div> --}}
                    </div>
                    <div class="slider-seven max-height   text-light p-3 d-flex flex-column justify-content-center">
                        <div class="right-top"> </div>
                        <div class="left-bottom"> </div>
                        <svg class="circle-left" width="100" height="100">
                            <circle cx="30" cy="30" r="10" stroke="ffffffbb" stroke-width="2"
                                fill="#ffffffaa" />
                        </svg>

                        <div data-aos="fade-in" class="px-4">

                            <h1 class="border-violet tag-head"> SAAS </h1>
                            <h3 class="tag">
                                Coded To Perfection
                                <div>Will Exceed Your Expectations</div>
                            </h3>
                            <div class="btn-panel">
                                <div class="btn-vq"  onclick="openRegisterForm();"> Register Now</div>
                            </div>

                        </div>
                        {{-- <div class="overlay"></div> --}}
                    </div>
                    <div class="slider-eight max-height   text-light p-3 d-flex flex-column justify-content-center">
                        <div class="left-top"> </div>
                        <div class="right-bottom"> </div>
                        <svg class="circle-left" width="100" height="100">
                            <circle cx="30" cy="30" r="10" stroke="ffffffbb" stroke-width="2"
                                fill="#ffffffaa" />
                        </svg>

                        <div data-aos="fade-in" class="px-4 mt-n4">

                            <h1 class="border-orange tag-head"> Education </h1>
                            <h3 class="tag"> Education replaces emplty mind with positive thoughts and attitude</h3>
                            <div class="btn-panel">
                                <div class="btn-vq"  onclick="openRegisterForm();"> Register Now</div>
                            </div>
                        </div>
                        {{-- <div class="overlay"></div> --}}
                    </div>
                </div>

            </div>

            <div class="col-md-4 p-0 shadow-lg p-3 bg-orange d-none " style="margin:0 -10px; z-index:1001"
                data-aos="slide-down" data-aos-duration="2000">
                <div class="p=0  text-light max-height d-flex flex-column justify-content-center">
                    <div data-aos="fade-in">


                        <div class=""> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                            dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                            mollit anim id est laborum. </div>
                        <a href="{{ route('login') }}" class="btn btn-secondary"> Login</a>

                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('popup.notify')
    @include('popup.login')
    @include('popup.adminlogin')
    @include('popup.register')
    <footer>
        <a href="javascript:" onclick="share();" class="pop-icon"
            style="position:fixed; margin-left:10px ; margin-top:-65px; z-index:1001; width:50px; height:50px;
        left:0;
        background-image:url('{{ asset('images/whatsapp.png') }}'); background-size:cover; background-repeat:no-repeat;
        ">

        </a>
        <a href="javascript:" class="pop-icon" onclick="openNotifyForm()"
            style="position:fixed; margin-right:10px ; margin-top:-65px; z-index:1001; width:50px; height:50px;
        right:0;
        background-image:url('{{ asset('images/notify.png') }}'); background-size:cover; background-repeat:no-repeat;
        ">

        </a>
        <ul class="nav nav-pills flex-row justify-content-between">
            <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="#"><i
                        class="fas fa-home"></i></a>
            </li>

            <li class="nav-item">


            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#" tabindex="-1"><i class="fas fa-bars"></i></a>
            </li>
        </ul>




    </footer>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.5.1/dist/simpleParallax.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <script src="{{ asset('images/slider/particles/particles.js') }}"></script>
    <script src="{{ asset('images/slider/particles/demo/js/app.js') }}"></script>

    <!-- stats.js -->
    <script src="{{ asset('images/slider/particles/demo/js/lib/stats.js') }}"></script>
    <script>
        function openForm() {
            document.getElementById("popupForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("popupForm").style.display = "none";
        }

        function openNotifyForm() {
            closePopup();
            document.getElementById("notifyPopupForm").style.display = "block";
            setLoginSession(3);
        }

        function closeNotifyForm() {
            document.getElementById("notifyPopupForm").style.display = "none";
            setLoginSession(0);
        }

        function openLoginForm() {
            closePopup();

            document.getElementById("loginPopupForm").style.display = "block";
            setLoginSession(1);
        }

        function closeLoginForm() {

            document.getElementById("loginPopupForm").style.display = "none";
            setLoginSession(0);
        }
        function openRegisterForm() {
            closePopup();

            document.getElementById("registerPopupForm").style.display = "block";
            setLoginSession(4);
        }

        function closeRegisterForm() {

            document.getElementById("registerPopupForm").style.display = "none";
            setLoginSession(0);
        }

        function openAdminLoginForm() {
            closePopup();

            document.getElementById("adminLoginPopupForm").style.display = "block";
            setLoginSession(2);
        }

        function closeAdminLoginForm() {
            document.getElementById("adminLoginPopupForm").style.display = "none";
            setLoginSession(0);
        }

        function closePopup() {
            //    .pop close
            var pops = document.getElementsByClassName("pop");
            for (var i = 0; i < pops.length; i++) {
                pops[i].style.display = "none";
            }
            setLoginSession(0);
        }

        function setLoginSession(type) {
            $.ajax({
                url: "{{ route('setLoginSession') }}",
                type: "POST",
                data: {
                    type: type,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                },
            });
        }

        function share_all() {
            var text = "Hello, world!";
            var url = "https://virtualquest.cloud";
            if (navigator.share) {
                navigator.share({
                        title: document.title,
                        text: text,
                        url: url,
                    })
                    .then(() => console.log('Successful share'))
                    .catch((error) => console.log('Error sharing', error));
            } else {
                alert("Share not supported");
            }
        }
    </script>
    <script>
        function share() {

            // Getting user input
            var message = $("input[name=message]").val();
            var copyText = 'https://virtualquest.cloud';
            // Opening URL
            window.open(
                "whatsapp://send?text=" + copyText,

                // This is what makes it
                // open in a new window.
                '_blank'
            );
        }
    </script>

    <script>
        $(document).ready(function() {
            var images = document.querySelectorAll('img');
            new simpleParallax(images, {
                scale: 1.5,
                delay: .6,
                transition: 'cubic-bezier(0,0,0,1)'
            });
            $('.owl-carousel').owlCarousel({
                center: false,
                smartSpeed: 1500,
                autoplay: true,
                loop: true,
                autoplayTimeout: 2500,
                autoplayHoverPause: true,
                margin: 0,
                nav: false,
                dot: false,
                responsiveClass: true,
                responsiveBaseElement: 'body',
                responsive: {
                    0: {
                        center: true,
                        items: 1,
                        nav: true,
                        autoplayTimeout: 4000,
                    },
                    600: {
                        items: 4,
                        nav: true,
                    },
                    1000: {
                        items: 4,
                        nav: true,
                    }
                }

            });


        });

        AOS.init();
    </script>
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
