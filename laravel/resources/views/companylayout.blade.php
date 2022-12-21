<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job board</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/price_rangs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <!-- Header Start -->
       <div class="header-area header-transparrent">
           <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="home"><img src="{{ asset('img/logo/logo.png') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="{{url('/company')}}">Home</a></li>
                                            <li><a href="{{url('/company/addjob')}}">Add a Job </a></li>
                                            <li><a href="{{url('/company/jobs')}}">Posted Jobs </a></li>
                                            <li><a href="{{url('/company/applications')}}">Job Applications </a></li>
                                            <li><a href="{{url('/company/profile')}}">My Profile </a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Header-btn -->
                                <div class="header-btn d-none f-right d-lg-block">
                                    <a href="{{url('/doLogout')}}" class="btn head-btn1">Logout</a>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
           </div>
       </div>
        <!-- Header End -->
    </header>
    <main>
        @yield('konten')
    </main>
    <footer>
        <!-- Footer Start-->
    <div class="footer-area footer-bg footer-padding">
        <div class="container">

           <!--  -->

        </div>
    </div>
    <!-- footer-bottom area -->
    <div class="footer-bottom-area footer-bg">
        <div class="container">
            <div class="footer-border">
                 <div class="row d-flex justify-content-between align-items-center">
                     <div class="col-xl-10 col-lg-10 ">
                         <div class="footer-copy-right">
                             <p>Laravel Project - Adi Surya Putra</p>
                         </div>
                     </div>
                     <div class="col-xl-2 col-lg-2">

                     </div>
                 </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>

<!-- All JS Custom Plugins Link Here here -->
        <script src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/slick.min.js') }}"></script>
        <script src="{{ asset('js/price_rangs.js') }}"></script>

		<!-- One Page, Animated-HeadLin -->
        <script src="{{ asset('js/wow.min.js') }}"></script>
		<script src="{{ asset('js/animated.headline.js') }}"></script>
        <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
		<script src="{{ asset('js/jquery.sticky.js') }}"></script>

        <!-- contact js -->
        <script src="{{ asset('js/contact.js') }}"></script>
        <script src="{{ asset('js/jquery.form.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/mail-script.js') }}"></script>
        <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>

		<!-- Jquery Plugins, main Jquery -->
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
