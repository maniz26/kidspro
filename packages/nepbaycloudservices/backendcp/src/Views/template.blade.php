<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="{{asset('backendcp/assets/css/lib/chartist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('backendcp/assets/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('backendcp/assets/css/lib/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('backendcp/assets/css/lib/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('backendcp/assets/css/lib/owl.theme.default.min.css')}}" rel="stylesheet" />
    <link href="{{asset('backendcp/assets/css/lib/weather-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('backendcp/assets/css/lib/menubar/sidebar.css')}}" rel="stylesheet">
    <link href="{{asset('backendcp/assets/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backendcp/assets/css/lib/unix.css')}}" rel="stylesheet">    
    <link href="{{asset('backendcp/assets/css/style.css')}}" rel="stylesheet">    
    @yield('header-scripts')
</head>

<body>

    @include('backendcp::menu')
    <!-- /# sidebar -->


    <div class="header">
        <div class="pull-left">
            <div class="logo"><a href="{{route('admin.root')}}"><img src="{{asset('flightmandu/img/summit-air.png')}}" alt=""  width="100" /><span>Admin Cp</span></a></div>
            <div class="hamburger sidebar-toggle">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
        <div class="pull-right p-r-15">
            <ul>
                
               <!--  <li class="header-icon dib"><i class="ti-bell"></i>
                    <div class="drop-down">
                        <div class="dropdown-content-heading">
                            <span class="text-left">Recent Notifications</span>
                        </div>
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="{{asset('backendcp/assets/images/avatar/3.jpg')}}" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mr. Saifun</div>
                                            <div class="notification-text">5 members joined today </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="{{asset('backendcp/assets/images/avatar/3.jpg')}}" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Mariam</div>
                                            <div class="notification-text">likes a photo of you</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="{{asset('backendcp/assets/images/avatar/3.jpg')}}" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Tasnim</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="{{asset('backendcp/assets/images/avatar/3.jpg')}}" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Ishrat Jahan</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="text-center">
                                    <a href="#" class="more-link">See All</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="header-icon dib"><i class="ti-email"></i>
                    <div class="drop-down">
                        <div class="dropdown-content-heading">
                            <span class="text-left">2 New Messages</span>
                            <a href="email.html"><i class="ti-pencil-alt pull-right"></i></a>
                        </div>
                        <div class="dropdown-content-body">
                            <ul>
                                <li class="notification-unread">
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="{{asset('backendcp/assets/images/avatar/1.jpg')}}" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Saiul Islam</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-unread">
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="{{asset('backendcp/assets/images/avatar/2.jpg')}}" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Ishrat Jahan</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="{{asset('backendcp/assets/images/avatar/3.jpg')}}" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Saiul Islam</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="pull-left m-r-10 avatar-img" src="{{asset('backendcp/assets/images/avatar/2.jpg')}}" alt="" />
                                        <div class="notification-content">
                                            <small class="notification-timestamp pull-right">02:34 PM</small>
                                            <div class="notification-heading">Ishrat Jahan</div>
                                            <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="text-center">
                                    <a href="#" class="more-link">See All</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li> -->
                <li class="header-icon dib"><img class="avatar-img" src="{{asset('backendcp/assets/images/avatar/1.jpg')}}" alt="" /> <span class="user-avatar"> {{ Auth::guard('admin')->user()->name }} <i class="ti-angle-down f-s-10"></i></span>
                    <div class="drop-down dropdown-profile">
                        
                        <div class="dropdown-content-body">
                            <ul>
                                <!-- <li><a href="#"><i class="ti-user"></i> <span>Profile</span></a></li>
                                <li><a href="#"><i class="ti-wallet"></i> <span>My Balance</span></a></li>
                                <li><a href="#"><i class="ti-write"></i> <span>My Task</span></a></li>
                                <li><a href="#"><i class="ti-calendar"></i> <span>My Calender</span></a></li>
                                <li><a href="#"><i class="ti-email"></i> <span>Inbox</span></a></li>
                                <li><a href="#"><i class="ti-settings"></i> <span>Setting</span></a></li>
                                <li><a href="#"><i class="ti-help-alt"></i> <span>Help</span></a></li>-->
                                <li><a href="{{route('home')}}" target="_blank"><i class="ti-lock"></i> <span>View Site</span></a></li> 
                                <li><a href="{{route('admin.logout')}}"><i class="ti-power-off"></i> <span>Logout</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="content-wrap">
            
        <div class="main">
           @yield('content')
        </div>
    </div>

    <div id="search">
        <button type="button" class="close">×</button>
        <form>
            <input type="search" value="" placeholder="type keyword(s) here" />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>


    </div>
    <script src="{{asset('backendcp/assets/js/lib/jquery.min.js')}}"></script>
    <!-- jquery vendor -->
    <script src="{{asset('backendcp/assets/js/lib/jquery.nanoscroller.min.js')}}"></script>
    <!-- nano scroller -->
    <script src="{{asset('backendcp/assets/js/lib/menubar/sidebar.js')}}"></script>
    <script src="{{asset('backendcp/assets/js/lib/preloader/pace.min.js')}}"></script>
    <!-- sidebar -->
    <script src="{{asset('backendcp/assets/js/lib/bootstrap.min.js')}}"></script>
    <!-- bootstrap -->
    <script src="{{asset('backendcp/assets/js/lib/weather/jquery.simpleWeather.min.js')}}"></script>
    <script src="{{asset('backendcp/assets/js/lib/weather/weather-init.js')}}"></script>
    <script src="{{asset('backendcp/assets/js/lib/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('backendcp/assets/js/lib/circle-progress/circle-progress-init.js')}}"></script>
    <script src="{{asset('backendcp/assets/js/lib/chartist/chartist.min.js')}}"></script>   
    <script src="{{asset('backendcp/assets/js/lib/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('backendcp/assets/js/lib/owl-carousel/owl.carousel-init.js')}}"></script>
    @yield('footer-scripts')
    
    <script src="{{asset('backendcp/assets/js/scripts.js')}}"></script>

    
</body>

</html>