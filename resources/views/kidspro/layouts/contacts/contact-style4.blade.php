<!-- Section: inner-header -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x700">
  <div class="container pt-70 pb-20">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
        <div class="col-md-6">
          <h2 class="text-theme-color-yellow font-36">Contact</h2>
          <ol class="breadcrumb text-left mt-10">
            <li><a href="#">Home</a></li>
            <li><a href="#">Pages</a></li>
            <li class="active text-white">Contact</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section: Have Any Question -->
<section class="divider">
  <div class="container pt-60 pb-60">
    <div class="section-title mb-60">
      <div class="row">
        <div class="col-md-12">
          <div class="esc-heading small-border text-center">
            <h3>Have any Questions?</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="section-content">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="contact-info text-center">
            <i class="fa fa-phone font-36 mb-10 text-theme-color-red"></i>
            <h4>Call Us</h4>
            <h6 class="text-gray">Phone: +262 695 2601</h6>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="contact-info text-center">
            <i class="fa fa-map-marker font-36 mb-10 text-theme-color-blue"></i>
            <h4>Address</h4>
            <h6 class="text-gray">121 King Street, Australia</h6>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="contact-info text-center">
            <i class="fa fa-envelope font-36 mb-10 text-theme-color-sky"></i>
            <h4>Email</h4>
            <h6 class="text-gray">you@yourdomain.com</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Divider: Contact -->
<section class="divider bg-lighter">
  <div class="container">
    <div class="row pt-30">
      <div class="col-md-7">
        <h3 class="line-bottom mt-0 mb-30">Interested in discussing?</h3>

        <!-- Google reCAPTCHA -->
        <script src="https://www.google.com/recaptcha/api.js"></script>

        <!-- Contact Form -->
        <form id="contact_form" name="contact_form" class="" action="includes/sendmail-recaptcha.php" method="post">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Name <small>*</small></label>
                <input name="form_name" class="form-control" type="text" placeholder="Enter Name" required="">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Email <small>*</small></label>
                <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Subject <small>*</small></label>
                <input name="form_subject" class="form-control required" type="text" placeholder="Enter Subject">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Phone</label>
                <input name="form_phone" class="form-control" type="text" placeholder="Enter Phone">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea name="form_message" class="form-control required" rows="5" placeholder="Enter Message"></textarea>
          </div>
          <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LcFfhAUAAAAAM-OQbebKGpCxrT_-xkr_rEVXCfu"></div>
          </div>
          <div class="form-group">
            <input name="form_botcheck" class="form-control" type="hidden" value="" />
            <button type="submit" name="submit" class="btn btn-dark btn-theme-color-sky btn-flat" data-loading-text="Please wait...">Send your message</button>
          </div>
        </form>
        <!-- Contact Form Validation-->
        <script type="text/javascript">
            $("#contact_form").validate({
                submitHandler: function(form) {
                    var form_btn = $(form).find('button[type="submit"]');
                    var form_result_div = '#form-result';
                    $(form_result_div).remove();
                    form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                    var form_btn_old_msg = form_btn.html();
                    form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                    $(form).ajaxSubmit({
                        dataType:  'json',
                        success: function(data) {
                            if( data.status == 'true' ) {
                                $(form).find('.form-control').val('');
                            }
                            form_btn.prop('disabled', false).html(form_btn_old_msg);
                            $(form_result_div).html(data.message).fadeIn('slow');
                            setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                        }
                    });
                }
            });
        </script>

      </div>
      <div class="col-md-5">

        <!-- Google Map HTML Codes -->
        <div
                data-address="121 King Street, Melbourne Victoria 3000 Australia"
                data-popupstring-id="#popupstring1"
                class="map-canvas autoload-map"
                data-mapstyle="style2"
                data-height="500"
                data-latlng="-37.817314,144.955431"
                data-title="sample title"
                data-zoom="12"
                data-marker="images/map-marker.png">
        </div>
        <div class="map-popupstring hidden" id="popupstring1">
          <div class="text-center">
            <h3>ThemeMascot Office</h3>
            <p>121 King Street, Melbourne Victoria 3000 Australia</p>
          </div>
        </div>
        <!-- Google Map Javascript Codes -->
        <script src="http://maps.google.com/maps/api/js?key=AIzaSyAYWE4mHmR9GyPsHSOVZrSCOOljk8DU9B4"></script>
        <script src="js/google-map-init.js"></script>

      </div>
    </div>
  </div>
</section>