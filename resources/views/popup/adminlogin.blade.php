<div class="loginPopup">
    <div class="loginFormPopup bg-vq pop" id="adminLoginPopupForm" style=" display:{{ session()->get('login')=="2" ? 'block':'none'}}">
        <div  style="padding:5px;position:absolute; right:0; top:0; margin:1px; " >
            <button type="button" style="border:1px solid #fff; border-radius:50%;" class="btn btn-dark  " onclick="closeAdminLoginForm()">X</button>
        </div>
        <div class=" login-popup-header mt-2">
            <div>Hello Admin</div>
            Enter your credentials to login
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.login.store') }}" class="formContainer">
                @csrf

                <div class="row mb-3">
                    {{-- <label for="email" class="col-md-3 col-form-label text-md-end">{{ __('Email') }}</label> --}}

                    <div class="col-12">
                        <input id="email" type="email" class="form-control
                        @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email"
                        placeholder="Email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- <label for="password" class="col-md-3 col-form-label text-md-end">{{ __('Passcode') }}</label> --}}

                    <div class="col-12">
                        <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password"
                        placeholder="Passcode">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 d-none">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100 ">
                                {{ __('Login') }}
                            </button>
                        </div>
                        {{-- <div class="col-6">
                            <a class="btn btn-primary w-100 " href="{{ route('send_link') }}">
                                {{__('Register')}}
                            </a>
                        </div> --}}


                </div>
                <hr>
                <div class="row mt-3">
                    <a class="nav-link text-gray" href="javascript:" onclick="openLoginForm();">
                        {{ __(' switch to : ') }}
                        <span class="iconify" data-icon="eos-icons:admin-outlined" style="color: rgb(197, 132, 47);"
                            data-width="35" data-height="35"></span>
                        {{ __('User Login') }}</a>
                </div>
            </form>
        </div>
    </div>
  </div>
