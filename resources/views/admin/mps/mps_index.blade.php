@extends('layouts.main')


@section('content')
    <style>
        input[type="checkbox"] {
            /* ...existing styles */
            display: grid;
            place-content: center;
        }

        input[type="checkbox"]::before {
            content: "";
            /* width: 1.65em; */
            height: 2em;
            transform: scale(0);
            transition: 120ms transform ease-in-out;
            box-shadow: inset 1em 1em var(--form-control-color);
        }

        input[type="checkbox"]:checked::before {
            transform: scale(1);
        }
    </style>
    <div class="container">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <div class="row justify-content-center p-3">
            <div class="col-md-12 ">
                <div class="row ">
                    @include('admin.mps.mps_menu')
                </div>
                <div class="row">
                    <div class="card   l-bg-blue">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i>

                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table text-light">
                                        <tr>

                                            <th>Investment ID</th>
                                            <th>Investment Date</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                        @foreach ($mps as $data)
                                            <tr>

                                                <td>{{ 'INV-' . str_pad($data->id, 5, 0, STR_PAD_LEFT) }}</td>
                                                <td>{{ date('d-M-Y', strtotime($data->investment_date)) }}</td>
                                                <td>{{ $data['user']['code'] }}</td>
                                                <td>{{ $data['user']['name'] }}</td>
                                                <td class="text-right">{{ $data->amount != 0 ? '$' . $data->amount : '' }}</td>
                                                <td id="status{{ $data->id }}" class="text-center">

                                                    @if($data->status == 1)
                                                    {!!'<span class="alert text-success">Active</span>'!!}
                                                 @elseif($data->status == 2)
                                                 {!!'<span class="alert text-danger">Reject</span>'!!}
                                                 @else
                                                 {!! ' <span class=" ack btn btn-outline-danger text-light" data-id="' . $data->id . '">Pending</span>'!!}
                                                 @endif

                                                {{-- {!! $data->status == 1
                                                    ? '<span class="alert text-warning">Acknowledged</span>'
                                                    : ' <span class=" ack btn btn-outline-danger text-light" data-id="' . $data->id . '">Pending</span>' !!}</td> --}}

                                            </tr>
                                        @endforeach
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-right">Total</td>
                                                <td>${{ $mps->sum('amount') }}</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.ack').click(function(e) {
                var mps_id = $(this).data('id');
                $.ajax({
                    url: "{{ route('admin.mps.acknowledge') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        mps_id: mps_id
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#status'+mps_id).html('<span class="alert text-success">Acknowledge</span>');
                            //$(this).html('<span class="alert text-success">Acknowledge</span>');


                           // $('#result_panel').html(response.view);
                        }
                    }
                });
            });
        });
    </script>
@endsection
