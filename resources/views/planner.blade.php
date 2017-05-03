@extends('layouts.app')
@section('content')

<?php

use App\Attraction;
use App\Image;

$attractions = Attraction::all();
$images = Image::all();

?>

<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
    console.log("target id = " + ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    $.ajax({
    	type: "POST",
    	url: "{{URL::asset('/planner')}}",
    	data: {id: parseInt(data)},
    	success: function(response) {
    		var div = document.createElement("div");
		    div.className = "item item-row";
		    div.setAttribute("data-latitude",response.latitude);
		    div.setAttribute("data-longitude",response.longitude);
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
		    "<div class='label label-default'>Restaurant</div>" +
		    "</div>" +
		    "<!--end description-->" +
		    "</a>";
		    ev.target.appendChild(div);
		    console.log(data);
		    drawMap("map"+data,response.latitude,response.longitude);
		    var oldDiv = document.getElementById(data);
		    oldDiv.style.display = "none";
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
        		<li class="planner-day">
        			<div class="day-header">
        				<h4>Day <?php echo $i; ?> </h4>
        				
        			</div>
        			<div ondrop="drop(event)" ondragover="allowDrop(event)" style="height: 600px;">
        					
        			</div>
        		</li>
        	<?php } ?>
        		<
        		<li class="planner-day">Day 2</li>
        		<li class="planner-day">Day 3</li>
        		<li class="planner-day">Day 4</li>
        	</ul>
        	<!--  <div class="row">
	        	 <div class="col-md-4 col-sm-4" style="height: 200px;background-color: #000;margin:5px;" ondrop="drop(event)" ondragover="allowDrop(event)">
	        	 </div>
	        	
        	 </div> -->
        	 <!--end row-->
        </div>
        <!-- end planner -->

    <!--end center-->
    </div>
    <!--end container-->
</section>
<!--end block-->
@endsection