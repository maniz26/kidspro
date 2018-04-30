
<!-- Footer -->
<footer id="footer" class="footer pb-0" data-bg-img="images/footer-bg.png" data-bg-color="#262E3B">
  <div class="container pt-60 pb-30">
    <div class="row multi-row-clearfix">
      <div class="col-sm-6 col-md-3">
        <div class="widget dark">
          <h5 class="widget-title line-bottom">Photos from Flickr</h5>
          <div id="flickr-feed" class="clearfix">
            <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=9&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=52617155@N08">
            </script>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="widget dark">
          <h5 class="widget-title line-bottom">Quick Contact</h5>
          <form id="footer_quick_contact_form" name="footer_quick_contact_form" class="quick-contact-form" action="includes/quickcontact.php" method="post">
            <div class="form-group">
              <input name="form_email" class="form-control" type="text" required="" placeholder="Enter Email">
            </div>
            <div class="form-group">
              <textarea name="form_message" class="form-control" required="" placeholder="Enter Message" rows="3"></textarea>
            </div>
            <div class="form-group">
              <input name="form_botcheck" class="form-control" type="hidden" value="" />
              <button type="submit" class="btn btn-default btn-transparent text-gray btn-xs btn-flat mt-0" data-loading-text="Please wait...">Send Message</button>
            </div>
          </form>

          <!-- Quick Contact Form Validation-->
          <script type="text/javascript">
              $("#footer_quick_contact_form").validate({
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
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="widget dark">
          <h5 class="widget-title line-bottom">Latest News</h5>
          <div class="latest-posts">
            <article class="post media-post clearfix pb-0 mb-10">
              <a class="post-thumb" href="#"><img src="https://placehold.it/80x55" alt=""></a>
              <div class="post-right">
                <h5 class="post-title mt-0 mb-5"><a href="#">Sustainable Construction</a></h5>
                <p class="post-date mb-0 font-12">Mar 08, 2015</p>
              </div>
            </article>
            <article class="post media-post clearfix pb-0 mb-10">
              <a class="post-thumb" href="#"><img src="https://placehold.it/80x55" alt=""></a>
              <div class="post-right">
                <h5 class="post-title mt-0 mb-5"><a href="#">Industrial Coatings</a></h5>
                <p class="post-date mb-0 font-12">Mar 08, 2015</p>
              </div>
            </article>
            <article class="post media-post clearfix pb-0 mb-10">
              <a class="post-thumb" href="#"><img src="https://placehold.it/80x55" alt=""></a>
              <div class="post-right">
                <h5 class="post-title mt-0 mb-5"><a href="#">Storefront Installations</a></h5>
                <p class="post-date mb-0 font-12">Mar 08, 2015</p>
              </div>
            </article>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="widget dark"> <img alt="" src="images/logo-wide-white-footer.png">
          <p class="font-12 mt-10 mb-10">Medinova is a library of corporate and business templates with predefined web elements which helps you to build your own site.</p>
          <a class="btn btn-default btn-transparent btn-xs btn-flat mt-5" href="#">Read more</a>
          <ul class="styled-icons icon-sm icon-bordered icon-circled clearfix mt-20">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="horizontal-contact-widget mt-30 pt-30 text-center">
          <div class="col-sm-12 col-sm-4">
            <div class="each-widget"> <i class="pe-7s-phone font-36 mb-10"></i>
              <h5 class="text-white">Call Us</h5>
              <p>Phone: <a href="#">+262 695 2601</a></p>
            </div>
          </div>
          <div class="col-sm-12 col-sm-4 mt-sm-50">
            <div class="each-widget"> <i class="pe-7s-map font-36 mb-10"></i>
              <h5 class="text-white">Address</h5>
              <p>121 King Street, Australia</p>
            </div>
          </div>
          <div class="col-sm-12 col-sm-4 mt-sm-50">
            <div class="each-widget"> <i class="pe-7s-mail font-36 mb-10"></i>
              <h5 class="text-white">Email</h5>
              <p><a href="#">you@yourdomain.com</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <ul class="list-inline styled-icons icon-hover-theme-color-sky icon-gray icon-circled text-center mt-30 mb-10">
          <li><a href="#"><i class="fa fa-facebook"></i></a> </li>
          <li><a href="#"><i class="fa fa-twitter"></i></a> </li>
          <li><a href="#"><i class="fa fa-pinterest"></i></a> </li>
          <li><a href="#"><i class="fa fa-google-plus"></i></a> </li>
          <li><a href="#"><i class="fa fa-youtube"></i></a> </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="container-fluid bg-theme-color-sky p-20">
    <div class="row text-center">
      <div class="col-md-12">
        <p class="text-white font-11 m-0">Copyright &copy;2015 ThemeMascot. All Rights Reserved</p>
      </div>
    </div>
  </div>
</footer>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>