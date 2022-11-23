@extends('layouts.main')
@section('content')
    <div class="content-wrapper">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <div class="container-full">

            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-vq text-light">
                                <h3 class="widget-user-username">User Name: {{ $user->name }}</h3>
                                <a href="{{ route('profile.edit', $user->id) }}"
                                    class="float-right btn btn-rounded btn-outline-info mt-1 d-none">
                                    <i class="fa fa-edit"></i>
                                </a>

                                {{-- <h6 class="widget-user-desc">User Type : {{$user->usertype}}</h6> --}}
                                <h6 class="widget-user-desc">User Email : {{ $user->email }}</h6>
                            </div>
                            {{-- <div class="widget-user-image">
                          <img class="rounded-circle"
                          src="{{ (!empty($user->image)? url('upload/user_images/'.$user->image) :url('upload/no_image.jpg') )}}"
                          alt="User Avatar">
                        </div> --}}
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-4 ">
                                        <div class="description-block">
                                            <h5 class="description-header">Code</h5>
                                            <span class="description-text">{{ $user->code }}</span>
                                        </div>

                                        <!-- /.description-block -->
                                    </div>
                                    <div class="col-sm-4 br-1 bl-1">
                                        <div class="description-block">
                                            <h5 class="description-header">Sponsor</h5>
                                            <span
                                                class="description-text">{{ $user->parent_id == null ? '' : $user['parent']['code'] }}</span>
                                        </div>

                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->

                                    <!-- /.col -->
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header">Status</h5>
                                            <span class="description-text">{{ $user->status }}</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-light rounded">



                        <div class="row pt-4  px-2">

                            <div class="col-md-2">
                                <label for="level">Select Level: </label>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">

                                    <select class="form-control" name="level" id="level">
                                        @foreach ($level as $lvl)
                                            <option value="{{ $lvl }}">{{ $lvl }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <a href="javascript:" id="level_search"  class="btn btn-primary">Submit</a>
                                </div>
                            </div>



                        </div>


                </div>
                <div id="result_panel" class="bg-transparent     rounded mt-2">

                </div>

            </section>
        </div>


    </div>
    <script>
        $(document).ready(function() {
            $('#level_search').on('click', function(e) {
                //e.preventDefault();
                var level = $('#level').val();
                $.ajax({
                    url: "{{ route('user.level.search') }}",
                    type: "GET",
                    data: {
                        level: level
                    },
                    success: function(data) {
                        // $('#level_search').trigger('reset');
                        console.log(data);
                        $('#result_panel').html(data.html);
                    }
                });
            });
        });
    </script>
@endsection
