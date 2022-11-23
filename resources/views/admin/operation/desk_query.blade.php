@extends('layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h4 class="m-0 text-vq-light py-2">{{ __('Query') }}</h4>

                    </div><!-- /.col -->
                    <div class="col-md-6 pl-3">
                        <ol class="breadcrumb float-sm-right border-0 p-0 pt-1">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}" class="text-vq-light">Home</a></li>
                            <li class="breadcrumb-item active"> query</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <section class="content">

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <tr>
                                <th>Time</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                            </tr>
                            @if (!$collection == null)
                                @foreach ($collection as $data)
                                    <tr>
                                        <td>{{ date('d-m-Y H:i:s',strtotime($data->created_at)) }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->message }}</td>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif

                        </table>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endsection
