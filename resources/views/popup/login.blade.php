<div class="loginPopup">
    <div class="loginFormPopup bg-vq pop" id="loginPopupForm" style=" display:{{ session()->get('login')=="1" ? 'block':'none'}}">
        <div  style="padding:5px;position:absolute; right:0; top:0; margin:1px; " >
            <button type="button" style="border:1px solid #fff; border-radius:50%;" class="btn btn-dark  " onclick="closeLoginForm()">X</button>
        </div>
        <div class=" login-popup-header mt-2">
            <div>Hello User</div>
            Enter your credentials to login
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="formContainer">
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
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary w-100 ">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="col-6">
                            {{-- <a class="btn btn-primary w-100 " href="javascript:" onclick="openRegisterForm();"> --}}
                            <a class="btn btn-primary w-100 " href="javascript:" onclick="maintain();">
                                {{__('Register')}}
                                {{-- {{ __('Don\'t have a passcode, please register') }} --}}
                            </a>
                        </div>


                </div>
                <hr>
                <div class="row" id="maintain"></div>
                <div class="row mt-3">
                    <a class="nav-link text-gray" href="javascript:" onclick="openAdminLoginForm();">
                        {{ __(' switch to : ') }}
                        <span class="iconify" data-icon="eos-icons:admin-outlined" style="color: rgb(197, 132, 47);"
                            data-width="35" data-height="35"></span>
                        {{ __('Admin Login') }}</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function maintain(){
            document.getElementById('maintain').innerHTML = '<div class="alert alert-danger" role="alert">This feature is under maintenance</div>';
        }
        // loginForm submit
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == 'success') {
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                },
                error: function(data) {
                    alert(data.message);
                }
            });
        });
    </script>
  </div>
