@extends('layouts.main')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <h4 class="m-0 text-info py-2">{{ $title }}</h4>

                    </div><!-- /.col -->
                    <div class="col-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}" class="text-active">Home</a></li>
                            <li class="breadcrumb-item active"> {{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <section class="content ">
            <div class="row d-none">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="from_date">From Date</label>
                        <input type="date" class="form-control" id="from_date" name="from_date"
                            value={{ $from_date }}>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="to_date">To Date</label>
                        <input type="date" class="form-control" id="to_date" name="to_date" value={{ $to_date }}>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="javascript:" class="search_btn btn btn-link">Search</a>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div id="search_result" class=" row justify-content-center px-3 text-dark ">

            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {
            $('.search_btn').click(function() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                $.ajax({
                    url: "{{ route('passbook_search') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        from_date: from_date,
                        to_date: to_date
                    },
                    success: function(data) {
                        $('#search_result').html(data.html_view);
                    }
                });

            });
            //trigger
            $('.search_btn').trigger('click');
        });
    </script>
@endsection
