<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="KidsPro - Kids Education & Kindergarten School HTML5 Template" />
    <meta name="keywords" content="kindergarten,children,kidsschool,school,baby,childschool,academy,course,education," />
    <meta name="author" content="ThemeMascot" />

    <!-- Page Title -->
    <title>KidsPro - Kids Education & Kindergarten School HTML5 Template</title>

    <!-- Favicon and Touch Icons -->
    <link href="/kidspro/images/favicon.png" rel="shortcut icon" type="image/png">
    <link href="/kidspro/images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="/kidspro/images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="/kidspro/images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="/kidspro/images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

    <!-- Stylesheet -->
    <link href="/kidspro/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/kidspro/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="/kidspro/css/animate.css" rel="stylesheet" type="text/css">
    <link href="/kidspro/css/css-plugin-collections.css" rel="stylesheet"/>
    <!-- CSS | menuzord megamenu skins -->
    <link id="menuzord-menu-skins" href="/kidspro/css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
    <!-- CSS | Main style file -->
    <link href="/kidspro/css/style-main.css" rel="stylesheet" type="text/css">
    <!-- CSS | Preloader Styles -->
    <link href="/kidspro/css/preloader.css" rel="stylesheet" type="text/css">
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="/kidspro/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="/kidspro/css/responsive.css" rel="stylesheet" type="text/css">
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    <!-- <link href="/kidsprocss/style.css" rel="stylesheet" type="text/css"> -->

    <!-- Revolution Slider 5.x CSS settings -->
    <link  href="/kidspro/js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
    <link  href="/kidspro/js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
    <link  href="/kidspro/js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>

    <!-- CSS | Theme Color -->
    <link href="/kidspro/css/colors/theme-skin-color-set-1.css" rel="stylesheet" type="text/css">

    <!-- external javascripts -->
    <script src="/kidspro/js/jquery-2.2.4.min.js"></script>
    <script src="/kidspro/js/jquery-ui.min.js"></script>
    <script src="/kidspro/js/bootstrap.min.js"></script>
    <!-- JS | jquery plugin collection for this theme -->
    <script src="/kidspro/js/jquery-plugin-collection.js"></script>

    <!-- Revolution Slider 5.x SCRIPTS -->
    <script src="/kidspro/js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
    <script src="/kidspro/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<!-- preloader -->
<div id="preloader">
    <div id="spinner">
        <div class="preloader-dot-loading">
            <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
        </div>
    </div>
    <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
</div>
@if($header)
    @include('kidspro.layouts.headers.'.$header.'')
@endif
<!-- Start main-content -->
<div class="main-content">
    @yield('content')
</div>
<!-- End main-content -->
@if($footer)
    @include('kidspro.layouts.footers.'.$footer.'')
@endif
<!-- end wrapper -->

<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<script src="{{asset('kidspro/js/custom.js')}}"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS
      (Load Extensions only on Local File Systems !
       The following part can be removed on Server for On Demand Loading) -->
<script type="text/javascript" src="{{asset('kidspro/js/revolution-slider/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script type="text/javascript" src="{{asset('kidspro/js/revolution-slider/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('kidspro/js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script type="text/javascript" src="{{asset('kidspro/js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('kidspro/js/revolution-slider/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script type="text/javascript" src="{{asset('kidspro/js/revolution-slider/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script type="text/javascript" src="{{asset('kidspro/js/revolution-slider/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script type="text/javascript" src="{{asset('kidspro/js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script type="text/javascript" src="{{asset('kidspro/js/revolution-slider/js/extensions/revolution.extension.video.min.js')}}"></script>

</html>

