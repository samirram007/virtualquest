@extends('layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-md-12 ">
                <div class="row">
                    @include('admin.mps48.mps48_menu')
                </div>
                <div class="row ">


                    <div class="mps col-12">

                        <form id="mps_form" role="form" onsubmit="event.preventDefault()">
                            @csrf
                            <div class="card   l-bg-blue">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>


                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="user_code" class="  ">{{ __('Investor Code') }}</label>
                                            <input type="hidden" name="user_id" id="user_id">
                                            <div class="input-group">


                                                <input id="user_code" type="text"
                                                    class="form-control @error('user_code') is-invalid @enderror"
                                                    name="user_code" value="{{ old('user_code') }}" maxlength="10"
                                                    placeholder="Enter Investor Code" size="10" required
                                                    autocomplete="user_code">
                                                <div class="input-group-btn">
                                                    <a href="javascript:"
                                                        class="validate btn btn-info rounded-0 border border-info"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                </div>
                                                @error('user_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>


                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="investment_date">Investment Date</label>
                                                <input type="date" class="form-control" name="investment_date"
                                                    id="investment_date" value="{{ date('Y-m-d') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="number" class="form-control" name="amount" id="amount" min="50"
                                                    value="{{ old('amount') }}" required>
                                            </div>
                                        </div>

                                    </div>

                                    <button class="btn btn-info submit disabled" type="button">Accept Investment</button>
                                    <button class="badge btn-info reset  border-0" type="button">
                                        <span class="iconify" data-icon="fluent:arrow-reset-48-filled" style="color: rgb(241, 237, 233);" data-width="25" data-height="25"></span></button>

                                    {{-- <button type="submit" class="submit btn btn-primary disabled">Submit</button> --}}



                                </div>
                            </div>
                        </form>
                    </div>


                </div>
                <div class="row">
                    <div id="result_panel">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $('.validate').click(function() {

                var user_code = $('#user_code').val();
                $.ajax({
                    url: "{{ route('admin.mps48.user_validate') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_code: user_code
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#user_id').val(response.data.id);
                            $('#user_code').val(response.data.code + ' - ' + response.data
                            .name);
                            $('.validate').addClass('disabled');
                            $('.submit').removeClass('disabled');
                            $('#result_panel').html(response.view);
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });
            $('.submit').click(function() {
                const link = "{{ route('admin.mps48') }}";
                var user_id = $('#user_id').val();
                var investment_date = $('#investment_date').val();
                var amount = $('#amount').val();
                if (user_id == '') {
                    Swal.fire({
                        title: 'Error',
                        text: 'Please Code',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                    return;
                }
                if (amount == '') {
                    // alert("Amount is greater than total due");
                    Swal.fire({
                        title: 'Error',
                        text: 'Please Enter Amount',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                    return;
                }
                if (amount <50) {
                    // alert("Amount is greater than total due");
                    Swal.fire({
                        title: 'Error',
                        text: 'Please Enter Amount more than or equal to 50',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                    return;
                }
                Swal.fire({
                    title: 'Please press confirm button to confirm payment',
                    text: "Please press confirm button to confirm payment",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.mps48.store') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                user_id: user_id,
                                investment_date: investment_date,
                                amount: amount
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.status == 'success') {
                                    // alert(response.message);
                                    // $('#investment_form')[0].reset();
                                    // $('.validate').removeClass('disabled');
                                    // $('.submit').addClass('disabled');
                                    Swal.fire({
                                        title: 'Success',
                                        text: 'Investment Added Successfully',
                                        icon: 'success'
                                    });
                                    window.location.href = link;
                                } else {
                                    // alert();
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Something went wrong',
                                        icon: 'error',
                                        confirmButtonText: 'Ok'
                                    });
                                }
                            }
                        });
                    }
                });
            });
            $('.reset').click(function() {
                $('#mps_form')[0].reset();
                $('#user_id').val('');
                $('.validate').removeClass('disabled');
                $('.submit').addClass('disabled');
                $('$result_panel').html('');
            });
        });
    </script>

@endsection
