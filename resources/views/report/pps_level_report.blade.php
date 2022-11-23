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

            </div>
            <div class="row">
                {{-- <div class="col-md-4">
                    <div class="bg-info rounded p-2">
                        <small class="text-secondary ">

                                <h5 class="card-title>">Name : {{ $collection[0]->name }}</h5>

                        </small>
                    </div>
                </div> --}}
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Level</th>
                                <th>Days</th>
                                <th>Benefits</th>
                                <th>Transfered</th>
                                <th>Balance</th>
                                <th>Transfer To Main Wallet</th>

                            </tr>
                            @if (!$collection == null)
                                @foreach ($collection as $data)
                                {{-- @dd($data); --}}
                                    <tr>
                                        <td>{{ $data['code'] }}</td>
                                        <td>{{ $data['name'] }}</td>
                                        <td>{{ '$' . $data['amount'] }}</td>
                                        <td>{{ $data['level'] }}</td>
                                        <td>{{ $data['day_count'] }}</td>
                                        <td>{{  '$' . substr(number_format($data['commission'],4,'.',''),0,-2) }}</td>
                                        <td>{{   '$' . substr(number_format($data['transfered'],4,'.',''),0,-2)   }}</td>
                                        <td>{{   '$' . substr(number_format($data['balance'],4,'.',''),0,-2)   }}</td>

                                        <td>

                                                <button type="button"
                                                data-distributionid="{{ base64_encode($data['id']) }}"
                                                data-payble="{{ base64_encode($data['payble']) }}"

                                                 class=" d-flex btn btn-dark btn-block {{ $data['payble']==0 ? 'disabled':' lets_collect'}}">{{ $data['payble']==0? '...': 'Transfer  $' . substr(number_format($data['payble'],4,'.',''),0,-2)  }}
                                                </button>

                                            {{-- <button type="submit" class=" d-flex btn btn-dark btn-block {{ $data['payble']==0 ? 'disabled':''}}">{{ $data['payble']==0? '...': 'Transfer  $' . substr(number_format($data['payble'],4,'.',''),0,-2)  }}
                                            </button> --}}
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                            <tfoot>
                                <tr>
                                    <th colspan="8" class="text-right">Total</th>
                                    <th>${{ substr(number_format($total_payble,4,'.',''),0,-2) }}</th>

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
            $('.lets_collect').click(function() {
                var distribution_id = $(this).data('distributionid');
                var payble = $(this).data('payble');
                //alert(distribution_id);
                //alert(payble);
                $.ajax({
                    url: "{{ route('pps_level_transfer') }}",
                    type: "POST",
                    data: {
                        distribution_id: distribution_id,
                        payble: payble,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        // alert(data);
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection
