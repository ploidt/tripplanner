<?php $user = Auth::user();
?>
<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href="{{ URL::asset('fonts/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('fonts/elegant-fonts.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900,400italic' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="{{ URL::asset('/bootstrap/css/bootstrap.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('/css/zabuto_calendar.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('/css/owl.carousel.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ URL::asset('/css/trackpad-scroll-emulator.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('/css/jquery.nouislider.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{!! URL::asset('/css/style.css') !!}" type="text/css">
    <link rel="stylesheet" href="{!! URL::asset('/css/planner.css') !!}" type="text/css">

    <title>Locations - Directory Listing HTML Template</title>

</head>

<body class="homepage">
<div class="page-wrapper">
    <header id="page-header">
        <nav>
            <div class="left">
                <a href="index.html" class="brand"><img src="{{ URL::asset('assets/img/logo.png') }}" alt=""></a>
            </div>
            <!--end left-->
            <div class="right">
                <div class="primary-nav">
                <a href="{{url('yourplanner')}}">Planner</a>
                <a href="{{url('map')}}">Map</a>
                </div>
                <div class="secondary-nav">
                @if($user)
                    <a href="logout" class="promoted">Log Out</a>
                @else
                    <a href="login">Sign In</a>
                    <a href="register" class="promoted">Register</a>
                </div>

                @endif
                <!--end secondary-nav-->
                
                <div class="nav-btn">
                    <i></i>
                    <i></i>
                    <i></i>
                </div>
                <!--end nav-btn-->
            </div>
            <!--end right-->
        </nav>
        <!--end nav-->
    </header>
    <!--end page-header-->

    @yield('content')

    <footer id="page-footer">
        <div class="footer-wrapper">
            <div class="block">
                <div class="container">
                    <div class="vertical-aligned-elements">
                        <div class="element width-50">
                            <p data-toggle="modal" data-target="#myModal">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque aliquam at neque sit amet vestibulum. <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</p>
                        </div>
                        <div class="element width-50 text-align-right">
                            <a href="#" class="circle-icon"><i class="social_twitter"></i></a>
                            <a href="#" class="circle-icon"><i class="social_facebook"></i></a>
                            <a href="#" class="circle-icon"><i class="social_youtube"></i></a>
                        </div>
                    </div>
                    <div class="background-wrapper">
                        <div class="bg-transfer opacity-50">
                            <img src="{{ URL::asset('assets/img/footer-bg.png') }}" alt="">
                        </div>
                    </div>
                    <!--end background-wrapper-->
                </div>
            </div>
            <div class="footer-navigation">
                <div class="container">
                    <div class="vertical-aligned-elements">
                        <div class="element width-50">(C) 2016 Your Company, All right reserved</div>
                        <div class="element width-50 text-align-right">
                            <a href="index.html">Home</a>
                            <a href="listing-grid-right-sidebar.html">Listings</a>
                            <a href="submit.html">Submit Item</a>
                            <a href="contact.html">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--end page-footer-->
</div>
<!--end page-wrapper-->
<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>

<script type="text/javascript" src="{{ URL::asset('js/jquery-2.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-select.min.js') }}"></script>
<script async defer type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBEDfNcQRmKQEyulDN8nGWjLYPm8s4YB58&callback=initMap"></script>
<script type="text/javascript" src="{{ URL::asset('js/richmarker-compiled.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/markerclusterer_packed.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/infobox.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.fitvids.js') }}"></script>
<!-- <script type="text/javascript" src="{{ URL::asset('js/icheck.min.js') }}"></script> -->
<script type="text/javascript" src="{{ URL::asset('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.trackpad-scroll-emulator.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.nouislider.all.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
<!-- <script type="text/javascript" src="{{ URL::asset('js/maps.js') }}"></script> -->

<script>
    var optimizedDatabaseLoading = 0;
    var _latitude = 40.7344458;
    var _longitude = -73.86704922;
    var element = "map-homepage";
    var markerTarget = "modal"; // use "sidebar", "infobox" or "modal" - defines the action after click on marker
    var sidebarResultTarget = "modal"; // use "sidebar", "modal" or "new_page" - defines the action after click on marker
    var showMarkerLabels = false; // next to every marker will be a bubble with title
    var mapDefaultZoom = 14; // default zoom
    heroMap(_latitude,_longitude, element, markerTarget, sidebarResultTarget, showMarkerLabels, mapDefaultZoom);
</script>

</body>

