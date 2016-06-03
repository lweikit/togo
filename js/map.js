var map;
var currentPos;
var infowindow;
var markers = [];
var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
var labelIndex = 0;

var start;
var end;

	  
function initMap() {
	var directionsService = new google.maps.DirectionsService;
  	var directionsDisplay = new google.maps.DirectionsRenderer;
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 1.300, lng: 103.800},
    zoom: 15,
	disableDefaultUI: true
  });
  directionsDisplay.setMap(map);
  var onChangeHandler = function() {
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  };
   document.getElementById('start').addEventListener('focus', onChangeHandler);
   document.getElementById('end').addEventListener('focus', onChangeHandler);
 
 google.maps.event.addListenerOnce(map, 'idle', function(){
	 document.getElementById("start").style.visibility ="visible";
    document.getElementById("start").focus();
});

  updateCurrentLocation();
  
}

 function calculateAndDisplayRoute(directionsService, directionsDisplay) {
	  directionsService.route({
		origin: document.getElementById('start').value,
		destination: document.getElementById('end').value,
		travelMode: google.maps.TravelMode.DRIVING
	  }, function(response, status) {
		if (status === google.maps.DirectionsStatus.OK) {
		  directionsDisplay.setDirections(response);
		} else {
		 	//fail
		}
	  });
	}
	
function updateCurrentLocation() {
	// Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

	  currentPos = pos;
      addMarker(pos,map);
      map.setCenter(pos);
	   end= pos.lat+","+pos.lng;
	   document.getElementById("end").value =end;
	   if(start != null)
	   {
		   	document.getElementById("end").style.visibility ="visible";
		    document.getElementById("end").focus();
	   }
	  }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
}

// Adds a marker to the map.
function addMarker(location, map) {
  // Add the marker at the clicked location, and add the next-available label
  // from the array of alphabetical characters.
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  
  markers.push(marker);
}

function findShop() {
	clearMarkers();
	updateCurrentLocation();
	infowindow = new google.maps.InfoWindow();
	var service = new google.maps.places.PlacesService(map);
	service.nearbySearch({
		location: currentPos,
		radius: 500,
		types: ['shop']
	}, callback);
}

function findRestaurant() {
	clearMarkers();
	updateCurrentLocation();
	infowindow = new google.maps.InfoWindow();
	var service = new google.maps.places.PlacesService(map);
	service.nearbySearch({
		location: currentPos,
		radius: 500,
		types: ['restaurant']
	}, callback);
}

function findSight() {
	clearMarkers();
	updateCurrentLocation();
	infowindow = new google.maps.InfoWindow();
	var service = new google.maps.places.PlacesService(map);
	service.nearbySearch({
		location: currentPos,
		radius: 500,
		types: ['sightseeing']
	}, callback);
}

function findMedical() {
	clearMarkers();
	updateCurrentLocation();
	infowindow = new google.maps.InfoWindow();
	var service = new google.maps.places.PlacesService(map);
	service.nearbySearch({
		location: currentPos,
		radius: 500,
		types: ['medical']
	}, callback);
}

function callback(results, status) {
  if (status === google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
    }
  }
}

function createMarker(place) {
  var placeLoc = place.geometry.location;
  var marker = new google.maps.Marker({
    map: map,
    label: labels[labelIndex++ % labels.length],
    position: place.geometry.location

  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
    console.log(place);
  });
  
  markers.push(marker);
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setMapOnAll(null);
  markers = [];
  labelIndex = 0;
}

getLocationXY();
function getQueryStringValue (key) {  
  return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));  
}  

function getLocationXY()
{
	var str = getQueryStringValue("q");
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                start = xmlhttp.responseText;
				document.getElementById("start").value =start;	
            }
        }
        xmlhttp.open("GET","mapControl.php?q="+str,true);
        xmlhttp.send();
}
