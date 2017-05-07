
@extends('map')
<?php

use App\Attraction;

$attractions = Attraction::all();
$searchKey = "";
if($searchResult){
	$attractions = $searchResult;
	$searchKey = $keyword;
}

?>

@section('results')
<div class="results-wrapper">
	<div class="form search-form inputs-underline">
		<form method="post">
			<div class="section-title">
				<h2>Search</h2>
			</div>
			<div class="form-group">
				<input id="searchKey" type="text" class="form-control" name="keyword" placeholder="Enter keyword" value="{{$searchKey}}">
			</div>
			<!--end form-group-->
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<select class="form-control" name="city"> 
							<!-- select class="selectpicker" -->
							<option value="">Category</option>
							<option value="1">Landmark</option>
							<option value="2">Shopping</option>
							<option value="3">Local</option>

						</select>
					</div>
					<!--end form-group-->
				</div>
				<!--end col-md-6-->
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<select class="form-control" name="category">
							<!-- select class="selectpicker" -->
							<option value="">Sub-category</option>
							<option value="restaurant">Traditional</option>
							<option value="car rental">Temple</option>
							<option value="relax">Relax</option>
						</select>
					</div>
					<!--end form-group-->
				</div>
				<!--end col-md-6-->
			</div>
			<!--end row-->
			<div class="row">
				 <div class="col-md-6 col-sm-6">
					<!-- <div class="form-group">
						<input type="text" class="form-control date-picker" name="min-price" placeholder="Event Date">
					</div> -->
					<!--end form-group
				</div> -->
				<!--end col-md-6-->
			</div>
			<!--end row-->
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group">
				<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i></button>
			</div>
			<!--end form-group-->

		</form>
		<!--end form-hero-->
	</div>
	<div class="sidebar-detail">
        <div class="tse-scrollable">
            <div class="tse-content">
                <div class="sidebar-wrapper"></div>
                <!--end sidebar-detail-content-->
            </div>
            <!--end tse-content-->
        </div>
        <!--end tse-scrollable-->
    </div>
    <!--end sidebar-detail-->
	<div class="results">
		<div class="tse-scrollable">
			<div class="tse-content">
				<div class="section-title">
					<h2>Search Results<span class="results-number">{{ $attractions->count() }}</span></h2>
				</div>
				<!--end section-title-->
				<div class="results-content">
					@foreach($attractions as $attraction)
					<div class="result-item" data-id="{{ $attraction->id }}">
						<a href="{{ $attraction->url }}">
							<h3>{{$attraction->title}}</h3>
							<div class="result-item-detail">
								<div class="image" style="background-image: url({{ asset('assets/img/default.png') }})">
								</div>
								<div class="description">
									<h5><i class="fa fa-map-marker"></i>{{$attraction->address}}</h5>
									<div class="label label-default">{{$attraction->category}}</div>
									<p>{{$attraction->description}}</p>
								</div>
							</div>
						</a>
						<div class="controls-more">
							<ul>
								<li><a href="#" class="add-to-favorites">Add to favorites</a></li>
								<li><a href="#" class="add-to-watchlist">Add to watchlist</a></li>
							</ul>
						</div>
					</div>

					@endforeach
				</div>
				<!--end results-content-->
			</div>
			<!--end tse-content-->
		</div>
		<!--end tse-scrollable-->
	</div>
	<!--end results-->
	</div>
	<!--end results-wrapper-->
@endsection

@section('mapmarker')
<script>
	
	function initMap() {
        var map = new google.maps.Map(document.getElementById('map-homepage'), {
          center: new google.maps.LatLng(13.751735, 100.501233),
          zoom: 14
        });

        var infoWindow = new google.maps.InfoWindow;
        // Change this depending on the name of your PHP or XML file
          downloadUrl('http://localhost/tripplanner/public/marker','POST',function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              infowincontent.className = 'item infobox';
              var strong = document.createElement('strong');
              strong.innerHTML = "<a href=''>" 
              + "<div class='description'>"
              + "<h3>"+ name +"</h3>"
              +	"</div>"
              +"</a>"
              + "<h4>"+ address +"</h4>"
              infowincontent.appendChild(strong);

              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: 'http://localhost/tripplanner/public/assets/img/marker.png',
                flat: true,
                id: id
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });

        function downloadUrl(url,method, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        
        if(method == 'GET'){
        	request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };
        	request.open('GET', url, true);
        	request.send(null);
        }
        else{
        	var searchKey = document.getElementById('searchKey').value;
        	request.open('POST', url, true);
        	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        	request.send('keyword='+searchKey);
        	request.onreadystatechange = function() {//Call a function when the state changes.
			    if(request.readyState == 4 && request.status == 200) {
			        request.onreadystatechange = doNothing;
            		callback(request, request.status);
			    }
			}
        	
        }
        // 
      }

      function doNothing() {}

    }

</script>
@endsection
