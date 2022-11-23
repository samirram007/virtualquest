@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-md-12 ">
                <div class="row ">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-cherry">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0"></h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            My Team
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="d-none">12.5% <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="progress mt-1  d-none" data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-cherry">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0"></h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                            Direct Downline
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="d-none">9.23% <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="progress mt-1 d-none " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-green" role="progressbar" data-width="25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-green-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0"></h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 na">
                                            Staring Wallet
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="d-none">10% <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="progress mt-1 d-none " data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <a href="{{ route('admin.investment') }}">
                            <div class="card l-bg-blue-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0"> </h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0 ">
                                                Investment Status
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span class="d-none">2.5% <i class="fa fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                    <div class="progress mt-1 d-none" data-height="8" style="height: 8px;">
                                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-orange-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0"> </h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 na">
                                            Direct Benefit
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="d-none">2.5% <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="progress mt-1 d-none" data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-green-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0"> </h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 na">
                                            PPS Wallet
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="d-none">2.5% <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="progress mt-1 d-none" data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card l-bg-orange-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0"> </h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0 na">
                                            Referral Benefit
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="d-none">2.5% <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="progress mt-1 d-none" data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card l-bg-blue">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"> <i class="fas fa-info-circle text-light"></i></div>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0 text-light border-bottom border-light pb-2"> Overall Summery</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        Users
                                        <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                            <i class="fas fa-info-circle text-light"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>{{  $user_count }}</span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        Approved Investment
                                        <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                            <i class="fas fa-info-circle text-light"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>{{  __('$') . substr(number_format($total_investment,4 ,'.',''),0,-2) }}</span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        Pending Investment
                                        <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                            <i class="fas fa-info-circle text-light"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>{{  __('$') . substr(number_format($pending_investment,4 ,'.',''),0,-2) }}</span>
                                    </div>
                                </div>

                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        Generated Commission
                                        <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                            <i class="fas fa-info-circle text-light"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>{{  __('$') . substr(number_format($total_earning,4 ,'.',''),0,-2) }}</span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        Paid Commission
                                        <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                            <i class="fas fa-info-circle text-light"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>{{  __('$') . substr(number_format($paid_payment_request,4 ,'.',''),0,-2) }}</span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        Pending Payment
                                        <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                            <i class="fas fa-info-circle text-light"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>{{  __('$') . substr(number_format($pending_payment_request,4 ,'.',''),0,-2) }}</span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        Unprocessed Request
                                        <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                            <i class="fas fa-info-circle text-light"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>{{  __('$') . substr(number_format($due_payment,4 ,'.',''),0,-2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="card l-bg-blue">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"> <i class="fas fa-info-circle text-light"></i></div>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0 text-light border-bottom border-light pb-2"> Payment Summery</h5>
                                </div>


                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        Generated Commission
                                        <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                            <i class="fas fa-info-circle text-light"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>{{  __('$') . substr(number_format($total_earning,4 ,'.',''),0,-2) }}</span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        Paid Commission
                                        <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                            <i class="fas fa-info-circle text-light"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>{{  __('$') . substr(number_format($paid_payment_request,4 ,'.',''),0,-2) }}</span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        Pending Payment
                                        <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                            <i class="fas fa-info-circle text-light"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>{{  __('$') . substr(number_format($pending_payment_request,4 ,'.',''),0,-2) }}</span>
                                    </div>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        Unprocessed Request
                                        <a href="javascript:" data-toggle="modal" data-target="#referralLevelModal">
                                            <i class="fas fa-info-circle text-light"></i>
                                        </a>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span>{{  __('$') . substr(number_format($due_payment,4 ,'.',''),0,-2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
