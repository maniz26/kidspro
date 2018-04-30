<!-- Footer -->
<footer id="footer" class="footer" data-bg-img="images/footer-bg.png" data-bg-color="#262E3B">
  <div class="container pt-70 pb-40">
    <div class="row multi-row-clearfix">
      <div class="col-md-6 col-md-offset-3 text-center">
        <img alt="" src="images/logo-wide-white-footer.png">
        <p class="font-12 mt-20 mb-60">NextEvent is a library of corporate and business templates with predefined web elements which helps you to build your own site. Lorem ipsum dolor sit amet elit.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="widget dark">
          <h5 class="widget-title line-bottom">Company Info</h5>
          <div class="text-widget">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt distinctio soluta corporis, omnis odit libero ad laborum illum, nam, accusamus nihil cumque magnam voluptatibus eos odio ratione mollitia.</p>
          </div>
          <ul class="styled-icons icon-sm icon-bordered icon-circled clearfix mt-20">
            <li><a href="#"><i class="fa fa-facebook"></i></a> </li>
            <li><a href="#"><i class="fa fa-twitter"></i></a> </li>
            <li><a href="#"><i class="fa fa-pinterest"></i></a> </li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a> </li>
          </ul>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="widget dark">
          <h5 class="widget-title line-bottom">Archives</h5>
          <ul class="list list-divider list-border">
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Charity Work</a></li>
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Helping Poor</a></li>
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Supply Pure Water</a></li>
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Education for Poor</a></li>
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Save The Children</a></li>
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Home for Homeless</a></li>
          </ul>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="widget dark">
          <h5 class="widget-title line-bottom">Pages</h5>
          <ul class="list list-border">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Experts</a></li>
            <li><a href="#">Gallery</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
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
              <button type="submit" class="btn btn-default btn-transparent btn-xs btn-flat mt-0" data-loading-text="Please wait...">Send Message</button>
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
    </div>
  </div>
  <div class="footer-bottom" data-bg-color="#242730">
    <div class="container pt-15 pb-15">
      <div class="row">
        <div class="col-md-6">
          <p class="font-12 text-black-777 m-0 sm-text-center">Copyright &copy;2017 ThemeMascot. All Rights Reserved</p>
        </div>
        <div class="col-md-6 text-right">
          <div class="widget no-border m-0">
            <ul class="list-inline sm-text-center font-12">
              <li>
                <a href="#">FAQ</a>
              </li>
              <li>|</li>
              <li>
                <a href="#">Help Desk</a>
              </li>
              <li>|</li>
              <li>
                <a href="#">Support</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>