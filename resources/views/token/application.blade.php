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
                        <h4 class="m-0 text-info py-2">{{ __('Token Application') }}</h4>

                    </div><!-- /.col -->
                    <div class="col-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}" class="text-active">Home</a></li>
                            <li class="breadcrumb-item active"> Token Application</li>
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
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0 text-light"> {{$title_pps}}</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            Investment
                                            {{-- info icon --}}
                                            <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                                <i class="fas fa-info-circle text-light"></i>
                                            </a>

                                        </div>
                                        <div class="col-4 text-right">
                                            <span>{{ __('$') . $self_insvestment }}</span>
                                        </div>
                                    </div>

                                    {{-- <div
                                        class="row align-items-center mb-2 d-flex border-top border-light font-weight-bold">
                                        <div class="col-8">
                                            Total
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>{{ __('$') . $total }}</span>
                                        </div>
                                    </div> --}}
                                    <div class="row align-items-center mb-2 d-flex   ">
                                        <div class="col-8">
                                            Pending Request
                                            {{-- info icon --}}
                                            <a href="#" data-toggle="modal" data-target="#withdrawnModal">
                                                <i class="fas fa-info-circle text-light"></i>
                                            </a>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span> {{ __('$') . $pps_token_application_pending }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex  ">
                                        <div class="col-8">
                                            Approved Request
                                        </div>
                                        <div class="col-4 text-right">
                                            <span> {{ __('$') . $pps_token_application_approved }}</span>
                                        </div>
                                    </div>
                                    @if ($pps_balance > 0)
                                        <div class="row align-items-center mb-2 d-flex  border-top border-light ">
                                            <div class="col-8">
                                                Balance
                                            </div>
                                            <div class="col-4 text-right">
                                                <span> {{ __('$') . $pps_balance }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    @php
                                        $is_disabled = $pps_total_pending > 0 ? 'disabled' : '';
                                    @endphp
                                    <div id="request_panel  "
                                        class="d-flex sr-only row align-items-center py-2 mb-2 rounded  border border-light font-weight-bold "
                                        data-aos="fade-down">

                                        @if ($pps_balance > 0)
                                            <input type="hidden" id="pps_amount" name="pps_amount" value="{{ $pps_balance }}">
                                            <div class="col-md-12 text-left">
                                                <a href="javascript:" class="btn btn-primary {{ $is_disabled }}"
                                                    onclick="token_request('pps');">Request</a>
                                            </div>
                                        @else
                                            <div>Please try again after investing</div>
                                        @endif
                                    </div>
                                    <div id="message" class="alert text-danger"></div>



                                </div>
                            </div>
                        </div>



                        <div class="col-xl-6 col-lg-6">
                            <div class="card l-bg-blue">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0 text-light"> {{$title_mps}}</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            Investment
                                            {{-- info icon --}}
                                            <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                                <i class="fas fa-info-circle text-light"></i>
                                            </a>

                                        </div>
                                        <div class="col-4 text-right">
                                            <span>{{ __('$') . $mps_insvestment }}</span>
                                        </div>
                                    </div>

                                    {{-- <div
                                        class="row align-items-center mb-2 d-flex border-top border-light font-weight-bold">
                                        <div class="col-8">
                                            Total
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>{{ __('$') . $total }}</span>
                                        </div>
                                    </div> --}}
                                    <div class="row align-items-center mb-2 d-flex   ">
                                        <div class="col-8">
                                            Pending Request
                                            {{-- info icon --}}
                                            <a href="#" data-toggle="modal" data-target="#withdrawnModal">
                                                <i class="fas fa-info-circle text-light"></i>
                                            </a>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span> {{ __('$') . $mps_token_application_pending }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex  ">
                                        <div class="col-8">
                                            Approved Request
                                        </div>
                                        <div class="col-4 text-right">
                                            <span> {{ __('$') . $mps_token_application_approved }}</span>
                                        </div>
                                    </div>
                                    @if ($mps_balance > 0)
                                        <div class="row align-items-center mb-2 d-flex  border-top border-light ">
                                            <div class="col-8">
                                                Balance
                                            </div>
                                            <div class="col-4 text-right">
                                                <span> {{ __('$') . $mps_balance }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    @php
                                        $is_disabled = $mps_total_pending > 0 ? 'disabled' : '';
                                    @endphp
                                    <div id="request_panel"
                                        class="d-flex row align-items-center py-2 mb-2 rounded  border border-light font-weight-bold "
                                        data-aos="fade-down">

                                        @if ($mps_balance > 0)
                                            <input type="hidden" id="mps_amount" name="pms_amount" value="{{ $mps_balance }}">
                                            <div class="col-md-12 text-left">
                                                <a href="javascript:" class="btn btn-primary {{ $is_disabled }}"
                                                    onclick="token_request('mps');">Request</a>
                                            </div>
                                        @else
                                            <div>Please try again after investing</div>
                                        @endif
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
        // function show_request_panel() {
        //     if ($('#request_panel').hasClass('d-none')) {
        //         $("#request_panel").removeClass('d-none');
        //         $("#request_panel").addClass('d-flex');
        //     } else {

        //         $("#request_panel").addClass('d-none');
        //         $("#request_panel").removeClass('d-flex');
        //     }

        // }

        function token_request(token_type) {
            var amount =0;
            if(token_type == 'pps'){
                amount = $('#pps_amount').val();
            }else if(token_type == 'mps'){
                amount = $('#mps_amount').val();
            }
            if (amount == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Enter Amount',
                });
                return false;
            }

            console.log(amount);
            Swal.fire({
                title: 'Token Request Confirmation',
                text: "Please press confirm button to confirm your request",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('token_application.store') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "amount": amount,
                            "token_type": token_type,

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
