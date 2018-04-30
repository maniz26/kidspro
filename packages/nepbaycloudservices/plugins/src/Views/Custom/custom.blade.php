<div class="HomeArticle">
  <div class="container">
    <div class="row">
      <div class="col-md-4 Customersupport">
        <div class="ArticleBox"> <span class="RightIcon"></span>
        <h2 class="Support">Customer Support</h2>
        <div class="Info">We have amazing customer support, that is loved by Tens of Thousands of our satisfied passengers.
        and typesetting industry.</div>
        <div class="BtnLinks"> <div href="#" class="ShowHide CallUsdiv"><span class="BorderTop"> <i> &nbsp; </i>Call Us</span>
          <div class="Innerdiv">  
          <ul>
            <li> <a href="tel:+977-1-4117524"> <i class="fa fa-phone-square" aria-hidden="true"></i> +977-1-4117524</a> </li>
            <li> <a href="tel:+977-1-4117523"><i class="fa fa-phone-square" aria-hidden="true"></i> +977-1-4117523</a></li>
            <li> <a href="tel:+977-1-5199097"><i class="fa fa-phone-square" aria-hidden="true"></i> +977-1-5199097</a></li>
          </ul>
        </div>
        </div>  <div href="#" class="ShowHide EmailUs">
        
        <span class="BorderTop"> <i> &nbsp; </i>Email Us</span>
        <div class="Innerdiv">  
        <ul>
          <li><a href="mailto:sales@summitair.com.np"> <i class="fa fa-envelope" aria-hidden="true"></i> sales@summitair.com.np</a></li>
          <li> <i class="fa fa-envelope" aria-hidden="true"></i> booking@summitair.com.np</li>
          <li> <i class="fa fa-envelope" aria-hidden="true"></i> contact@summitair.com.np</li>
        </ul>
      </div>
      </div>   <div href="#" class="ShowHide RequestSupport"> <span class="BorderTop"> <i> &nbsp; </i>Request a Support</span>
      <div class="Innerdiv"> 
      <form method="post" action="{{route('frontend.contactus.send')}}">
        {{csrf_field()}}
        <input type="hidden" name="subject" value="Custom Experience">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Full Name" name="fullname">
        </div>
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Email" name="email">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Phone" max="phone">
        </div>
        <div class="form-group">
          <textarea class="form-control" rows="2" name="message" placeholder="Message"></textarea>
        </div>
        <div class="form-group">
                <div class="g-recaptcha" data-theme="light" style="transform:scale(0.93);-webkit-transform:scale(0.93);transform-origin:0 0;-webkit-transform-origin:0 0;" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
        </div>
        <button type="submit" class="btn btn-primary BtnDefault">Submit</button>
      </form>
    </div>
  </div></div>
</div>
</div>
<div class="col-md-4">
<div class="ArticleBox"> <span class="RightIcon"></span>
<h2 class="Safe">Safe and Secure</h2>
<div class="Info">Flying with Summit Air gives you feeling of safety in these harsher environment of Himalayas.
</div>
<div class="BtnLinks"><a href="{{url('safety-precautions')}}">Safety Precautions</a> <span>|</span> <a href="{{url('mountain-guidelines')}}">Mountain Guidelines</a> <span>|</span> <a href="{{url('our-promises')}}">Our Promises</a></div>
</div>
</div>
<div class="col-md-4">
<div class="ArticleBox"> <span class="RightIcon"></span>
<h2 class="Trust">Trusted by Many</h2>
<div class="Info">Every year Tens of Thousands of travelers from all around the globe chooses Summit Air for their journey in the Himalayas.
</div>
<div class="BtnLinks"><a href="{{url('customer-experiences')}}">Customer Experiences</a> <span>|</span> <a href="{{route('frontend.experience')}}">Submit Your Experience</a></div> </div>
</div>
</div>
</div>
</div>