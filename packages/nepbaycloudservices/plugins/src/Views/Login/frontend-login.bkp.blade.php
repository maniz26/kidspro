<div class="Logreg Curve5">
  <ul>
    @if ( !Auth::guard('user')->check() )     
    <li><a> {!! __('plugins::login.login') !!}   /   {!! __('plugins::login.register') !!}</a>
    @else
    <li><a>{!! __('plugins::login.hi') !!}! {{Auth::guard('user')->user()->name}}</a>
    @endif
    <ul>
       @if ( !Auth::guard('user')->check() ) 
      <li><a href="#" data-toggle="modal" data-target="#SignUpformModal">{!! __('plugins::login.sign_in') !!}</a></li>
      <li><a href="#" data-toggle="modal" data-target="#RegisterformModal">{!! __('plugins::login.sign_up') !!}</a></li>
      @else
      <li><a href="{{route('user.profile.edit')}}">{!! __('plugins::login.edit_profile') !!}</a></li>
      <li><a href="{{route('frontend.myads')}}">{!! __('plugins::login.my_posts') !!}</a></li>
      <li><a href="{{route('frontend.logout')}}">{!! __('plugins::login.log_out') !!}</a></li>
      @endif
    </ul>
  </li>
</ul>
</div>
<div class="Submitad Curve5"><a href="{{route('frontend.post.create')}}">{!! __('plugins::login.submit_your_ad') !!}</a></div>
@if ( !Auth::guard('user')->check() )  
<!-- Login Up -->
<div class="Loginform">
<div class="modal fade" id="SignUpformModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{!! __('plugins::login.login') !!}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <form action="{{route('frontend.login')}}" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 login-box separator">
              {{ csrf_field() }}
              <div class="form-groupi"> <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i> </span>
              <input type="text" class="form-control" placeholder="{!! __('plugins::login.placeholders.email') !!}" name="email" required autofocus />
            </div>
            <div class="form-groupi"> <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i> </span>
            <input type="password" class="form-control" placeholder="{!! __('plugins::login.placeholders.password') !!}" name="password" required />
          </div>
          <p> <a href="#"  data-dismiss="modal" data-toggle="modal" data-target="#ForgetPasswordformModal">{!! __('plugins::login.lost_your_password') !!}?</a><br>
          {!! __('plugins::login.dont_have_an_account') !!}? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#RegisterformModal">{!! __('plugins::login.sign_up_here') !!}</a></p>
          
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6  social-login-box"> <br />
          <a href="{{ route('frontend.provider.login','facebook') }}" class="btn facebook btn-block jq-btn-social-login"><i class="fa fa-facebook" aria-hidden="true"></i>{!! __('plugins::login.login_facebook') !!}</a>
          <a href="{{ route('frontend.provider.login','twitter') }}" class="btn twitter btn-block"><i class="fa fa-twitter" aria-hidden="true"></i>{!! __('plugins::login.login_twitter') !!}</a>
          <a href="{{ route('frontend.provider.login','google') }}" class="btn google btn-block"><i class="fa fa-google-plus" aria-hidden="true"></i>{!! __('plugins::login.login_google') !!}</a> </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-sm-6 col-md-6">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="Remember" name="remember">
              {!! __('plugins::login.remember') !!} </label>
            </div>
          </div>
          <div class="col-sm-6 col-md-6">
            <button type="summit" class="btn btn-labeled btn-success"> <span class="btn-label" ><i class="fa fa-sign-in" aria-hidden="true"></i> </span>{!! __('plugins::login.sign_in') !!}</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
</div>
<div class="Registerform">
<div class="modal fade" id="RegisterformModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{!! __('plugins::login.register') !!}</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
    </div>
    <form action="{{route('frontend.register')}}" method="post">
      {{ csrf_field() }}
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="{!! __('plugins::login.placeholders.firstname') !!}" name="firstname" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="{!! __('plugins::login.placeholders.lastname') !!}" name="lastname" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <input type="email" class="form-control" placeholder="{!! __('plugins::login.placeholders.email') !!}" name="email" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="{!! __('plugins::login.placeholders.password') !!}" name="password" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="{!! __('plugins::login.placeholders.confirm_password') !!}" name="password_confirmation" required>
        </div>
        
        <div class="CBox">
          <label>
            <input type="checkbox" name="terms">
            {!! __('plugins::login.accept') !!} <a href="#"> {!! __('plugins::login.terms_condition') !!}</a> </label>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">{!! __('plugins::login.create_account') !!}</button>
        </div>
      </form>
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
            <input type="email" class="form-control" placeholder="{!! __('plugins::login.placeholders.email') !!}" name="email" required>
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
@endif