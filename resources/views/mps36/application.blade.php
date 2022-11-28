@extends('layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-md-12 ">
                <div class="row ">


                    <div class="col-xl-6 col-lg-6">

                            <div class="card   l-bg-blue-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0"> </h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8 b-2">
                                            <h2 class="d-flex align-items-center mb-0 pb-4 ">
                                                Contact Admin
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span class="d-none">2.5% <i class="fa fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                    <div class="contact_admin d-none">
                                        <form action="{{route('self_investment.contact_admin_store')}}" method="post">
                                            @csrf

                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="number" class="form-control" id="amount" name="amount">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                    <div class="  progress mt-1 d-none" data-height="8" style="height: 8px;">

                                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>


                    <div class="col-xl-6 col-lg-6">
                        <a href="{{ route('self_investment.pay') }}">
                        <div class="card card-anim l-bg-green-dark">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0"> </h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8 pb-2">
                                        <h2 class="d-flex align-items-center mb-0 pb-4">
                                            Pay
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <span class="d-none">2.5% <i class="fa fa-arrow-up"></i></span>
                                    </div>
                                </div>
                                <div class="progress mt-1 d-none" data-height="8" style="height: 8px;">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                </div>
                            </div>
                        </div>
                        <a>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.contact_admin').each(function () {
                var $this = $(this);
                 $this.removeClass('d-none');
            });
        });
    </script>
@endsection
