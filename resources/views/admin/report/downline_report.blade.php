@extends('layouts.main')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-info py-2">{{$title}}</h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('admin.home') }}"
                                    class="text-active">Home</a></li>
                            <li class="breadcrumb-item active"> downline</li>
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
                            <th>Code</th>
                            <th>Name</th>
                            <th>Sponsor</th>
                            <th>Level</th>
                            <th>Self Inv</th>
                            <th>Team Inv</th>
                        </tr>
                        @foreach ($downline as $data)
                            <tr>
                                <td>{{$data->code}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{!empty($data['parent']) ? $data['parent']['code']:''}}</td>
                                <td>{{$data->level}}</td>
                                <td>{{$data->self!=0?'$'.$data->self:''}}</td>
                                <td>{{$data->team!=0?'$'.$data->team:''}}</td>

                            </tr>
                        @endforeach
                    </table>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <script>
             $(document).ready( function () {
                    $('#table').DataTable();
            } );
    </script>
@endsection
