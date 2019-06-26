@section('title')
login
@endsection
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ URL::asset('material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('js/main.js') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link href="https://account.africastalking.com/assets/img/favicons/favicon-32x32.png" rel="icon" type="image/png" sizes="32x32">
    <title>@yield('title')</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .btn {
            background-image: linear-gradient(to right, #fc9206 20%, #ffb527 80%);
            color: #f8f8f8;
            box-shadow: none;
            padding-top: 9px;
            padding-bottom: 9px;
            border-left: 1px solid #fc9206;
        }
        .r {
            padding: 10px;
            border-radius: 25px;
        }
    </style>
</head>

<body background="https://africastalking.com/img/voice/banner.png">
    <section style="margin:0 auto; padding-top: 5%; height: 100% !important;">
        <div class="row r" style="height: 500px; width: 70%; margin: auto; box-shadow: 0 8px 17px rgba(0, 0, 0, 0.2);">
            <div class="col-md-6" style="background-color: clear; height: 100%; border-right:2px dotted #fc9206;padding-top: 15%; padding-right: 10%;">
                <img src="https://africastalking.com/img/logo_white.svg" class="center">
                @foreach ($auth as $user)
                    <li>{{$user -> email}}</li>
                    <li>{{$user -> password}}</li>
                @endforeach
            </div>
            <div class="col-sm-6" style="height: 100%;  padding-top: 175px;">
                <div class="input-group" style="padding-bottom: 10px;">
                    <span class="input-group-addon" style="width: 35px; padding: 10px; "><i class="zmdi zmdi-email"  ></i></span>
                    <div class="fg-line" style="width: 379px; ">
                        <input type="text" class="form-control" style="height: 36px; padding: 15px;  " placeholder="Email Address" id="email">
                    </div>
                </div>
                <div class="input-group" style="padding-bottom: 25px;">
                    <span class="input-group-addon" style="width: 35px; padding: 10px; "><i class="zmdi zmdi-key"></i></span>
                    <div class="fg-line" style="width: 379px; ">
                        <input type="text" class="form-control" style="height: 36px; padding: 15px;  " placeholder="Password" id="password">
                    </div>
                </div>
                <button class="btn btn-lg btn-block r">Sign in</button>
            </div>

        </div>
    </section>
</body>

</html>