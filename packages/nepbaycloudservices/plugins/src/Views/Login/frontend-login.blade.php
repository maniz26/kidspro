<div class="col-md-2 Login">
  
  @if ( !Auth::guard('user')->check() ) 
  <ul class="list-inline LoginRegister">
    <li class="list-inline-item LoginSua"><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
    <li class="list-inline-item RegisterAir"><a href="#" data-toggle="modal" data-target="#RegisterformMyModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a></li>
  </ul>
  @else
  <!-- =======================================Login Admin============================ -->
  
  <div class="LoginAdmin">
    <button class="dropbtn">Hi!  {{Auth::guard('user')->user()->name}}</button>
    <div class="dropdown-content">
      <a href="{{route('frontend.my.profile')}}">Edit Profile</a>
      <a href="{{route('domflight.mybooking')}}">My Booking</a>
      <a href="{{route('frontend.logout')}}">Log Out</a>
    </div>
    
  </div>
  @endif

  <!-- =====================================Login Form=================================== -->
  <div class="LoginForm">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="loginform" class="form-horizontal" action="{{route('frontend.login')}}" method="post">
               {{ csrf_field() }}
                @if( $redirectUrl = session('redirectUrl') )
                <input type="hidden" name="redirect" value="{{session('redirectUrl')}}">
              @endif
              <div class="row">
                <div class="col-md-6 LoginBorder">
                  <ul class="SocailLogin">
                    <li class="facebookLogin"><a href="{{ route('frontend.provider.login','facebook') }}"><i class="fa fa-facebook" aria-hidden="true"></i> Login with facebook</a></li>
                    <li class="TwitterLogin"><a href="{{ route('frontend.provider.login','twitter') }}"><i class="fa fa-twitter" aria-hidden="true"></i>  Login with twitter</a></li>
                    <li class="GoogleplusLogin"><a href="{{ route('frontend.provider.login','google') }}"><i class="fa fa-google-plus" aria-hidden="true"></i> Login with google+</a></li>
                  </ul>
                  
                  <!-- Lost Your Password -->
                  <div class="input-group LostPassword">
                    <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#PasswordResetformModal">Lost your password?</a>
                  </div>
                  <!-- Sign Up here -->
                  <div class="form-group">
                    <div class="control">
                      <div class="SignUpHere">
                        Don't have an account!
                        <a href="#" data-toggle="modal" data-target="#RegisterformMyModal">
                          Sign Up Here
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 LoginBorder">
                  <div class="form-group">
                    <input id="login-username" type="text" class="form-control" name="email" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <input id="login-password" type="password" class="form-control" name="password" placeholder="Password" required>
                  </div>
                  <div class="input-group">
                    <div class="RememberBox">
                      <label>
                        <input id="login-remember" type="checkbox" name="remember" value="Remember"> Remember me
                      </label>
                    </div>
                  </div>
                  
                  <div class="form-group SignInH">
                    <button type="summit" class="btn btn-labeled btn-warning"> <span class="btn-label"><i class="fa fa-sign-in" aria-hidden="true"></i> </span>Sign In</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- =====================================Register Form=================================== -->
  <div class="RegisterformAir">
    <div class="modal fade" id="RegisterformMyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Register</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
          </div>
          <form action="{{route('frontend.register')}}" method="post" >
              {{ csrf_field() }}
               @if( $redirectUrl = session('redirectUrl') )
                <input type="hidden" name="redirect" value="{{session('redirectUrl')}}">
              @endif
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" placeholder="First Name" name="firstname" required type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" placeholder="Last Name" name="lastname" required type="text">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" placeholder="Email" name="email" required type="email">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" placeholder="Confirm Email" name="email_confirmation" required type="email">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Password" name="password" required type="password">
              </div>

              <div class="form-group">
                <input class="form-control" placeholder="Confirm Password" name="password_confirmation" required type="password">
              </div>
              
              <div class="Terms_conditions">
                <label>
                  <input name="terms" type="checkbox">
                  I accept <a href="#" data-toggle="modal" data-target="#termscondModal"> Terms and Conditions</a> </label>
                </div>
              </div>
              <div class="modal-footer CreateAccount">
                <button class="btn btn-danger" type="submit">Create My Account</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- =====================================Password & Reset========================================= -->
    <div class="PasswordResetForm">
      <div class="modal fade" id="PasswordResetformModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <form action="" method="post">
              <div class="modal-body">
                
                <div class="form-group">
                  <input class="form-control" placeholder="Email" name="email" required type="email">
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
  </div>



    <!-- =====================================Terms & Cond ========================================= -->
    <div class="TermsnCondtion">
      <div class="modal fade" id="termscondModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <form action="" method="post">
              <div class="modal-body">
                <ul>
                    <li>
                        If the pax wish to cancel their tickets, cancellation Charge will be applicable.  Cancellation charge will be as follows :
                        <ul>
                            <li>24 hours before : 10% of the fare</li>
                            <li>One hour before the flight time : 33% of the fare</li>
                            <li>Within one hour : No show of the ticket.</li>
                        </ul>
                    </li>
                    <li>If the flight cancel due weather, Airline will try to adjust in next day flights as far as possible but if can not adjust the passenger will be given full refund.</li>
                    <li>No cash refund will be done.  Once the Refund process being done, the refund amount will be automatically credited in your account.</li>
                </ul>
                
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>