<nav class="navbar navbar-expand-md bg-dark  shadow-sm   fixed-top  ">
    @php
        $prefix = Request::route()->getPrefix();
        $route = Route::current()->getName();

        $guard = 'user';
        if (str_contains($prefix, 'admin')) {
            $guard = 'admin';
        }
        //$user=Auth::guard()->user();
        // $user = DB::table($guard . 's')
        //     ->where('id', Auth::guard($guard)->user()->id)
        //     ->first();
        date_default_timezone_set('Asia/Bangkok');
        $welcome_string = 'Welcome!';
        $numeric_date = date('G');

        //Start conditionals based on military time
        if ($numeric_date >= 0 && $numeric_date <= 11) {
            $welcome_string = 'Good Morning!';
        } elseif ($numeric_date >= 12 && $numeric_date <= 17) {
            $welcome_string = 'Good Afternoon!';
        } elseif ($numeric_date >= 18 && $numeric_date <= 23) {
            $welcome_string = 'Good Evening!';
        }

    @endphp

    <div class="container-fluid">


        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between border-0">
            <a class="navbar-brand text-light" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler navbar-toggler align-self-center d-none " type="button" data-toggle="minimize">
                <span class="icon-menu text-danger"></span>
            </button>

            <ul class="navbar-nav navbar-nav-right">

                @php
                    $prefix = Request::route()->getPrefix();
                    $route = Route::current()->getName();
                    $guard = 'user';
                    $user = Auth::guard()->user();
                    if (str_contains($prefix, 'admin')) {
                        $guard = 'admin';
                    } else {
                        $self = App\Models\SelfInvestment::where('user_id', $user->id)->get();
                        // dd($self);
                    }

                    // dd($self);

                @endphp
                <li class="nav-item nav-profile dropdown hidden-md">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <em class="mr-2 text-light  d-md-inline-block   d-none  ">
                            {{ $welcome_string }} {{ $user->name }}</em>
                        <img class="rounded-circle"
                            src="{{ !empty($user->image) ? asset('upload/user_images/' . $user->image) : asset('upload/no_image.jpg') }}"
                            alt="User Avatar">

                        {{-- <img src="{{ asset('skydash/images/faces/face1.jpg') }}" alt="profile"/> --}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <div class="dropdown-item"><em class="mr-2">
                                {{ $welcome_string }} {{ $user->name }}</em> </div>
                        <div class="dropdown-item"><em class="mr-2">Code:</em> {{ $user->code }}</div>
                        <div class="dropdown-item"><em class="mr-2">User ID:</em> {{ $user->email }}</div>


                        @if ($guard == 'admin')
                            <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        @else
                            {{-- <div class="d-none dropdown-item "><em class="mr-2">Self:</em>
                                {{ $self != null ? '$' . $self->sum('amount') : 0 }}</div> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        @endif


                    </div>
                    {{-- <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header">
                            <!--img src="https://rems.inspirigenceworks.co.in/asset/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"-->
                            <span class="big-dp bg-info-custom d-block mx-auto mt-4 ">AA</span>
                            <p> {{ $user->name}}</p>
                        </li>
                                                <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left"> <a href="#" class="btn btn-dark btn-flat  ">Chenge Password</a>
                            </div>
                            <div class="pull-right"> <a href="{{ route('logout') }}"  class="btn btn-dark signout-btn">Logout
                                    out</a> </div>
                        </li>
                    </ul> --}}

                </li>

            </ul>
            {{-- <button class="navbar-toggler navbar-toggler-right   align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="icon-menu text-light icon-md"></span>
            </button> --}}
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto d-none">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
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
                            @if ($guard == 'admin')
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                    {{ __('Logout') }}

                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endif

                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
