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

                <div class="bg-light rounded px-4">



                    <div class="row pt-4  px-2">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name: </label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Enter Email: </label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>

                    </div>
                    <div class="row  pl-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <a href="javascript:" id="send_joining_request" class="btn btn-primary">Send Joining Request [email]</a>
                            </div>
                        </div>
                    </div>


                </div>
                <div id="result_panel" class="bg-transparent     rounded mt-2">
                    <table id="example1" class="table table-respomsive text-light">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collections as $request)
                                <tr>
                                    <td>{{ $request->name }}</td>
                                    <td>{{ $request->email }}</td>
                                    <td>{{ $request->code }}</td>
                                    <td>{{ $request->status }}</td>
                                    <td>
                                        <a href="javascript:" class="btn btn-primary btn-sm">Resend</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>

            </section>
        </div>


    </div>
    <script>
        $(document).ready(function() {
            $('#send_joining_request').on('click', function(e) {
                //e.preventDefault();
                var email = $('#email').val();
                var name = $('#name').val();
                $.ajax({
                    url: "{{ route('send_joining_request') }}",
                    type: "POST",
                    data: {
                        name:name,
                        email: email,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        // $('#level_search').trigger('reset');
                        console.log(data);
                        window.location.reload();
                        //$('#result_panel').html(data.html);
                    }
                });
            });
        });
    </script>
@endsection
