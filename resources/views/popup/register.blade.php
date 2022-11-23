<div class="registerPopup">
    <div class="registerFormPopup bg-vq pop" id="registerPopupForm"
        style=" display:{{ session()->get('login') == '4' ? 'block' : 'none' }}">
        <div style="padding:5px;position:absolute; right:0; top:0; margin:1px; ">
            <button type="button" style="border:1px solid #fff; border-radius:50%;" class="btn btn-dark  "
                onclick="closeRegisterForm()">X</button>
        </div>
        <div class=" register-popup-header mt-2">
            <div>Registation</div>
            Enter your valid email address
        </div>
        <div class="card-body">

            <form id="registerForm" action="{{ route('send_link.email') }}" class="formContainer">
                @csrf

                <div class="row mb-3">
                    {{-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> --}}

                    <div class="col-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    {{-- spinner --}}

                    <div class="col-12">
<div class="spinner-border text-primary d-none" role="status" id="spinner">
                                <span class="sr-only">Sending...</span>
                            </div>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                             {{ __('Send Registration Link') }}
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script>
        // registerForm submit
        $('#registerForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData(this);
            //spinner
            $('#spinner').show();
             $('#submitBtn').html('Sending...');
             $('#submitBtn').attr('disabled', true);

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    //console.log(data);
                    if (data.status == 'success') {
                        $('#spinner').hide();

                        $("#registerForm").html(data.message);
                        setTimeout(() => {
                            closeRegisterForm();
                        }, 3000);
                        // location.reload();
                    } else {
                        console.log("NOT Success");
                        console.log(data);
                    }
                },
                error: function(data) {
                    console.log("NOT Success outside");
                        console.log(data);
                }
            });
        });
    </script>
</div>
