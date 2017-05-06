@extends('layouts.app')
@section('content')

<?php

use App\Attraction;
use App\Image;
use App\Tag;

$attractions = Attraction::all();
$images = Image::all();

?>

<script>
var totalTime = 0.0;
var totalTime2 = 0.0;
var totalTime3 = 0.0;
var totalTime4 = 0.0;
var previousLat = 0.0;
var previousLng = 0.0;
var timeFormat = '';
var distance = '';
var duration = '';
var thisLat = 0.0;
var thisLng = 0.0;
var count = 0;

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
    console.log("target id = " + ev.target.id);
}

function drop(ev, day) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    count = count + 1;
    //alert(typeof(day));
    $.ajax({
        type: "POST",
        url: "{{URL::asset('/planner')}}",
        data: {id: parseInt(data), time: totalTime, time2: totalTime2, time3: totalTime3, time4: totalTime4, lat: previousLat, lng: previousLng, count: count, day: day},
        success: function(response) {
        if(day == 1){
          var resultTime = response.totalApproxTime;
          totalTime = parseFloat(response.approx_time) + totalTime;
        } else if (day == 2) {
          var resultTime = response.totalApproxTime2;
          totalTime2 = parseFloat(response.approx_time) + totalTime2;
        } else if (day == 3) {
          var resultTime = response.totalApproxTime3;
          totalTime3 = parseFloat(response.approx_time) + totalTime3;
        } else if (day == 4) {
          var resultTime = response.totalApproxTime4;
          totalTime4 = parseFloat(response.approx_time) + totalTime4;
        }
        var whole = Math.floor(totalTime);
        var deci = totalTime - whole;
            var div = document.createElement("div");
            div.className = "item item-row";
            div.setAttribute("data-latitude",response.latitude);
            div.setAttribute("data-longitude",response.longitude);
            div.setAttribute("data-approx",response.approx_time);
            div.setAttribute("time",totalTime);
            div.setAttribute("count",count);
            div.setAttribute("day",day);
            div.innerHTML = "<a href='attraction/"+ data +"'>" +
            "<div class='image bg-transfer'>" +
            "<!-- <figure>Average Price: $8 - $30</figure> -->" +
            "<img src='{{URL::asset('/')}}" + response.image + "' alt=''>" +
            "</div>" +
            "<!--end image-->" +
            "<div class='map' id='map" + data +"'></div>" +
            "<div class='description' draggable='true' id="+ data +" ondragstart='drag(event)'>" +
            "<h3>"+ response.title +"</h3>" +
            "<h4>"+ response.address +"</h4>" +
        "<div class='label label-default'>"+response.category+"</div>" +
        "<div class='label label-default'>"+response.category2+"</div>" +
        "<div class='label label-default'>"+response.category3+"</div>" +
        "<div class='label label-time'>Stays here until: "+resultTime+"</div>" +
            "<h4> Recommened Duration : "+ response.approx_time+ " hour(s)</h4>" +
            "</div>" +
            "<!--end description-->" +
            "</a>";
            ev.target.appendChild(div);

            console.log(data);
            drawMap("map"+data,response.latitude,response.longitude);
            var oldDiv = document.getElementById(data);
            oldDiv.style.display = "none";
        thisLat = response.latitude;
        thisLng = response.longitude;

        }
    });
    calTime();
}

function initMap() {

}

function drawMap(id,latitude,longitude){
    var mapCenter = new google.maps.LatLng(latitude,longitude);

    var mapOptions = {
        zoom: 14,
        center: mapCenter
    };
    var mapElement = document.getElementById(id);
    var map = new google.maps.Map(mapElement, mapOptions);
    var marker = new google.maps.Marker({
        position: mapCenter,
        map: map,
        icon: 'http://localhost/tripplanner/public/assets/img/marker.png',
        flat: true,

    });
    google.maps.event.addListener(marker, "dragend", function () {
        var latitude = this.position.lat();
        var longitude = this.position.lng();
        $('#latitude').val( this.position.lat() );
        $('#longitude').val( this.position.lng() );
    });

}

function calTime(){
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://maps.googleapis.com/maps/api/distancematrix/json?units=metrics&origins=13.868041%2C100.705276&destinations=13.77398%2C100.51585",
    "method": "GET",
    "headers": {
      "cache-control": "no-cache",
      "postman-token": "510d4e1b-2f37-0113-6568-6b1e57724a31"
    }
  }

  $.ajax(settings).done(function (resp) {
    // console.log(resp.rows.elements.distance.text);
    //var res = JSON.parse(resp);
    distance = resp.rows[0].elements[0].distance.text;
    duration = resp.rows[0].elements[0].duration.text;
    thisLat = previousLat;
    previousLng = thisLng;
    //alert(thisLat);
    //alert(duration);
  });



}

function slideLeft(){
  var plannerday = document.getElementsByClassName('planner-day');
  for (var i = 0; i < plannerday.length; i++) {
    // if(document.getElementById(plannerday[1].id).style.left != ((-630)*(plannerday.length-1) + "px")){
      var left = document.getElementById(plannerday[i].id).style.left;
      left = left.replace("px","");
      left = parseInt(left);

      var newLeft = left + (-630);
      document.getElementById(plannerday[i].id).style.left = newLeft + "px";
    // }

  }
}
function slideRight(){
  var plannerday = document.getElementsByClassName('planner-day');
  for (var i = 0; i < plannerday.length; i++) {
    var left = document.getElementById(plannerday[i].id).style.left;
    left = left.replace("px","");
    // if(document.getElementById(plannerday[1].id).style.left != ("0px")){
      var newLeft = parseInt(left) + 630;
      document.getElementById(plannerday[i].id).style.left = newLeft + "px";
    // }
  }
}

function getAttractionIdInPlanner(plannerId){
  var attractions = document.getElementById(plannerId).getElementsByClassName('description');
  for (var i = 0; i < attractions.length; i++) {
    console.log(attractions[i].id);
  }
}
</script>

<section class="block">
    <div class="container">
        <div>
            <div class="section-title">
                <div>
                    <h2>Recommended Places</h2>
                    <h3 class="subtitle">Fusce eu mollis dui, varius convallis mauris. Nam dictum id</h3>
                </div>
            </div>
            <!--end section-title-->
        </div>
        <!--end center-->
        <div class="row">

            <div class="scrollable">

            @foreach($attractions as $attraction)
                <div class="col-md-4 col-sm-4" draggable="true" id="{{$attraction->id}}"  ondragstart="drag(event)">
                    <div class="item">
                        <figure class="ribbon"></figure>
                        <a href="detail.html">
                            <div class="description">
                                <div class="label label-default">{{$attraction->category}}</div>
                                <h3>{{$attraction->title}}</h3>
                                <!-- <h4>840 My Drive</h4> -->
                            </div>
                            <!--end description-->
                            <div class="image bg-transfer">
                                <img src="assets/images/{{$attraction->id}}-1.jpg" alt="">
                            </div>
                            <!--end image-->
                        </a>
                        <div class="additional-info">
                            <figure class="circle" title="Featured"><i class="fa fa-check"></i></figure>
                            <div class="rating-passive" data-rating="5">
                                <span class="stars"></span>
                                <span class="reviews">12</span>
                            </div>
                            <div class="controls-more">
                                <ul>
                                    <li><a href="#">Add to favorites</a></li>
                                    <li><a href="#">Add to watchlist</a></li>
                                    <li><a href="#" class="quick-detail">Quick detail</a></li>
                                </ul>
                            </div>
                            <!--end controls-more-->
                        </div>
                        <!--end additional-info-->
                    </div>
                    <!--end item-->
                </div>
                <!--<end col-md-4-->
            @endforeach

            </div>
            <!--<end scrollable-->

        </div>
        <!--end row-->

        <div id="planner">
            <ul style="width: 990px;">
            <?php for ($i=1; $i < 5 ; $i++) { ?>
                <li class="planner-day" id="plannerday<?php echo $i?>" style="left: 0px;">
                    <div class="day-header">
                        <h4>Day <?php echo $i; ?> <div class="label label-default" id="tripTime"></div></h4>
                    </div>
                    <div ondrop="drop(event,<?php echo $i ?>)" ondragover="allowDrop(event)" style="height: 700px;">

                    </div>

                </li>

            <?php } ?>

                <!-- <li class="planner-day">Day 2</li>
                <li class="planner-day">Day 3</li>
                <li class="planner-day">Day 4</li> -->

            </ul>
            <img class="arrowleft-slide" onclick="slideLeft()" src="{{asset('assets/img/arrow-left.png')}}" alt="" width="50px" height="50px">
            <img class="arrowright-slide" onclick="slideRight()" src="{{asset('assets/img/arrow-right.png')}}" alt="" width="50px" height="50px">
            <!--  <div class="row">
                 <div class="col-md-4 col-sm-4" style="height: 200px;background-color: #000;margin:5px;" ondrop="drop(event)" ondragover="allowDrop(event)">
                 </div>

             </div> -->
             <!--end row-->

        </div>

        <!-- end planner -->

    <!--end center-->
    </div>

</section>
<!--end block-->
@endsection
