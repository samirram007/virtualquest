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
        @foreach ($mps as $data)
            <tr>

                <td>{{ 'INV-'.str_pad($data->id,5,0,STR_PAD_LEFT) }}</td>
                <td>{{ date('d-M-Y',strtotime($data->investment_date)) }}</td>
                <td>{{$data['user']['code']}}</td>
                <td>{{$data['user']['name']}}</td>
                 <td>{{$data->amount!=0?'$'.$data->amount:''}}</td>
                 <td id="status{{$data->id}}">{!! $data->status==1?'<span class="alert text-success">Acknowledge</span>':' <span class=" ack btn btn-outline-danger text-light" data-id="'.$data->id.'"> Pending</span>' !!}</td>

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
