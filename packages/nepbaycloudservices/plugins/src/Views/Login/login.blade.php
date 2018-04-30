
<div class="ArticlePage Loginpage">





  <div class="container">
  
  @if (session('status'))
<div class="alert alert-success"> {{ session('status') }} </div>
@endif



@if (session('login_required'))
<div class="alert alert-danger"> {{ session('login_required') }} </div>
@endif



@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif


  
    <h1><span></span> Login / Register</h1>
    <div class="row">
      <div class="col-md-5">
        <div class="Loginform Curve5">
          <h2>Login (Existing User)</h2>
          <form action="{{route('frontend.login')}}" method="post">
            {{ csrf_field() }}
            
            @if( $redirectUrl = session('redirectUrl') )
            <input type="hidden" name="redirect" value="{{session('redirectUrl')}}">
            @endif
            <div class="form-groupi{{ $errors->has('email') ? ' has-error' : '' }}"> <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i> </span>
              <input type="text" class="form-control" placeholder="Email" name="email"  value="{{ old('email') }}"  required autofocus />
              @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif </div>
            <div class="form-groupi{{ $errors->has('password') ? ' has-error' : '' }}"> <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i> </span>
              <input type="password" class="form-control" placeholder="Password" name="password" equired />
              @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif </div>
            <div class="CBox">
              <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary BtnDefault">Sign In</button>
            <p> <a href="#"  data-dismiss="modal" data-toggle="modal" data-target="#ForgetPasswordformModal">Lost your password?</a></p>
          </form>
          <div class="SocialHolder">
            <h3>Login from</h3>
            <a href="{{ route('frontend.provider.login','facebook') }}" class="btn facebook btn-block"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a> <a href="{{ route('frontend.provider.login','twitter') }}" class="btn twitter btn-block"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a> <a href="{{ route('frontend.provider.login','google') }}" class="btn google btn-block"><i class="fa fa-google" aria-hidden="true"></i>Google+</a></div>
        </div>
      </div>
      <div class="col-md-1 Orouter"> <span>Or</span> </div>
      <div class="col-md-6">
        <div class="Registerform Curve5">
          <h2>Register (New User)</h2>
          <form method="post" action="{{ route('frontend.register') }}">
            {{ csrf_field() }}
            
            @if( $redirectUrl = session('redirectUrl') )
            <input type="hidden" name="redirect" value="{{session('redirectUrl')}}">
            @endif
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="First Name" name="firstname" value="{{ old('firstname') }}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Last name" name="lastname" value="{{ old('lastname') }}" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Confirm Email" name="confirm_email" value="{{ old('email') }}" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Password" name="password" required>
                  @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                </div>
              </div>
            </div>
            <div class="CBoxs">
              <label>
                <input type="checkbox" name="terms"  {{ old('terms') ? 'checked' : '' }}>
                I accept <a href="#" data-toggle="modal" data-target="#termscondModal"> Terms and Coditions</a> </label>
            </div>
            <button class="btn btn-primary BtnDefault" type="submit">Create My Account</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="ForgetPasswordform">
  <div class="modal fade" id="ForgetPasswordformModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <form action="{{route('frontend.password.email')}}" method="post">
          {{ csrf_field() }}
          <div class="modal-body">
            <div class="form-group">
              <input type="email" class="form-control" placeholder="Email" name="email" required>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Send Password Reset Link</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
