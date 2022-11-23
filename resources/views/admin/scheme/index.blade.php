@extends('layouts.main')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-2 text-dark">Scheme List</h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}"
                                    class="text-active">Home</a></li>
                            <li class="breadcrumb-item active">Scheme list</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card p-3   min-vh-100">
                <div class="row   ">
                    <div class="col-md-12">
                                    <div class="col-sm-12 text-right">
                                        <a href="{{ route('admin.scheme_create') }}"
                                            class=" float-left btn btn-rounded btn-info  mb-2">
                                            <span class="iconify" data-icon="mdi:thermometer-plus" data-width="15"
                                                data-height="15">
                                            </span> ADD SCHEME</a>

                                    </div>


                    </div>
                </div>

                <div id="searchPanel" class="searchPanel">
                    <div id="data-grid" class="data-tab-custom rounded">


                        <div class="table-responsive">
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Duration</th>
                                        <th>Interest </th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($collections as $key=> $data)
                                        <tr>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->duration }} Months</td>
                                            <td class="text-wrap text-truncate">{{ $data->interest }}</td>
                                            <td class="text-right">
                                                {{-- <a href="{{ route('admin.scheme.show', $data->id) }}"
                                                    class="btn btn-outline-info"> <span class="iconify" data-icon="mdi:view-dashboard" data-width="15" data-height="15" data-rotate="180deg"></span> View</a> --}}
{{-- dropdown --}}
                                                <div class="dropdown">
                                                    <button class=" badge badge-outline-info dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        SELECT
                                                    </button>
                                                    <div class="dropdown-menu p-2  flex-column" aria-labelledby="dropdownMenuButton">
                                                        <a href="{{ route('admin.scheme_edit', $data->id) }}"
                                                            class="text-info p-2 lh-lg">  Edit</a><br>

                                                        <a href="{{ route('admin.scheme_referral_commission', $data->id) }}"
                                                            class="text-info p-2 lh-lg">  Referral Commission</a><br>
                                                        <a href="{{ route('admin.scheme_pps_level_commission', $data->id) }}"
                                                            class="text-info p-2 lh-lg">  PPS Level Commission</a><br>
                                                        <a href="{{ route('admin.scheme_delete', $data->id) }}"
                                                            class="btn btn-outline-info delete">  Delete</a>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>

                $(document).ready( function () {
                    $('#table').DataTable(
                     );
            } );

    </script>
@endsection
