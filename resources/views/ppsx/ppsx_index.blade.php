
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
                                            <td>{{ 'INV-' . str_pad($data->id, 5, 0, STR_PAD_LEFT) }}</td>
                                            <td>{{ date('d-M-Y', strtotime($data->investment_date)) }}</td>
                                            <td>{{ $data['user']['code'] }}</td>
                                            <td>{{ $data['user']['name'] }}</td>
                                            <td>{{ $data->amount != 0 ? '$' . $data->amount : '' }}</td>
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

<script>
    $(document).ready(function() {
        $('.ack').click(function(e) {
            var investment_id = $(this).data('id');
            $.ajax({
                url: "{{ route('admin.investment.acknowledge') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    investment_id: investment_id
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#status' + investment_id).html(
                            '<span class="alert text-success">Acknowledge</span>');
                        //$(this).html('<span class="alert text-success">Acknowledge</span>');


                        // $('#result_panel').html(response.view);
                    }
                }
            });
        });
    });
</script>
