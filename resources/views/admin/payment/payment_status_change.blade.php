<div class="statusPopup">

    <div class="formPopup  pop bg-vq" id="statusPopupForm"  style="display: none;" >

    </div>
  </div>
<script>
//    form submit

function copy_to_clipboard(txt) {
            /* Get the text field */
            var copyText = txt;

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
</script>
