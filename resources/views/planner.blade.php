@extends('layouts.app')
@section('content')

<?php

use App\User;
use App\Attraction;
use App\Image;
use App\Tag;
use App\Cluster;

$user = Auth::user();
if($user){
    $userCluster = $user->cluster;
    $clusteredAttractions = Cluster::where('cluster',$userCluster)->orderBy('rating', 'desc')->get();
}

$attractions = Attraction::all();
$images = Image::all();

?>

<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev,parentNode) {
    var img = document.createElement("img");
    img.src = "{{asset('assets/img/marker.png')}}";
    ev.dataTransfer.setDragImage(img, 0, 0);
    ev.dataTransfer.setData("text", ev.target.id);
    ev.dataTransfer.setData("parent", parentNode.id);
    // console.log(parentNode.id);

}

function drop(ev, day) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var totalTime = 0.0;
    var previousLat = 0.0;
    var previousLng = 0.0;
    var childElement = document.getElementById(data);
    var parent = ev.dataTransfer.getData("parent");
    $.ajax({
    type: "POST",
    url: "{{URL::asset('/planner')}}",
    data: {id: parseInt(data)},
    success: function(response) {
        totalTime = parseFloat(response.approx_time) + totalTime;
        if (childElement) {
            if($(ev.target).hasClass( "droppable" ))    {           //Only allow drop inside the 2 divs
                childElement.className = 'col-md-12 col-sm-12 drop-attraction';
                childElement.setAttribute("data-latitude",response.latitude);
                childElement.setAttribute("data-longitude",response.longitude);
                childElement.setAttribute("data-approx",response.approx_time);
                childElement.setAttribute("time",totalTime);
                var descriptionDiv = childElement.getElementsByTagName('div')[1];
                descriptionDiv.innerHTML = "<h3>" + response.title + "</h3>" +
                "<h4>"+ response.address +"</h4>";
                var additionalInfoDiv = childElement.getElementsByClassName('additional-info')[0];
                if(parent && parent == 'recommendAttraction') {
                  var recommendDuration = document.createElement('div');
                    recommendDuration.setAttribute("id", "approxTime");
                    recommendDuration.innerHTML = "<h4>Recommened Duration : "+ response.approx_time + " hour(s)</h4>";
                    additionalInfoDiv.appendChild(recommendDuration);
                }

                var attractionContentDiv = childElement.getElementsByTagName('a')[0];
                attractionContentDiv.setAttribute("style","height:180px");
                var mapDiv = document.createElement("div");
                mapDiv.className = 'map';
                mapDiv.setAttribute("id", "map"+data);
                attractionContentDiv.appendChild(mapDiv);
                drawMap("map"+data,response.latitude,response.longitude);

                ev.target.appendChild(childElement);
            }
            return false;
        }
        
        var sum = 0.0;
        $('.item item-row').each(function(){
            sum += parseFloat(this.time);
        });
        previousLat = response.latitude;
        previousLng = response.longitude;
        totalTime = parseFloat(response.approx_time) + totalTime;
    }
    });
    
    



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
        icon: "{{asset('assets/img/marker.png')}}",
        flat: true,

    });
    google.maps.event.addListener(marker, "dragend", function () {
        var latitude = this.position.lat();
        var longitude = this.position.lng();
        $('#latitude').val( this.position.lat() );
        $('#longitude').val( this.position.lng() );
    });

}

function reappearAttraction(attractionId){
    document.getElementById(attractionId).remove();
    $.ajax({
    type: "POST",
    url: "{{URL::asset('/planner')}}",
    data: {id: parseInt(attractionId)},
    success: function(response) {
        var scrollableDiv = document.getElementById('recommendAttraction');
        var newAttractionDiv = document.createElement('div');
        newAttractionDiv.className = "col-md-4 col-sm-4";
        newAttractionDiv.setAttribute("draggable", "true");
        newAttractionDiv.setAttribute("id", response.id);
        newAttractionDiv.setAttribute("ondragstart", "drag(event)");
        newAttractionDiv.innerHTML = "<div class='item'>" +
            "<a href='attraction/" + response.id + "' class='attraction-content'>" +
            "<div class='description'>" +
            "<h3>" + response.title + "</h3>" +
            "</div>" +
            "<!--end description-->" +
            "<div class='image bg-transfer'>" +
            "<img src='assets/images/" + response.id + "-1.jpg'>" +
            "</div>" +
            "<!--end image-->" +
            "</a>" +
            "<div class='additional-info'>" +
            "<div class='category label label-default'>" + response.category + "</div>" +
            "<div class='category label label-default'>" + response.category2 + "</div>" +
            "<div class='category label label-default'>" + response.category3 + "</div>" +
            "</div>" +
            "<div class='controls-more'>" +
            "<ul>" +
            "<li><a href='#' class='quick-detail'>Quick detail</a></li>" +
            "<li><a href='#'' onclick='reappearAttraction(" + response.id + ")''>Remove</a></li>"+ 
            "</ul>" + 
            "</div>" +
            "<!--end controls-more-->" +
            "</div>" +
            "<!--end additional-info-->" +
            "</div>" +
            "<!--end item-->";
            scrollableDiv.insertBefore(newAttractionDiv, scrollableDiv.firstChild);
    }
    });
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

            <div class="scrollable droppable"  id="recommendAttraction" ondrop="drop(event,'scrollable')" ondragover="allowDrop(event)" draggable="false">
            <?php 
                if(!$user){
                    $clusteredAttractions = $attractions;
                } 
            ?>
            @foreach($clusteredAttractions as $clusteredAttraction)
               
                <?php 
                if($user){
                    $attraction = Attraction::find($clusteredAttraction->attraction_id); 
                }else{
                    $attraction = $clusteredAttraction;
                }
                
                $categories = $attraction->categories;
                // echo $categories;
                ?>
                
                <div class="col-md-4 col-sm-4" draggable="true" id="{{$attraction->id}}"  ondragstart="drag(event,this.parentNode)">
                    <div class="item">
                        <figure class="ribbon"></figure>
                        <a href="attraction/{{$attraction->id}}" class="attraction-content">
                            <div class="description">
                                <!-- <div class="label label-default">{{$attraction->category}}</div> -->
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
                            <div style="overflow: hidden;">
                                <?php $i = 0; ?>
                                @foreach($categories as $category)
                                <?php if ($i++ > 4) break; ?>
                                <div class="label label-default">{{$category->category}}</div>
                                @endforeach
                            </div>
                            <div class="controls-more">
                                <ul>
                                    <li><a href="#" class="quick-detail">Quick detail</a></li>
                                    <li><a href="#" onclick="reappearAttraction({{$attraction->id}})">Remove</a></li>
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
                <li class="planner-day" id="plannerday{{$i}}">
                    <div class="day-header" draggable="false">
                        <h4>Day <?php echo $i; ?> </h4>

                    </div>
                    <div ondrop="drop(event,<?php echo $i; ?>)" ondragover="allowDrop(event)" draggable="false" style="height: 600px;" class="droppable">

                    </div>
                </li>
            <?php } ?>

                <li class="planner-day">Day 2</li>
                <li class="planner-day">Day 3</li>
                <li class="planner-day">Day 4</li>
            </ul>
            <!--  <div class="row">
                 <div class="col-md-4 col-sm-4" style="height: 200px;background-color: #000;margin:5px;" ondrop="drop(event)" ondragover="allowDrop(event)">
                 </div>

             </div> -->
             <!--end row-->
            <?php
                $selectedTime = "9:00:00";
                $approxTime = 1.50;
                $whole = floor($approxTime);
                $decimal = $approxTime - $whole;
                $min = 0;
                if ($decimal == .50) {
                    $min = 30;
                }
                $endTime = strtotime($selectedTime) + ($whole*3600) + ($min*60);  //900 = 15 min X 60 sec
                echo date('h:i:s', $endTime);
            ?>
        </div>
        <!-- end planner -->

    <!--end center-->
    </div>
    <!--end container-->
</section>
<!--end block-->
@endsection
