@extends('layouts.main')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-0 text-info py-2">{{ $title }}</h4>

                    </div><!-- /.col -->
                    <div class="col-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}" class="text-active">Home</a></li>
                            <li class="breadcrumb-item active"> Wallet</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <section class="content">

            <div class="row justify-content-center px-3">
                <div class="col-md-12 ">
                    <div class="row ">
                        <div class="col-xl-6 col-lg-6 ">
                            <div class="card l-bg-blue">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0 text-light">Main Wallet</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            Referral Level Distribution
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>{{ __('$') . substr(number_format($referral_benefit, 4, '.', ''), 0, -2) }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            Pool Profit Share
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>{{ __('$') . substr(number_format($pps_staking, 4, '.', ''), 0, -2) }}</span>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            PPS Level
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>{{ __('$') . substr(number_format($pps_level, 4, '.', ''), 0, -2) }}</span>
                                        </div>
                                    </div>
                                    <div
                                        class="row align-items-center mb-2 d-flex border-top border-light font-weight-bold  ">
                                        <div class="col-8">
                                            Total
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>{{ __('$') . substr(number_format($total, 4, '.', ''), 0, -2) }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
