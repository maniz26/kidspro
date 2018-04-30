<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <!-- Styles -->
    <link href="{{asset('backendcp/assets/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('backendcp/assets/css/lib/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('backendcp/assets/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backendcp/assets/css/lib/unix.css')}}" rel="stylesheet">
    <link href="{{asset('backendcp/assets/css/style.css')}}" rel="stylesheet">   

</head>

<body class="bg-primary">

    <div class="unix-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="{{route('admin.root')}}"><span>{{config('app.name')}}</span></a>
                        </div>
                        <div class="login-form">
                            <h4>Administratior Login</h4>
                            <form action="{{ route('admin.login') }}" method="post">
                            {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email address</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="checkbox">
                                    <label>
										<input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}> Remember Me
									</label>
                                    <!-- <label class="pull-right">
										<a href="{{route('admin.reset.password')}}">Forgotten Password?</a>
									</label> -->

                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                               
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>