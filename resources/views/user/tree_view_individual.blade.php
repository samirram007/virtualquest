<div class="col-12" style="background:transparent;">
    <div class="row">
        @php
            $display = '';
            // echo auth()->user()->id;
            // echo $user->parent_id;
            if (auth()->user()->parent_id == $user->parent_id) {
                $display = 'd-none';
            }
        @endphp
        <a href="javascript:" class="text-vq-light {{ $display }}" onclick="search_immediate({{ $user->parent_id }})">
            <span class="iconify pb-1" data-icon="akar-icons:arrow-back" style="color: white;" data-width="20"
                data-height="20"></span> back</a>
    </div>
    <div class="row" style=" padding:0;">
        {{-- @dd($immediate) --}}
        @foreach ($immediate as $key => $member)
            <div class="col-md-4 col-lg-3  ">

                <div class="form-group rounded text-secondary"
                style=" border:2px solid #2d98e8aa; background:#81bad455; padding:10px; border-left:10px solid #1388e0; ">
                    <div class=" fw-bold text-light">
                        <div>{{ $member->name }}</div>
                    </div>
                    <div class="">
                        <div>{{ $member->code }}</div>
                    </div>
                    <a href="javascript:" class="text-vq-light bottom-0" onclick="search_immediate({{ $member->id }})"> click
                        to view</a>



                </div>

            </div>
        @endforeach
    </div>

</div>
