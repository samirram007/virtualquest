<div class=" popup-header">
    <div>Request no. : {{ $payment_request->id }}</div>
    <div>Date: {{ date('d-m-Y H:i:s', strtotime($payment_request->payment_request_date)) }}</div>
    <div>Network: {{ $payment_request->payment_method }}</div>
    <div class="text">Address: <span class="copy-icon"
            onclick="copy_to_clipboard('{{ $payment_request->payment_account }}');"><span class="iconify"
                data-icon="carbon:copy" data-width="22" data-height="22"></span>
        </span>
        <small class="text-concat ellipsis mt-1">{{ $payment_request->payment_account }}</small>

    </div>
</div>
<form id="statusForm" action="" class="formContainer">
    @csrf
    <div class="form-group mb-2">
        <input type="hidden" value="{{ $payment_request->id }}" name="id" id="id">
        <select name="status" id="status" class="form-control">
            @foreach ($payment_status as $status)
                <option value="{{ $status }}" {{ $status == $payment_request->status ? 'selected' : '' }}>Status:
                    {{ $status }}</option>
            @endforeach

        </select>
    </div>

    <div class="form-group mb-2">
        <textarea class="form-control" name="note" id="note" rows="3" placeholder="Enter your note"></textarea>
    </div>
    <div class="row">
        <div class="col-6">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="col-6">
            <button type="button" class="btn btn-danger" onclick="closeStatusForm()">Close</button>
        </div>
    </div>
</form>
<script>
    //    form submit
    $('#statusForm').submit(function (e) {
        e.preventDefault();
        //serialize data
        var formData = $(this).serialize();
        //send data
        $.ajax({
            url: "{{ route('admin.payment.status') }}",
            type: "POST",
            data: formData,
            success: function (data) {
                //console.log(data);
                if (data.status == 'success') {
                    $('#statusForm').trigger('reset');
                    window.location.reload();
                    $('#statusPopupForm').html('<div class="alert alert-info text-light" role="alert">Thank you for your message. We will get back to you as soon as possible.</div><button type="button" class="btn btn-danger" onclick="closeStatusForm()">Close</button>');

                    // alert('Thank you for your message. We will get back to you as soon as possible.');
                } else {
                    $('#statusPopupForm').hide();
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
</script>
