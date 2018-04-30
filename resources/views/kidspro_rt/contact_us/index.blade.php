
@extends('kidspro_rt.layouts.template')
<!-- Divider: Contact -->
@section('content')
<section class="divider">
    <div class="container pt-50 pb-70">
        <div class="row pt-10">
            <div class="col-md-5">
                <h4 class="mt-0 mb-30 line-bottom">Find Our Location</h4>
                <!-- Google Map HTML Codes -->
                <div
                        data-address="121 King Street, Melbourne Victoria 3000 Australia"
                        data-popupstring-id="#popupstring1"
                        class="map-canvas autoload-map"
                        data-mapstyle="style1"
                        data-height="390"
                        data-latlng="-37.817314,144.955431"
                        data-title="sample title"
                        data-zoom="12"
                        data-marker="images/map-marker.png">
                </div>
                <div class="map-popupstring hidden" id="popupstring1">
                    <div class="text-center">
                        <h3>CharityPress Office</h3>
                        <p>121 King Street, Melbourne Victoria 3000 Australia</p>
                    </div>
                </div>
                <!-- Google Map Javascript Codes -->
                <script src="http://maps.google.com/maps/api/js?key=AIzaSyAYWE4mHmR9GyPsHSOVZrSCOOljk8DU9B4"></script>
                <script src="{{asset('kidspro/js/google-map-init.js')}}"></script>
            </div>
            <div class="col-md-7">
                <h4 class="mt-0 mb-30 line-bottom">Interested in discussing?</h4>
                <!-- Contact Form -->
                <form id="contact_form" name="contact_form" class="" action="includes/sendmail.php" method="post">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-30">
                                <input id="form_name" name="form_name" class="form-control" type="text" placeholder="Enter Name" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-30">
                                <input id="form_email" name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-30">
                                <input id="form_subject" name="form_subject" class="form-control required" type="text" placeholder="Enter Subject">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-30">
                                <input id="form_phone" name="form_phone" class="form-control" type="text" placeholder="Enter Phone">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-30">
                        <textarea id="form_message" name="form_message" class="form-control required" rows="7" placeholder="Enter Message"></textarea>
                    </div>
                    <div class="form-group">
                        <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="" />
                        <button type="submit" class="btn btn-dark btn-theme-color-blue btn-flat mr-5" data-loading-text="Please wait...">Send your message</button>
                        <button type="reset" class="btn btn-default btn-flat btn-theme-color-red">Reset</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-60">
            <div class="col-sm-12 col-md-3">
                <div class="contact-info text-center bg-theme-color-sky border-1px pt-60 pb-60">
                    <i class="fa fa-phone font-36 mb-10 text-theme-color-red"></i>
                    <h4>Call Us</h4>
                    <h6 class="text-white">Phone: +262 695 2601</h6>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="contact-info text-center bg-theme-color-yellow border-1px pt-60 pb-60">
                    <i class="fa fa-map-marker font-36 mb-10 text-theme-color-red"></i>
                    <h4>Address</h4>
                    <h6 class="text-white">121 King Street, Australia</h6>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="contact-info text-center bg-theme-color-green border-1px pt-60 pb-60">
                    <i class="fa fa-envelope font-36 mb-10 text-theme-color-red"></i>
                    <h4>Email</h4>
                    <h6 class="text-white">you@yourdomain.com</h6>
                </div>
            </div>
            <div class="col-sm-12 col-md-3">
                <div class="contact-info text-center bg-theme-color-lemon border-1px pt-60 pb-60">
                    <i class="fa fa-fax font-36 mb-10 text-theme-color-red"></i>
                    <h4>Fax</h4>
                    <h6 class="text-white">(020) 123 4567</h6>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection