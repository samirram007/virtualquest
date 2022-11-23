<div class="modal fade" id="resetPasscodeCenter" tabindex="-1" role="dialog" aria-labelledby="resetPasscodeCenterTitle"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasscodeLongTitle">Reset Passcode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="reset_password_form" action="{{route('reset_passscode')}}" method="POST" >
                @csrf
            <div class="modal-body">

                    <div class="form-group">
                        <label for="passcode">New Passcode</label>
                        <input type="text" class="form-control" id="passcode" name="passcode"
                            placeholder="Enter Passcode" maxlength="6" minlength="6"
                            autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');">
                    </div>
                    <div class="form-group">
                        <label for="confirm_passcode">Confirm Passcode</label>
                        <input type="text" class="form-control" id="confirm_passcode" name="confirm_passcode"
                            placeholder="Confirm Passcode" maxlength="6" minlength="6"
                            autocomplete="off"
                              oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>

</div>
