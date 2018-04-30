@extends('kidspro_dark.layouts.template')
@section('content')
<!-- Section: inner-header -->
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="http://placehold.it/1920x700">
    <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title text-white">About</h2>
                    <ol class="breadcrumb text-left text-black mt-10">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li class="active text-gray-silver">Page Title</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section: About -->
<section>
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-theme-color-sky line-bottom"><span class="text-theme-color-red">Welcome To KidsPro</span> <br> Best Education in Our Kindergarden</h2>
                    <h4 class="text-theme-color-blue">Lorem ipsum dolor sit amet soluta saepe odit error, maxime praesentium sunt udiandae!</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore atque officiis maxime suscipit expedita obcaecati nulla in ducimus iure quos quam recusandae dolor quas et perspiciatis voluptatum accusantium delectus nisi reprehenderit, eveniet fuga modi pariatur, eius vero. Ea vitae maiores.</p>
                    <a href="#" class="btn btn-flat btn-colored btn-theme-color-blue mt-15 mr-15">Read More</a><a href="#" class="btn btn-flat btn-colored btn-theme-color-yellow mt-15">Get a Quote</a>
                </div>
                <div class="col-md-6">
                    <div class="video-popup">
                        <a>
                            <img alt="" src="http://placehold.it/533x476" class="img-responsive img-fullwidth">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <img alt="" src="http://placehold.it/1895x143" class="img-responsive img-fullwidth">
    </div>
</section>

<!-- Section: Features -->
@include('kidspro.layouts.features.feature1')

<!-- Divider: Funfact -->
<section class="divider" data-bg-img="http://placehold.it/1920x388">
    <div class="container pt-90 pb-90">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                <div class="funfact text-center">
                    <i class="pe-7s-users mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="864" class="animate-number text-white font-42 font-weight-300 mt-0 mb-0">0</h2>
                    <h5 class="text-white">Qualified Teachers</h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                <div class="funfact text-center">
                    <i class="pe-7s-study mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="486" class="animate-number text-white font-42 font-weight-300 mt-0 mb-0">0</h2>
                    <h5 class="text-white">Successful Kids</h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                <div class="funfact text-center">
                    <i class="pe-7s-smile mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="1468" class="animate-number text-white font-42 font-weight-300 mt-0 mb-0">0</h2>
                    <h5 class="text-white">Happy Parents</h5>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
                <div class="funfact text-center">
                    <i class="pe-7s-medal mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="32" class="animate-number text-white font-42 font-weight-300 mt-0 mb-0">0</h2>
                    <h5 class="text-white">Award Won</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section: Courses -->
@include('kidspro.layouts.courses.course-gird')
<!-- Divider: Clients -->
<section class="clients bg-theme-color-sky">
    <div class="container pt-10 pb-0">
        <div class="row">
            <div class="col-md-12">
                <!-- Section: Clients -->
                <div class="owl-carousel-6col clients-logo transparent text-center owl-nav-top">
                    <div class="item"> <a href="#"><img src="http://placehold.it/200x120" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="http://placehold.it/200x120" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="http://placehold.it/200x120" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="http://placehold.it/200x120" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="http://placehold.it/200x120" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="http://placehold.it/200x120" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="http://placehold.it/200x120" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="http://placehold.it/200x120" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="http://placehold.it/200x120" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="http://placehold.it/200x120" alt=""></a></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection