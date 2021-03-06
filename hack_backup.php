<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fitness Halton</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="hack.css">


</head>
<body>
	<!-- encasing div wrapper -->
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">

				<!-- Logo -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="#" class="navbar-brand btn-inverse" id="menu-toggle">
						<img src="http://i.stack.imgur.com/e2S63.png" width="20" /> 
					</a>
					<a href="#" class="navbar-brand">  FITNESS HALTON</a>
				</div>

				<!-- Menu Items -->
				<div class="collapse navbar-collapse" id="mainNavBar">
					<ul class="nav navbar-nav">

						<li class="active"><a href="#">Home</a></li>

						<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">About</span></a>
                        <ul class="dropdown-menu">
						<li>A lightweight mobile friendly web application designed to easily locate and start events</li>
						</ul>

						
						<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact</span></a>
                        <ul class="dropdown-menu">
						<li>fitnessalton@hackhalton.com</li>
						</ul>
					</ul>
				</div>
			</div>
		</nav>

<!-- Sidebar -->
	<div id='wrapper'>

        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li><a href="#" data-value="Baseball" onclick="getKml(this)">Baseball</a></li>
                <li><a href="#" data-value="Basketball" onclick="getKml(this)">Basketball</a></li>
                <li><a href="#" data-value="Cycling" onclick="getKml(this)">Cycling</a></li>
                <li><a href="#" data-value="Hockey" onclick="getKml(this)">Hockey</a></li>
                <li><a href="#" data-value="Soccer" onclick="getKml(this)">Soccer</a></li>
                <li><a href="#" data-value="Swimming" onclick="getKml(this)">Swimming</a></li>
                <li><a href="#" data-value="Tennis" onclick="getKml(this)">Tennis</a></li>
                <li><a href="#" data-value="Volleyball" onclick="getKml(this)">Volleyball</a></li>

            </ul>

        </div>

        <div id="events-wrapper">
            <ul class="sidebar-nav">
                <b>Events Sidebar</b>
                <br>
                <textarea rows="4" cols="50" placeholder="Enter your event" id="eventInfo"></textarea>
                <button type=button id="createEvent">Create Event</button>
                <button type=button id="cancelEvent">Cancel Event</button>
            </ul>

        </div>


    <div id='map-container'>
		<div id='map'></div>
	</div>

	</div>


    <!-- Menu toggle script -->
    <script>
        $("#menu-toggle").click( function (e){
            e.preventDefault();
            if($("#wrapper").hasClass("eventDisplayed")){
            	$("#wrapper").removeClass("eventDisplayed");
            }
            $("#wrapper").toggleClass("menuDisplayed");
        });

    </script>
<script>
	window.map;
	window.kmlUrl = "http://mobile.sheridanc.on.ca/~gjebero/Hackathon/parks.kml"; 

	function initMap() {
		var mapDiv = document.getElementById('map');
		map = new google.maps.Map(mapDiv, {
			center: {lat: 43.468984, lng: -79.698569},
			zoom: 20
		});
		var kmlOptions = {
			map: map
		};
	    kmlLayer = new google.maps.KmlLayer(kmlUrl, kmlOptions);

		google.maps.event.addDomListener(window, "resize", function() {
			var center = map.getCenter();
			google.maps.event.trigger(map, "resize");
			map.setCenter(center); 
		});

		var lookup = new Array();

		var stopMap = false;

			map.addListener('click', function(e){
				if (!stopMap){
					stopMap = true;
					console.log(e.latLing);
					var infowindow;
					lookup.push(new google.maps.Marker({
						position: e.latLng,
						map: map
					}));

					var marker = lookup[lookup.length -1];

					map.setCenter(marker.getPosition());
					map.setZoom(15);

					if ($("#wrapper").hasClass("eventDisplayed")){
						$("#wrapper").removeClass("eventDisplayed");
					}
					$("#wrapper").toggleClass("eventDisplayed");

					
					map.setCenter(e.latLng);
					map.setOptions({draggable: false, keyboardShortcuts: false});

					var cancelButton = document.querySelector("#cancelEvent");

					cancelButton.addEventListener('click', function(){
						//keeps repearting for a weird reason, have to fix
						// var markerDelete = lookup[lookup.length - 1];
						// markerDelete.setMap(null);
						// lookup.pop();
						$("#wrapper").removeClass("eventDisplayed");
						stopMap = false;

					});

					var createButton = document.querySelector("#createEvent");

					createButton.addEventListener('click', function(){
						$("#wrapper").removeClass("eventDisplayed");
						stopMap = false;
						var eventInfo = document.querySelector("#eventInfo").value;
						infowindow = new google.maps.InfoWindow({
							content: eventInfo
						});

						marker.addListener('mouseover', function(){
							infowindow.open(map,marker);
						});

						marker.addListener('mouseout', function(){
							infowindow.close();
						});

					}, false);

					// marker.addListener('dblclick', function(){
					// 	this.setMap(null);
					// });

					

				}
			});
	}

</script>
<script src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDUEZAgT2Th2FiZ7W4SLx0XrxDcMuLfO7s&callback=initMap"
async defer></script>

<script type="text/javascript" src="hack.js"></script>


</body>


</html>