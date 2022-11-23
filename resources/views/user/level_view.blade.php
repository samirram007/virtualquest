<div class="col-12"  style="background:transparent;">
<div class="row" style=" padding:0;">
     @foreach ($my_team as $key => $member)
        <div class="col-md-4 col-lg-3   rounded d-flex flex-column position-relative text-secondary"
        style="gap:20px; margin:5px; border:2px solid #2d98e8aa; background:#33333355; padding:10px; border-left:10px solid #2d98e8; ">

        <div class="position-absolute rounded-circle py-2 px-3 border border-danger d-none "  >
            <div>{{ $member->level }}</div>
        </div>

            <div class=" fw-bold">
                <div>{{ $member->name }}</div>
            </div>
            <div class="">
                <div>{{ $member->code }}</div>
            </div>


        </div>
    @endforeach
</div>

</div>
