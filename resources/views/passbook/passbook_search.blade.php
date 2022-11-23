<div class="container  l-bg-blue rounded" >
    <div class="col-12 text-right">
        <div class="row border-bottom border-secondary py-2">
            <div class="col-6 text-left"> Date</div>
            <div class="col-3"> <span class="d-md-none">DR</span><span class="d-md-block   d-none ">DEBIT</span></div>
            <div class="col-3"> <span class="d-md-none">CR</span><span class="d-md-block   d-none ">CREDIT</span></div>
            {{-- <div class="col-2 col-sm-hidden"> <span class="d-md-none">BAL</span><span class="d-md-block   d-none ">BALANCE</span> --}}
        </div>
    </div>
    @foreach ($passbook as $key => $data)
        <div class="row border-bottom border-gray py-2 h6 small">
            <div class="col-6 text-left"> {{ date('d-m-Y', strtotime($data['log_date'])) }}</div>
            <div class="col-6">
                <div class="row">
                    <div class="col-6  text-right">
                        {{ $data['debit'] == 0 ? '' : substr(number_format($data['debit'], 4, '.', ''), 0, -2) }}</div>
                    <div class="col-6 text-right ">
                        {{ $data['credit'] == 0 ? '' : substr(number_format($data['credit'], 4, '.', ''), 0, -2) }}
                    </div>

                </div>

            </div>
            <div class="col-12 text-right text-sm pt-2 small text-warning">BAL: {{ substr(number_format($data['balance'], 4, '.', ''), 0, -2) }}</div>
        </div>
    @endforeach

</div>
</div>
