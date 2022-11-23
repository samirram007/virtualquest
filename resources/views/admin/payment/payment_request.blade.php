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

        .notifyPopup {
            position: relative;
            text-align: center;
            width: 200px;
        }

        .formPopup {
            display: none;
            position: fixed;
            transform: translate(0%, 30%);
            /* border: 3px solid #999999; */
            box-shadow: -7px 1px 10px 3px #222;
            z-index: 1002;
            margin: 0 auto;
            border-radius: 0.5rem;
        }

        .statusFormPopup {
            display: none;
            position: fixed;
            right: 0;
            top: 0;
            transform: translate(-5%, 5%);
            /* border: 3px solid #999999; */
            box-shadow: -7px 1px 10px 3px #222;
            z-index: 1002;
            border-radius: 0.5rem;
        }

        .formContainer {
            max-width: 300px;
            margin: 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 0.5rem;
        }


        .formContainer .cancel {
            background-color: #cc0000;
        }

        .formContainer .btn:hover,
        .openButton:hover {
            opacity: 1;
        }

        .popup-header {
            color: rgb(40, 11, 68);
            font-weight: bold;
            padding: 10px;
            font-size: 14px;
            text-align: left;
            min-height: 50px;
        }

        .status-popup-header {
            color: #fff;
            padding: 10px 60px;
            text-align: center;
            min-height: 50px;
        }

        .text {
            color: #fff;
            padding: 10px;
            text-align: left;
            min-height: 50px;

            position: relative;
            color: rgb(236, 233, 233);
            width: 250px;
            /* Could be anything you like. */
        }

        .copy-icon {
            cursor: pointer;
            color: rgb(202, 219, 224);
        }

        .copy-icon:hover {
            color: rgb(255, 255, 255);
        }

        .text-concat {
            position: relative;
            display: inline-block;
            word-wrap: break-word;
            overflow: hidden;
            max-height: 5.6em;
            /* (Number of lines you want visible) * (line-height) */
            line-height: 1em;
            text-align: justify;
            border: 2px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
        }

        .text.ellipsis::after {
            content: "...";
            position: absolute;
            right: -12px;
            bottom: 4px;
        }
    </style>
    @include('admin.payment.payment_status_change')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h4 class="m-0 text-vq-light py-2">{{ __('Payment Request') }}</h4>

                    </div><!-- /.col -->
                    <div class="col-md-6 pl-3">
                        <ol class="breadcrumb float-sm-right border-0 p-0 pt-1">
                            <li class="breadcrumb-item "><a href="{{ route('home') }}" class="text-vq-light">Home</a></li>
                            <li class="breadcrumb-item active"> payment</li>
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
                                <th>Request Date</th>
                                <th>Name</th>
                                <th>Network</th>
                                <th>Address</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                                <th>Status</th>
                            </tr>
                            @if (!$collection == null)
                                @foreach ($collection as $data)
                                    <tr>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($data->payment_request_date)) }}</td>
                                        <td>{{ $data['user']['name'] }}</td>
                                        <td>{{ $data->payment_method }}</td>
                                        <td>{{ $data->payment_account }}</td>
                                        <td>{{ $data->amount }}</td>
                                        <td>{{ $data->payment_confirm_date == null ? '' : date('d-m-Y H:i:s', strtotime($data->payment_confirm_date)) }}
                                        </td>
                                        @if($data->status == 'paid')
                                            <td><a href="javascript:" > {{ $data->status }}</a></td>
                                        @elseif($data->status == 'rejected')
                                            <td><a href="javascript:" > {{ $data->status }}</a></td>
                                        @else
                                        <td><a href="javascript:" onclick="openStatusForm('{{ $data->id }}')">
                                            {{ $data->status }}</a>
                                        </td>
                                        @endif


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

        function openStatusForm(id) {
            // closePopup();
            console.log(id);
            document.getElementById("statusPopupForm").style.display = "block";
            $.ajax({
                url: "{{ route('admin.status_form') }}",
                type: "GET",
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == 'success') {

                        $('#statusPopupForm').html(data.html);
                    } else {
                        // $('#statusPopupForm').hide();
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function closeStatusForm() {
            document.getElementById("statusPopupForm").style.display = "none";
            // setLoginSession(0);
        }
    </script>
@endsection
