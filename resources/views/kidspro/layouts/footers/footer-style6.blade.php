<!-- Footer -->
<footer id="footer" class="footer pb-0" data-bg-img="images/footer-bg.png" data-bg-color="#262E3B">
  <div class="container pt-60 pb-30">
    <div class="row multi-row-clearfix">
      <div class="col-sm-6 col-md-3">
        <div class="widget dark"> <img alt="" src="images/logo-wide-white-footer.png">
          <p class="font-12 mt-20 mb-10">Medinova is a library of Crowdfunding and Medinova templates with predefined elements which helps you to build your own site. Lorem ipsum dolor sit amet consectetur.</p>
          <a class="text-gray font-12" href="#"><i class="fa fa-angle-double-right text-theme-color-sky"></i> Read more</a>
          <ul class="styled-icons icon-dark mt-20">
            <li><a href="#" data-bg-color="#3B5998"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#" data-bg-color="#02B0E8"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#" data-bg-color="#05A7E3"><i class="fa fa-skype"></i></a></li>
            <li><a href="#" data-bg-color="#A11312"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#" data-bg-color="#C22E2A"><i class="fa fa-youtube"></i></a></li>
          </ul>
        </div>
      </div>
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
        <div class="widget dark">
          <h5 class="widget-title line-bottom">Quick Contact</h5>
          <ul class="list list-border">
            <li><a href="#">+(012) 345 6789</a></li>
            <li><a href="#">hello@yourdomain.com</a></li>
            <li><a href="#" class="lineheight-20">121 King Street, Melbourne Victoria 3000, Australia</a></li>
          </ul>
          <p class="mb-5 mt-15">Subscribe to our newsletter</p>
          <form id="footer-mailchimp-subscription-form" class="newsletter-form mt-10">
            <label class="display-block" for="mce-EMAIL"></label>
            <div class="input-group">
              <input type="email" value="" name="EMAIL" placeholder="Your Email"  class="form-control" data-height="38px" id="mce-EMAIL">
              <span class="input-group-btn">
                    <button type="submit" class="btn btn-colored btn-theme-color-sky font-14 m-0"><i class="fa fa-paper-plane-o text-white"></i></button>
                </span>
            </div>
          </form>
          <!-- Mailchimp Subscription Form Validation-->
          <script type="text/javascript">
              $('#footer-mailchimp-subscription-form').ajaxChimp({
                  callback: mailChimpCallBack,
                  url: '//thememascot.us9.list-manage.com/subscribe/post?u=a01f440178e35febc8cf4e51f&amp;id=49d6d30e1e'
              });

              function mailChimpCallBack(resp) {
                  // Hide any previous response text
                  var $mailchimpform = $('#footer-mailchimp-subscription-form'),
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