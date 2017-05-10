@extends('layouts.app')
@section('content')

<?php

use App\Attraction;
use App\Image;
use App\Tag;
use App\Category;
use App\OpeningHour;

if($searchResult){
  $attractions = $searchResult;
  $images = $attractions->images;
  $categories = $attractions->categories;
  $tag = $attractions->tags;
  $openHour = $attractions->openingHours;
}


?>

<script async defer src="http://maps.googleapis.com/maps/api/js"></script>




<div class="subpage-detail">
<div class="page-wrapper">

    <!--end page-header-->

    <div id="page-content">


        <section>
            <div class="gallery detail">
                <div class="owl-carousel" data-owl-items="3" data-owl-loop="1" data-owl-auto-width="1" data-owl-nav="1" data-owl-dots="0" data-owl-margin="2" data-owl-nav-container="#gallery-nav">
                  @foreach($images as $img)
                    <div class="image">
                      <!-- <?php echo $img; ?> -->
                        <div class="bg-transfer"><img src="{{asset($img->url)}}" alt=""></div>
                    </div>
                  @endforeach
                   
                </div>
                <!--end owl-carousel-->
            </div>
            <!--end gallery-->
        </section>
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div id="gallery-nav"></div>
                    <section>
                        <h2>About this attraction</h2>


                        <p>
                          <?php echo $attractions->description ?>
                          <br>
                          <br>
                          <?php if(!empty($tag->first())) { ?>
                          <h4>Tags :&ensp;
                          <?php foreach($tag as $t){ ?>
                            <div class="label label-default"><?php echo $t->tag;?></div>
                          <?php }
                          ?>
                          </h4>
                          <?php } ?>
                        </p>
                        <br>
                        <h5>Entrance Fee : <?php echo $attractions->entrance_fee; ?></h5>
                        <?php if (empty($attractions->additional_info)){ ?>
                        <?php } else { ?>
                              <h5><?php echo 'Remark :'.$attractions->additional_info; ?></h5>
                        <?php } ?>
                    </section>

                </div>
                <!--end col-md-7-->
                <div class="col-md-5 col-sm-5">
                    <div class="detail-sidebar">
                        <section class="shadow">
                            <div class="map height-250px" id="map<?php echo $attractions->id ?>">
                              <script>
                              var latphp = <?php echo $attractions->latitude; ?>;
                              var lngphp = <?php echo $attractions->longitude; ?>;
                              var id = <?php echo $attractions->id; ?>;
                              var mapid = 'map'+id;
                                function initMap() {
                                  var uluru = {lat: latphp, lng: lngphp};
                                  var map = new google.maps.Map(document.getElementById(mapid), {
                                    zoom: 17,
                                    center: uluru
                                  });
                                  var marker = new google.maps.Marker({
                                    position: uluru,
                                    map: map,
                                    icon: 'http://localhost/tripplanner/public/assets/img/marker.png',
                                    flat: true
                                  });
                                }
                              </script>
                            </div>
                            
                            <div class="content">
                                <div class="vertical-aligned-elements">
                                    <div class="element"><h2><?php echo $attractions->title; ?></h2></div><br><br>
                                </div>
                                <div style="margin-bottom:15px;">
                                  @foreach($categories as $cat)
                                    <div class="label label-default">{{$cat->category}}</div>
                                  @endforeach
                                </div>
                                <address>
                                    <?php if(!empty($attractions->address)) { ?>
                                      <figure><i class="fa fa-map-marker"></i><?php echo $attractions->address ?> </figure>
                                    <?php } ?>
                                    <?php if(!empty($attractions->email)) { ?>
                                      <figure><i class="fa fa-envelope"></i><?php echo $attractions->email ?></figure>
                                    <?php } ?>
                                    <?php if(!empty($attractions->phone)) { ?>
                                    <figure><i class="fa fa-phone"></i><?php echo $attractions->phone ?></figure>
                                    <?php } ?>
                                    <?php if(!empty($attractions->website)) { ?>
                                    <figure><i class="fa fa-globe"></i><a href="<?php echo $attractions->website ?>"><?php echo $attractions->website ?></a></figure>
                                    <?php } ?>
                                    <figure><i class="fa fa-clock-o"></i> Recommended duration : <?php echo $attractions->approx_time ?> hour(s)</figure>
                                </address>
                            </div>
                        </section>
                        <?php if(!empty($openHour->first())) { ?>
                        <section>
                            <h2>Opening Hours</h2>
                            <dl>
                              <?php foreach($openHour as $openday) { ?>
                                <dt><?php echo $openday->day ;?></dt>
                                <?php if($openday->closed_day == 1) {?>
                                <dd><?php echo "Closed"; }else{ ?></dd>
                                <dd><?php  echo $openday->time_open; ?> - <?php echo $openday->time_close; }?></dd>
                                <?php } ?>
                            </dl>
                        </section>
                        <?php } ?>
                        <!-- <section>
                            <h2>Share This Listing</h2>
                            <div class="social-share"></div>
                        </section> -->
                    </div>
                    <!--end detail-sidebar-->
                </div>
                <!--end col-md-5-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </div>
    <!--end page-content-->


</div>
<!--end page-wrapper-->
<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>
<a href="#" class="to-top scroll" data-show-after-scroll="600"><i class="arrow_up"></i></a>



<script>
    rating(".visitor-rating");
    var _latitude = 40.7344458;
    var _longitude = -73.86704922;
    var element = "map-detail";
    simpleMap(_latitude,_longitude, element);
</script>

</div>
@endsection
