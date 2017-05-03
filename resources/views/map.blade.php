@extends('layouts.app')
@section('content')
    <div id="page-content">
        <div class="hero-section full-screen has-map has-sidebar">
            <div class="map-wrapper">
                <div class="geo-location">
                    <i class="fa fa-map-marker"></i>
                </div>
                <div class="map" id="map-homepage">
                    @yield('mapmarker')
                </div>
            </div>
            <!--end map-wrapper-->
            @yield('results')

        </div>
        <!--end hero-section-->

        <div class="container">
            <hr>
        </div>
        <!--end container-->

    </div>
@endsection