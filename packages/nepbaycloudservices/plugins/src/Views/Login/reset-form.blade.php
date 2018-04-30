<div class="ForgetPasswordform">
  <div id="ForgetPasswordformModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
          
        </div>
        <form action="{{route('frontend.password.reset')}}" method="POST">
         {{ csrf_field() }} 
         <input type="hidden" name="token" value="{{ $token }}">
          <div class="modal-body">
           
            <div class="form-group">
              <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' has-error' : '' }}" placeholder="{!! __('plugins::site.login.placeholders.email') !!}" value="{{ $email or old('email') }}" required>
            </div>  

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <input type="password" name="password"  class="form-control" placeholder="{!! __('plugins::site.login.placeholders.password') !!}" required>
            </div>          
          

           <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <input type="password" name="password_confirmation" class="form-control" placeholder="{!! __('plugins::site.login.placeholders.confirm_password') !!}"  required>
            </div>          
          </div>

                   
          
          <div class="modal-footer">
            <button class="btn btn-primary" type="submit"> Reset Password</button>            
          </div>

        </form>
      </div>
    </div>
  </div>
</div>