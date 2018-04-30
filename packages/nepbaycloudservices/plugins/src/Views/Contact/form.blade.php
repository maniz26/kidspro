<div class="InnerPage">
  <div class="container">
    <h1> <span></span>Contact Us</h1>
    <div class="ContactPage">

      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

     @if(session('message'))
      <div class="alert alert-success">{{session('message')}}</div>
    @endif
      <form method="post" name="domflight" id="domflight" action="{{route('frontend.contactus.send')}}">
        {{csrf_field()}}
        <input type="hidden" name="subject" value="Contact Us">
        <div class="row">
          <div class="col-md-6">
            <div class="ContactForm">
              <div class="form-group">
                <input type="text" name="fullname" class="form-control" placeholder="Full name" value="{{old('fullname')}}" required>
              </div>
              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email"  value="{{old('email')}}" required>
              </div>
              <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="Phone"  value="{{old('phone')}}" required>
              </div>
              <div class="form-group">
                <textarea name="message" placeholder="Message" class="form-control" rows="5">{{old('Message')}}</textarea>
              </div>
              <div class="form-group">
                <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary ncs-domflight-search BtnDefault">Send</button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="ContactInfo">
              <p class="Sales"> <strong>For Sales</strong><br>
                <a href="mailto:sales@summitair.com.np">sales@summitair.com.np</a></p>
              <p class="Billing"> <strong>For Billing</strong><br>
                <a href="mailto:billing@summitair.com.np">billing@summitair.com.np</a></p>
              <p class="Support"> <strong>For Support</strong><br>
                <a href="mailto:support@summitair.com.np">support@summitair.com.np</a> </p>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
