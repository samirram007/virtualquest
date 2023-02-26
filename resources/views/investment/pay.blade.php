@extends('layouts.main')


@section('content')
    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-md-12 ">
                <div class="row ">

                    <div class="col-md-4">
                        <img src="{{ asset('images/pay.jpg') }}" style="width:100%;" alt="">
                    </div>
                    <div class="col-md-8  d-flex align-items-center justify-content-center flex-column">
                        <div class="" style="padding:10px;text-align:center">
                            <span onclick="share();" class="iconify" data-icon="logos:whatsapp-icon" data-width="35"
                                data-height="35"></span>
                            <span class="badge mx-4" onclick="copy_to_clipboard();"><span class="iconify"
                                    data-icon="carbon:copy" style="color: white;" data-width="35" data-height="35"></span>
                            </span>
                        </div>
                        <div class="text-info mt-2 text-lg">
                            <ol>
                                <li>Please Ensure To Select Etherium (ERC 20) network at sender"s wallet</li>
                                <li> Deposit only USDT to this deposit address</li>
                            </ol>

                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
    <script>
        function copy_to_clipboard() {
            /* Get the text field */
            // var copyText = '0x961f4481f39b531ea1d2d6a9348e4586ef504169';
            var copyText = '0xb64Af91F0424a91d34B9F647182792Edd88463f8';

            /* Select the text field */
            //copyText.select();
            //copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText);
            toastr.success(copyText + ' <br>Copied to clipboard');
            /* Alert the copied text */
            //   Swal.fire({
            //     position: 'top-end',
            //     type: 'success',
            //     title: 'Copied to clipboard',
            //     showConfirmButton: false,
            //     timer: 1500
            //   });
            //alert("Copied the text: " + copyText);
        }

        function share() {

            // Getting user input
            var message = $("input[name=message]").val();
            var copyText = '0x961f4481f39b531ea1d2d6a9348e4586ef504169';
            // Opening URL
            window.open(
                "whatsapp://send?text=" + copyText,

                // This is what makes it
                // open in a new window.
                '_blank'
            );
        }
    </script>
@endsection
