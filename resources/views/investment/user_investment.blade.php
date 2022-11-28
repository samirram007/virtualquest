@extends('layouts.main')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-vq-light py-2">{{ __('PPS ') }}</h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}" class="text-vq-light">Home</a></li>
                            <li class="breadcrumb-item active"> PPS </li>
                        </ol>
                    </div><!-- /.col -->
                </div>
                <div class="container">


                    <div class="row d-none ">


                        <div class="investment col-12">

                            <form id="investment_form" role="form" onsubmit="event.preventDefault()">
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
                                                            class="validate btn btn-info rounded-0 border border-info"><i
                                                                class="fa fa-check" aria-hidden="true"></i></a>
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
                                                        readonly id="investment_date" value="{{ date('Y-m-d') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input type="number" class="form-control" name="amount" id="amount"
                                                        min="50" value="{{ old('amount') }}" required>
                                                </div>
                                            </div>

                                        </div>

                                        <button class="btn btn-info submit disabled" type="button">Submit</button>
                                        <button class="badge btn-info reset  border-0" type="button">
                                            <span class="iconify" data-icon="fluent:arrow-reset-48-filled"
                                                style="color: rgb(241, 237, 233);" data-width="25"
                                                data-height="25"></span></button>

                                        {{-- <button type="submit" class="submit btn btn-primary disabled">Submit</button> --}}



                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                    <div class="row">
                        <div id="result_panel">
                            <section class="content">
                                <div class="row justify-content-center p-3">
                                    <div class="col-md-12 ">
                                        <div class="row ">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table table-dark">
                                                        <tr>
                                                            <th>Investment ID</th>
                                                            <th>Investment Date</th>
                                                            <th>Code</th>
                                                            <th>Name</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        @foreach ($investment as $data)
                                                            <tr>
                                                                <td>{{ 'INV-' . str_pad($data->id, 5, 0, STR_PAD_LEFT) }}
                                                                </td>
                                                                <td>{{ date('d-M-Y', strtotime($data->investment_date)) }}
                                                                </td>
                                                                <td>{{ $data['user']['code'] }}</td>
                                                                <td>{{ $data['user']['name'] }}</td>
                                                                <td>{{ $data->amount != 0 ? '$' . $data->amount : '' }}
                                                                </td>
                                                                <td id="status{{ $data->id }}">
                                                                    @if($data->status == 1)
                                                                    {!!'<span class="alert text-success">Active</span>'!!}
                                                                 @elseif($data->status == 2)
                                                                 {!!'<span class="alert text-danger">Reject</span>'!!}
                                                                 @else
                                                                 {!! ' <span class=" alert text-danger" >Pending</span>'!!}
                                                                 @endif

                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="4" class="text-right">Total</td>
                                                                <td>${{ $investment->sum('amount') }}</td>
                                                                <td></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        </div>
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
                    url: "{{ route('pps_investment.user_validate') }}",
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
                            // alert(response.message);
                            Swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                            return;
                        }
                    }
                });
            });
            $('.submit').click(function() {
                const link = "{{ route('self_report') }}";
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
                if (amount < 50) {
                    // alert("Amount is greater than total due");
                    Swal.fire({
                        title: 'Error',
                        text: 'Please Enter amount more than 50',
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
                            url: "{{ route('pps_investment.store') }}",
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
                $('#investment_form')[0].reset();
                $('#user_id').val('');
                $('.validate').removeClass('disabled');
                $('.submit').addClass('disabled');
                // $('#result_panel').html('');
            });
        });
    </script>
@endsection
