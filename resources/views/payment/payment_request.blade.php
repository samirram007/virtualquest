@extends('layouts.main')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @include('payment.withdrawn_modal')
    @include('payment.pps_level')
    @include('payment.pps')
    @include('payment.referral_modal')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-0 text-info py-2">{{ __('Withdrawal') }}</h4>

                    </div><!-- /.col -->
                    <div class="col-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}" class="text-active">Home</a></li>
                            <li class="breadcrumb-item active"> Withdrawal</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row justify-content-center px-3">
                <div class="col-md-12 ">
                    <div class="row ">
                        <div class="col-xl-6 col-lg-6">
                            <div class="card l-bg-blue">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                                    <div class="mb-2">
                                        <h6 class="card-title mb-0 text-light"> PPS Wallet</h6>
                                    </div>
                                    <div class="pl-4">
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                Referral Level Distribution
                                                {{-- info icon --}}
                                                <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                                    <i class="fas fa-info-circle text-light"></i>
                                                </a>

                                            </div>
                                            <div class="col-4 text-right">
                                                <span>{{ __('$') . substr(number_format($referral_benefit, 4, '.', ''), 0, -2) }}</span>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                Pool Profit Share
                                                {{-- info icon --}}
                                                <a href="#" data-toggle="modal" data-target="#poolProfitModal">
                                                    <i class="fas fa-info-circle text-light"></i>
                                                </a>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>{{ __('$') . substr(number_format($pps_staking, 4, '.', ''), 0, -2) }}</span>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                PPS Level
                                                {{-- info icon --}}
                                                <a href="#" data-toggle="modal" data-target="#ppsLevelModal">
                                                    <i class="fas fa-info-circle text-light"></i>
                                                </a>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>{{ __('$') . substr(number_format($pps_level, 4, '.', ''), 0, -2) }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mb-2">
                                        <h6 class="card-title mb-0 text-light"> PPS NEXT Wallet</h6>
                                    </div>
                                    <div class="pl-4">
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                Referral Level Distribution (PPS NEXT)
                                                {{-- info icon --}}
                                                <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                                    <i class="fas fa-info-circle text-light"></i>
                                                </a>

                                            </div>
                                            <div class="col-4 text-right">
                                                <span>{{ __('$') . substr(number_format($ppsx_referral_benefit, 4, '.', ''), 0, -2) }}</span>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                Pool Profit Share (PPS NEXT)
                                                {{-- info icon --}}
                                                <a href="#" data-toggle="modal" data-target="#poolProfitModal">
                                                    <i class="fas fa-info-circle text-light"></i>
                                                </a>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>{{ __('$') . substr(number_format($ppsx_staking, 4, '.', ''), 0, -2) }}</span>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                PPS Level (PPS NEXT)
                                                {{-- info icon --}}
                                                <a href="#" data-toggle="modal" data-target="#ppsLevelModal">
                                                    <i class="fas fa-info-circle text-light"></i>
                                                </a>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>{{ __('$') . substr(number_format($ppsx_level, 4, '.', ''), 0, -2) }}</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="my-2">
                                        <h6 class="card-title mb-0 text-light"> MPS Wallet</h6>
                                    </div>
                                    <div class="pl-4">
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                Referral Distribution(MPS)
                                                {{-- info icon --}}
                                                <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                                    <i class="fas fa-info-circle text-light"></i>
                                                </a>

                                            </div>
                                            <div class="col-4 text-right">
                                                <span>{{ __('$') . substr(number_format($mps_referral_benefit, 4, '.', ''), 0, -2) }}</span>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                Monthly Profit Share
                                                {{-- info icon --}}
                                                <a href="#" data-toggle="modal" data-target="#poolProfitModal">
                                                    <i class="fas fa-info-circle text-light"></i>
                                                </a>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>{{ __('$') . substr(number_format($mps_staking, 4, '.', ''), 0, -2) }}</span>
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-2 d-flex">
                                            <div class="col-8">
                                                MPS Level
                                                {{-- info icon --}}
                                                <a href="#" data-toggle="modal" data-target="#ppsLevelModal">
                                                    <i class="fas fa-info-circle text-light"></i>
                                                </a>
                                            </div>
                                            <div class="col-4 text-right">
                                                <span>{{ __('$') . substr(number_format($mps_level, 4, '.', ''), 0, -2) }}</span>
                                            </div>
                                        </div>

                                    </div>

                                    <div
                                        class="row align-items-center mb-2 d-flex border-top border-light font-weight-bold">
                                        <div class="col-8">
                                            Total
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>{{ __('$') . substr(number_format($total, 4, '.', ''), 0, -2) }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex   ">
                                        <div class="col-8">
                                            Withdrawn
                                            {{-- info icon --}}
                                            <a href="#" data-toggle="modal" data-target="#withdrawnModal">
                                                <i class="fas fa-info-circle text-light"></i>
                                            </a>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span> {{ __('- $') . substr(number_format($total_paid, 4, '.', ''), 0, -2) }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex  ">
                                        <div class="col-8">
                                            Balance in wallet
                                        </div>
                                        <div class="col-4 text-right">
                                            <span> {{ __('$') . substr(number_format($balance, 4, '.', ''), 0, -2) }}</span>
                                        </div>
                                    </div>
                                    <div
                                        class="row align-items-center mb-2 d-none border-top border-light font-weight-bold">
                                        <div class="col-8">
                                            <a href="javascript:" onclick="show_request_panel();"> Generate Request</a>
                                        </div>

                                    </div>
                                    @php
                                        $is_disabled = $total_pending > 0 ? 'disabled' : '';
                                    @endphp
                                    <div id="request_panel"
                                        class="d-flex row align-items-center py-2 mb-2 rounded  border border-light font-weight-bold "
                                        data-aos="fade-down">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="number" class="form-control" id="amount" name="amount"
                                                    placeholder="Enter Amount">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="amount">Network</label>
                                                <select class="form-control" name="payment_method" id="payment_method">
                                                    @foreach ($payment_method as $pay_method)
                                                        <option value="{{ $pay_method }}">{{ $pay_method }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="amount">Destination Address</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="Enter Destination Address">
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-left">
                                            <a href="javascript:" class="btn btn-primary {{ $is_disabled }}"
                                                onclick="payment_request();">Request</a>
                                        </div>
                                    </div>
                                    <div id="message" class="alert text-danger"></div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <script>
        function show_request_panel() {
            if ($('#request_panel').hasClass('d-none')) {
                $("#request_panel").removeClass('d-none');
                $("#request_panel").addClass('d-flex');
            } else {

                $("#request_panel").addClass('d-none');
                $("#request_panel").removeClass('d-flex');
            }

        }

        function payment_request() {
            var amount = $('#amount').val();

            if (amount == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Enter Amount',
                });
                return false;
            }
            if (amount > 1000) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Amount Must Not Exceed 1000$',
                });
                return false;
            }
            var address = $('#address').val();
            if (address == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Enter Destination Address',
                });
                return false;
            }
            console.log(amount);
            Swal.fire({
                title: 'Payment Request Confirmation',
                text: "Please press confirm button to confirm your request",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('payment_request.process') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "amount": amount,
                            "address": address,
                            "payment_method": $('#payment_method').val(),

                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                //alert(response.message);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })




                            } else {
                                $('#message').html(response.message);
                                //alert(response.message);
                            }
                        }
                    });

                }

            });

        }
    </script>
@endsection
