
@extends('layouts.app')

@section('content')
<div class="container">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register_through_link') }}">
                        @csrf
                        <div class="row mb-3 ">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email ') }}</label>

                            <div class="col-md-6 my-auto"> {{ $email}}
                            </div>

                            </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ $name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="parent_code" class="col-md-4 col-form-label text-md-end">{{ __('Sponsor Code') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" name="parent_id" id="parent_id" value={{  $parent_user->id  }}>
                                <div class="input-group">


                                <input id="parent_code" type="text" class="form-control @error('parent_code') is-invalid @enderror"
                                 name="parent_code" value="{{ $parent_user->code .' - '.$parent_user->name }}" maxlength="10" size="10" required  autocomplete="parent_code" >
                                 <div class="input-group-btn">
                                <a href="javascript:" onClick="get_parent();" class="btn btn-info">Confirm</a>
                                </div>
                                @error('parent_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-none">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-none">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Passcode') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                value="{{ $code}}"
                                 class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-none">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" value="{{ $code}}"
                                class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0 mt-3 ">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="submit btn btn-primary ">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function get_parent(){
            var parent_code = $('#parent_code').val();
            if(parent_code==''){
                alert('Please enter sponsor code');
                return false;
            }
            $.ajax({
                url: '{{ route('get_parent') }}',
                type: 'POST',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'parent_code': parent_code
                },
                success: function(response) {

                    if(response.status == 'success'){
                        //console.log(response.data);
                        $('#parent_id').val(response.data.id);
                        $('#parent_code').val(response.data.code+ ' - ' + response.data.name);
                        $('.submit').removeClass('disabled');
                    }
                    else{
                        alert(response.message);
                    }
                }
            });
        }
    </script>
</div>

@endsection




