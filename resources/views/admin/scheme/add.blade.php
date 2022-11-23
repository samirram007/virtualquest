@extends('layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .openBtn {
            display: flex;
            justify-content: left;
        }

        .openButton {
            border: none;
            border-radius: 5px;
            background-color: #1c87c9;
            color: white;
            padding: 14px 20px;
            cursor: pointer;
            position: fixed;
        }

        .statusPopup {
            position: relative;
            text-align: center;
            width: 100%;
            display: flex;
            justify-content: center;
            align-content: center;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h4 class="m-0 text-vq-light py-2">{{ __('New Scheme') }}</h4>

                    </div><!-- /.col -->
                    <div class="col-md-6 pl-3">
                        <ol class="breadcrumb float-sm-right border-0 p-0 pt-1">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}" class="text-vq-light">Home</a></li>
                            <li class="breadcrumb-item active"> scheme</li>
                        </ol>
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <section class="content px-4">


            <form action="{{ route('admin.scheme_store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name" class="text-light">Scheme Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Scheme Name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="duration" class="text-light">Duration</label>
                            <input type="number" class="form-control" id="duration" name="duration"
                                placeholder="Enter Duration">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="interest" class="text-light">Interest(%)</label>
                            <input type="number" class="form-control" id="interest" name="interest"
                                placeholder="Enter Interest">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="minimum_amount" class="text-light">Min Amount</label>
                            <input type="text" class="form-control" id="minimum_amount" name="minimum_amount"
                                placeholder="Enter Min Amount">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="distribution_level" class="text-light">Distribution Level</label>
                            <input type="number" class="form-control" id="distribution_level" name="distribution_level"
                                placeholder="Enter Distribution Level">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="status" class="text-light">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 py-2">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>



        </section>
    </div>
@endsection
