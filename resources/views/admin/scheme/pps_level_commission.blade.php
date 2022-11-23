@extends('layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-2 text-dark">PPS Level Commission</h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}" class="text-active">Home</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('admin.scheme_index') }}"
                                    class="text-active">Scheme</a></li>
                            <li class="breadcrumb-item active">PPS Level Commission</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card p-3   min-vh-100 px-4">


                <div id="searchPanel" class="searchPanel px-4">
                    <div class="row">
                       Scheme:  {{$collection->name}}
                    </div>
                    <form action="{{route('admin.pps_level_commision_store',$collection->id)}}" method="post">
                        @csrf
                        <div id="data-grid" class="card-item rounded">
                            <div class="row">
                                <div class="col-md-2 col-4"">
                                    LEVEL
                                </div>
                                <div class="col-md-3  col-8">
                                    COMMISSION
                                </div>


                            </div>

                            @if ($commissions->count() > 0)
                                @foreach ($commissions as $key => $data)
                                    <div class="row">
                                        <div class="col-md-2 col-4">
                                            <input class="form-control" type="text" name="level[]" readonly
                                                value="{{ $data->level }}">
                                        </div>
                                        <div class="col-md-3 col-8">
                                            <input class="form-control" type="text" name="commission[]"
                                                value="{{ $data->commission }}">
                                        </div>


                                    </div>
                                @endforeach
                            @else
                                @for ($i = 1; $i <= $collection->distribution_level; $i++)
                                    <div class="row">
                                        <div class="col-md-2 col-4">
                                            <input class="form-control" type="text" name="level[]" readonly
                                                value="{{ $i }}">
                                        </div>
                                        <div class="col-md-3  col-8">
                                            <input class="form-control" type="text" name="commission[]" value="0.1">
                                        </div>


                                    </div>
                                @endfor
                            @endif

                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>


                    </form>


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
