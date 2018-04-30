<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="{{asset('backendcp/assets/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backendcp/assets/css/style.css')}}" rel="stylesheet">    
    @yield('header-scripts')
</head>

<body>

    <div class="content-wrap">
            
        <div class="main">
           @yield('content')
        </div>
    </div>
    <script src="{{asset('backendcp/assets/js/lib/jquery.min.js')}}"></script>
    <script src="{{asset('backendcp/assets/js/lib/bootstrap.min.js')}}"></script>
    @yield('footer-scripts')
</body>
</html>
