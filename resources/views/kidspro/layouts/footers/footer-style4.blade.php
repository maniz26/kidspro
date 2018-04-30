<!-- Footer -->
<footer id="footer" class="footer" data-bg-img="images/footer-bg.png" data-bg-color="#262E3B">
  <div class="container pt-70 pb-40">
    <div class="row multi-row-clearfix">
      <div class="col-sm-6 col-md-3 col-lg-3">
        <div class="widget mb-20"> <img alt="" src="images/logo-wide-white-footer.png">
          <p class="font-12 mt-15 mb-10">Medinova is a library of corporate and business templates with predefined web elements which helps you to build your own site. lorem ipsum dolor is emit san dan pan kum sadra padra</p>
          <a class="btn btn-default btn-transparent btn-xs btn-flat mt-5" href="#">Read more</a>
        </div>
        <div class="widget dark">
          <div class="widget-subscribe mt-20">
            <h5 class="subscribe-title font-13 text-gray">Please enter your mailig address for being update yourself</h5>
            <form id="mailchimp-subscription-form" class="newsletter-form mt-10">
              <div class="input-group">
                <input type="email" id="mce-EMAIL" data-height="34px" class="form-control input-sm" placeholder="Your Email" name="EMAIL" value="">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-colored btn-theme-color-sky text-white btn-xs m-0" data-height="34px">Subscribe</button>
                  </span>
              </div>
            </form>

            <!-- Mailchimp Subscription Form Validation-->
            <script type="text/javascript">
                $('#mailchimp-subscription-form').ajaxChimp({
                    callback: mailChimpCallBack,
                    url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
                });

                function mailChimpCallBack(resp) {
                    // Hide any previous response text
                    var $mailchimpform = $('#mailchimp-subscription-form'),
                        $response = '';
                    $mailchimpform.children(".alert").remove();
                    if (resp.result === 'success') {
                        $response = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                    } else if (resp.result === 'error') {
                        $response = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + resp.msg + '</div>';
                    }
                    $mailchimpform.prepend($response);
                }
            </script>

          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 col-lg-3">
        <div class="widget dark">
          <h5 class="widget-title line-bottom">Archives</h5>
          <ul class="list list-divider list-border">
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Oil Changing</a></li>
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Engine Daignostic</a></li>
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Tire & Wheel Alignment</a></li>
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Body Coloring</a></li>
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Body Repairing</a></li>
            <li><a href="#"><i class="fa fa-check-square-o mr-10 text-black-light"></i> Air Condition</a></li>
          </ul>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 col-lg-3">
        <div class="widget dark">
          <h5 class="widget-title line-bottom">Twitter Feed</h5>
          <div class="twitter-feed list-border clearfix" data-username="Envato" data-count="2"></div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3 col-lg-3">
        <div class="widget dark">
          <h5 class="widget-title line-bottom">Opening Hours</h5>
          <div class="opening-hours">
            <ul class="list list-border">
              <li class="clearfix"> <span><i class="fa fa-clock-o mr-5"></i> Mond - Tuesday :</span>
                <div class="value pull-right"> 9.00 am - 10.00 pm </div>
              </li>
              <li class="clearfix"> <span class="text-theme-color-sky"><i class="fa fa-clock-o mr-5"></i> Wednes - Thurs </span>
                <div class="value pull-right text-white"> 10.00 am - 8.00 pm </div>
              </li>
              <li class="clearfix"> <span><i class="fa fa-clock-o mr-5"></i> Friday :</span>
                <div class="value pull-right"> 10.00 am - 6.00 pm </div>
              </li>
              <li class="clearfix"> <span><i class="fa fa-clock-o mr-5"></i> Saturday : </span>
                <div class="value pull-right"> 2.00 pm - 8.00 pm </div>
              </li>
              <li class="clearfix"> <span><i class="fa fa-clock-o mr-5"></i> Sunday :</span>
                <div class="value pull-right"> <span class="text-highlight bg-theme-color-sky text-white">Colsed</span>  </div>
              </li>
            </ul>
          </div>
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