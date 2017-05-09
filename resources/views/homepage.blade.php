@extends('layouts.app')
@section('content')

<div class="hero-section has-background full-screen">
            <div class="wrapper">
                <div class="inner">
                    <div class="center">
                        <div class="page-title">
                            <h1>Best Deals in One Place</h1>
                            <h2>With Locations you can find the best deals in your location</h2>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <center>
                      <div class="form-group" >
                          <form action="preplanner">
                          <button type="submit" class="btn btn-primary width-100" style="padding:15px 0px; border-radius:5px;"><i class="fa fa-suitcase fa-lg" style="color:white;margin-right:10px;"></i><tag>PLAN YOUR TRIP!</tag></button>
                          </form>
                      </div>
                    </center>
                    </div>
                    <div class="col-md-4 col-sm-4">
                    </div>
                   <!--end search-form-->
               </div>
               <!--end element-->
             </div>
       <!--end vertical-aligned-elements-->

       <div class="slider">
           <div class="owl-carousel opacity-60" data-owl-nav="0" data-owl-dots="0" data-owl-autoplay="1" data-owl-fadeout="1" data-owl-loop="1">
               <div class="image">
                   <div class="bg-transfer"><img src="assets/img/landmark-1.jpg" alt=""></div>
               </div>
               <div class="image">
                   <div class="bg-transfer"><img src="assets/img/landmark-3.jpg" alt=""></div>
               </div>
               <div class="image">
                   <div class="bg-transfer"><img src="assets/img/landmark-4.jpg" alt=""></div>
               </div>
           </div>
           <!--end owl-carousel-->
           <div class="background-wrapper">
               <div class="background-color background-color-black"></div>
           </div>
           <!--end background-wrapper-->
       </div>
       <!--end slider-->
   </div>
   <!--end hero-section-->
@endsection
