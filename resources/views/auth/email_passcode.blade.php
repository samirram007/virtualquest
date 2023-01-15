<div style="text-align: center">

     <p>
        <img src="{{asset('images/velogo.png')}}" style="width:200px;" alt="velogo">
    </p>
    <h4 style="color: rgb(75, 100, 27)">Congratulations</h4>
    <p style="color:rgb(12, 103, 131); font-weight:bold">
        <strong style="color:rgb(52, 165, 165)"> Your UserID </strong>: {{$email}}
    </p>
    <p>
        <strong style="color:rgb(52, 165, 165)"> Your Passcode </strong>: {{$passcode}}
    </p>
    <p>
        <a href="{{ route('login')}}" style="color:#ffffff;display:inline-block;text-decoration:none;
            padding: 6px 16px;
            font-weight: 500;
            font-size: 14px;
            border-color: #75b638;
            background-color: #53a742;
            border-radius: 2px;
            border-width: 1px;
            border-style: solid; ">Click to Login</a>
    </p>
    <h4>Thank You For Join With Us.</h4>
</div>



