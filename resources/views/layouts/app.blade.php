<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('assets/images/idcloud_ico.ico') }}" type="image/x-icon">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet"/>
</head>
<body style="background: #52699B;">
<div id="wrapper">
    <div class="card border-primary border-top-sm border-bottom-sm card-authentication1 mx-auto my-5 animated bounceInDown">
        <div class="card-body" style="background: white;">
            <div class="card-content p-2">
                <div class="text-center">
                    <img src="{{ asset('img/logonegro.png') }}" class="w-50">
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
