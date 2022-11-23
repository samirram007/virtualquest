<div style="text-align: center">
    <h2>Welcome!</h2>
     <p>
        <img src="{{asset('images/vqlogo_sm.png')}}" style="width:200px;" alt="vqlogo">
    </p>
    <p>Dear {{$name}},</p>
    <p>
        We are excited to have you on board. Please click the link below to confirm your registration.
    </p>
    <p>
        <a href="{{ route('join_confirm_link', $code)}}" style="color:#ffffff;display:inline-block;text-decoration:none;
            padding: 6px 16px;
            font-weight: 500;
            font-size: 20px;
            border-color: #f19640;
            background-color: #f5a43a;
            border-radius: 2px;
            border-width: 1px;
            border-style: solid; ">Confirm Registration</a>
    </p>
</div>



