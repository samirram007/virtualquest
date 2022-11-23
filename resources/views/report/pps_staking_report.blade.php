@extends('layouts.main')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h4 class="m-0 text-vq-light py-2">{{ $title }}</h4>

                    </div><!-- /.col -->
                    <div class="col-md-6 pl-3">
                        <ol class="breadcrumb float-sm-right border-0 p-0 pt-1">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}" class="text-vq-light">Home</a></li>
                            <li class="breadcrumb-item active"> {{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <section class="content">

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="bg-secondary rounded p-4">
                        <div class="text-dark h4   d-flex flex-column">

                                <div class="d-flex flex-row justify-content-between py-2"><div>Benefit :</div> <div>${{ substr(number_format($total_benefit,4,'.',''),0,-2)}}</div> </div>
                                <div class=" d-flex flex-row justify-content-between py-2"><div>Transfered : </div> <div>${{ substr(number_format($transfered,4,'.',''),0,-2)}}</div> </div>
                                <div class=" d-flex flex-row justify-content-between py-2"><div>Balance : </div> <div>${{ substr(number_format($balance,4,'.',''),0,-2)}}</div> </div>

                        </div>
                        <div>
                            <form id="transfer_form" method="POST" action="{{route('pps_transfer.wallet')}}" >
                                @csrf
                                <input type="text" class="sr-only" name="sub_wallet" id="sub_wallet" value="{{$sub_wallet}}">
                                <input type="text" class="sr-only" name="balance" id="balance" value="{{$balance}}">
                                @if($balance>1)
                                <button type="submit" class="d-flex btn btn-dark btn-block {{ $balance<0.0001 ? 'disabled':''}}">Transfer ${{ substr(number_format($balance,4,'.',''),0,-2) }} To Main Wallet</button>
                                @else
                                <a href="javascript:" class="d-flex  btn btn-dark btn-block disabled">You don't have sufficient balance to transfer</a>
                                @endif

                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Days</th>
                                <th class="text-right">Benefits</th>
                            </tr>
                            @if (!$collection == null)
                                @foreach ($collection as $data)
                                    <tr>
                                        <td>{{ $data['user']['code'] }}</td>
                                        <td>{{ $data['user']['name'] }}</td>
                                        <td>{{ '$' . $data->amount }}</td>
                                        <td>{{ $data->day_count }}</td>
                                        <td class="text-right">{{ $data->commission != 0 ? '$' . substr(number_format($data->commission,4,'.',''),0,-2) : '' }}</td>

                                    </tr>
                                @endforeach
                            @endif
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Total</th>
                                    <th class="text-right">${{ substr(number_format($collection->sum('commission'),4,'.',''),0,-2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();


        });
    </script>
@endsection
