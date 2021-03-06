<script src="/kidspro/js/bootstrap.min.js"></script>
<script src="/kidspro/js/jquery-ui.min.js"></script>
<script src="/kidspro/js/jquery-2.2.4.min.js"></script>
<script src="/kidspro/js/jquery-plugin-collection.js"></script>

<body class="vertical-nav">
<div id="wrapper">
    <!-- preloader -->
    <div id="preloader">
        <div id="spinner">
            <div class="preloader-dot-loading">
                <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
            </div>
        </div>
        <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
    </div>

    <!-- Header -->
    <header id="header" class="header layer-overlay overlay-dark-deep" data-bg-color="#333">
        <div class="header-nav">
            <div class="header-nav-wrapper">
                <div class="container-fluid p-0">
                    <div id="menuzord-verticalnav" class="menuzord">
                        <a class="menuzord-brand p-30" href="javascript:void(0)"><img width="165px" alt="logo" src="/kidspro/images/logo-wide-white.png"></a>
                        <ul class="menuzord-menu dark">
                            <!-- Main Nav -->
                            {!! Packagebridge::position('position-1',$params) !!}
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <div class="vertical-nav-widget p-30 pt-10">
                        <div class="widget no-border">
                            <ul>
                                <li class="font-14 mb-5"> <i class="fa fa-phone text-theme-color-2"></i> <a class="text-gray" href="#">123-456-789</a> </li>
                                <li class="font-14 mb-5"> <i class="fa fa-clock-o text-theme-color-2"></i> Mon-Fri 8:00 to 2:00 </li>
                                <li class="font-14 mb-5"> <i class="fa fa-envelope-o text-theme-color-2"></i> <a class="text-gray" href="#">contact@yourdomain.com</a> </li>
                            </ul>
                        </div>
                        <div class="widget">
                            <ul class="styled-icons icon-dark icon-theme-colored icon-sm">
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                        </div>
                        <p>Copyright &copy;2016 ThemeMascot</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{--<!-- Footer -->--}}
    {{--<footer id="footer" class="footer divider layer-overlay overlay-dark-9" data-bg-color="#1f1f1f">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-6 col-md-offset-3 text-center">--}}
                    {{--<img src="images/logo-white-footer.png" alt="">--}}
                    {{--<p class="font-12 mt-20 mb-20">NextEvent is a library of corporate and business templates with predefined web elements which helps you to build your own site. Lorem ipsum dolor sit amet elit.</p>--}}
                    {{--<ul class="styled-icons flat medium list-inline mb-40">--}}
                        {{--<li><a href="#"><i class="fa fa-facebook"></i></a> </li>--}}
                        {{--<li><a href="#"><i class="fa fa-twitter"></i></a> </li>--}}
                        {{--<li><a href="#"><i class="fa fa-pinterest"></i></a> </li>--}}
                        {{--<li><a href="#"><i class="fa fa-google-plus"></i></a> </li>--}}
                        {{--<li><a href="#"><i class="fa fa-youtube"></i></a> </li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col-sm-6 col-md-3">--}}
                    {{--<div class="widget dark">--}}
                        {{--<h4 class="widget-title line-bottom-theme-colored-2">Opening Hours</h4>--}}
                        {{--<div class="opening-hours">--}}
                            {{--<ul class="list-border">--}}
                                {{--<li class="clearfix"> <span> Mon - Tues :  </span>--}}
                                    {{--<div class="value pull-right"> 6.00 am - 10.00 pm </div>--}}
                                {{--</li>--}}
                                {{--<li class="clearfix"> <span> Wednes - Thurs :</span>--}}
                                    {{--<div class="value pull-right"> 8.00 am - 6.00 pm </div>--}}
                                {{--</li>--}}
                                {{--<li class="clearfix"> <span> Fri : </span>--}}
                                    {{--<div class="value pull-right"> 3.00 pm - 8.00 pm </div>--}}
                                {{--</li>--}}
                                {{--<li class="clearfix"> <span> Sun : </span>--}}
                                    {{--<div class="value pull-right"> Closed </div>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-sm-6 col-md-3">--}}
                    {{--<div class="widget dark">--}}
                        {{--<h4 class="widget-title">Useful Links</h4>--}}
                        {{--<ul class="list angle-double-right list-border">--}}
                            {{--<li><a href="page-about-style1.html">About Us</a></li>--}}
                            {{--<li><a href="page-course-list.html">Our Courses</a></li>--}}
                            {{--<li><a href="page-pricing-style1.html">Pricing Table</a></li>--}}
                            {{--<li><a href="page-gallery-3col.html">Gallery</a></li>--}}
                            {{--<li><a href="shop-category.html">Shop</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-sm-6 col-md-3">--}}
                    {{--<div class="widget dark">--}}
                        {{--<h5 class="widget-title">Tags</h5>--}}
                        {{--<div class="tags">--}}
                            {{--<a href="#">academy</a>--}}
                            {{--<a href="#">education</a>--}}
                            {{--<a href="#">courses</a>--}}
                            {{--<a href="#">courte</a>--}}
                            {{--<a href="#">elearning</a>--}}
                            {{--<a href="#">learning</a>--}}
                            {{--<a href="#">management</a>--}}
                            {{--<a href="#">success</a>--}}
                            {{--<a href="#">campus</a>--}}
                            {{--<a href="#">university</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-sm-6 col-md-3">--}}
                    {{--<div class="widget dark">--}}
                        {{--<h4 class="widget-title line-bottom-theme-colored-2">Quick Contact</h4>--}}
                        {{--<form id="quick_contact_form2" name="footer_quick_contact_form" class="quick-contact-form" action="includes/quickcontact.php" method="post">--}}
                            {{--<div class="form-group">--}}
                                {{--<input name="form_email" class="form-control" type="text" required="" placeholder="Enter Email">--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<textarea name="form_message" class="form-control" required="" placeholder="Enter Message" rows="3"></textarea>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<input name="form_botcheck" class="form-control" type="hidden" value="" />--}}
                                {{--<button type="submit" class="btn btn-default btn-flat btn-xs btn-quick-contact text-gray pt-5 pb-5" data-loading-text="Please wait...">Send Message</button>--}}
                            {{--</div>--}}
                        {{--</form>--}}

                        {{--<!-- Quick Contact Form Validation-->--}}
                        {{--<script type="text/javascript">--}}
                            {{--$("#quick_contact_form2").validate({--}}
                                {{--submitHandler: function(form) {--}}
                                    {{--var form_btn = $(form).find('button[type="submit"]');--}}
                                    {{--var form_result_div = '#form-result';--}}
                                    {{--$(form_result_div).remove();--}}
                                    {{--form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');--}}
                                    {{--var form_btn_old_msg = form_btn.html();--}}
                                    {{--form_btn.html(form_btn.prop('disabled', true).data("loading-text"));--}}
                                    {{--$(form).ajaxSubmit({--}}
                                        {{--dataType:  'json',--}}
                                        {{--success: function(data) {--}}
                                            {{--if( data.status == 'true' ) {--}}
                                                {{--$(form).find('.form-control').val('');--}}
                                            {{--}--}}
                                            {{--form_btn.prop('disabled', false).html(form_btn_old_msg);--}}
                                            {{--$(form_result_div).html(data.message).fadeIn('slow');--}}
                                            {{--setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);--}}
                                        {{--}--}}
                                    {{--});--}}
                                {{--}--}}
                            {{--});--}}
                        {{--</script>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="footer-bottom" data-bg-color="#2f2f2f">--}}
            {{--<div class="container pt-15 pb-10">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<p class="font-11 text-black-777 m-0">Copyright &copy;2016 ThemeMascot. All Rights Reserved</p>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6 text-right">--}}
                        {{--<div class="widget no-border m-0">--}}
                            {{--<ul class="list-inline sm-text-center mt-5 font-12">--}}
                                {{--<li>--}}
                                    {{--<a href="#">FAQ</a>--}}
                                {{--</li>--}}
                                {{--<li>|</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">Help Desk</a>--}}
                                {{--</li>--}}
                                {{--<li>|</li>--}}
                                {{--<li>--}}
                                    {{--<a href="#">Support</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</footer>--}}
    {{--<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>--}}
</div>
<script src="/kidspro/js/custom.js"></script>
