@extends('layouts.main')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row  ">
                    <div class="col-6">
                        <h4 class="m-0 text-vq-light py-2">{{ $title }}</h4>

                    </div><!-- /.col -->
                    <div class="col-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}" class="text-vq-light">Home</a></li>
                            <li class="breadcrumb-item active"> {{ $title }} </li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row ">
                <div class="col-12">
                    <div class="bg-vq rounded p-2">
                        <small class="text-secondary ">
                            @if (!$downline == null)
                            <h5 class="card-title">Name : {{ $downline[0]->name}}</h5>
                            <h5 class="card-title">Self : {{ $downline[0]->self != 0 ? '$' . $downline[0]->self : '' }}</h5>
                            <h5 class="card-title">Team : {{ $downline[0]->team != 0 ? '$' . $downline[0]->team : '' }}</h5>
                            @endif
                        </small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-dark">
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                {{-- <th>Sponsor</th> --}}
                                <th>Level</th>
                                <th>Self Inv</th>
                                <th>Team Inv</th>
                            </tr>
                            @if (!$downline == null)
                                @foreach ($downline as $data)
                                    <tr>
                                        <td>{{ $data->code }}</td>
                                        <td>{{ $data->name }}</td>
                                        {{-- <td>{{ !empty($data['parent']) ? $data['parent']['code'] : '' }}</td> --}}
                                        <td>{{ $data->level }}</td>
                                        <td>{{ $data->self != 0 ? '$' . $data->self : '' }}</td>
                                        <td>{{ $data->team != 0 ? '$' . $data->team : '' }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            {{-- @empty
                            <tr>
                                <td colspan="5" class="text-center">No Data Found</td>
                            </tr>
                        @endforelse --}}
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
