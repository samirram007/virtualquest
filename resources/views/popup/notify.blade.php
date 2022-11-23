<div class="notifyPopup">
    <div class="formPopup  pop bg-vq" id="notifyPopupForm" style=" display:{{ session()->get('login')=="3" ? 'block':'none'}}" >
        <div class=" popup-header">
            Please fill out the form below and we will<br>get back to you as soon as possible.
        </div>
      <form id="notifyForm" action="" class="formContainer">
        @csrf
        <div class="form-group mb-2">
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
        </div>
        <div class="form-group mb-2">
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
        </div>
        <div class="form-group mb-2">
            <textarea class="form-control" name="message" id="message" rows="3" placeholder="Enter your message"></textarea>
        </div>
        <div class="row">
            <div class="col-6">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-danger" onclick="closeNotifyForm()">Close</button>
            </div>
        </div>
      </form>
    </div>
  </div>
<script>
//    form submit
    $('#notifyForm').submit(function(e){
        e.preventDefault();
        //serialize data
        var formData = $(this).serialize();
        //send data
        $.ajax({
            url: "{{ route('notify') }}",
            type: "POST",
            data: formData,
            success: function(data){
                //console.log(data);
                if(data.status == 'success'){
                    $('#notifyForm').trigger('reset');
                    $('#notifyPopupForm').html('<div class="alert alert-success" role="alert">Thank you for your message. We will get back to you as soon as possible.</div><button type="button" class="btn btn-danger" onclick="closeNotifyForm()">Close</button>');

                   // alert('Thank you for your message. We will get back to you as soon as possible.');
                }else{
                    $('#notifyPopupForm').hide();
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    });
</script>
