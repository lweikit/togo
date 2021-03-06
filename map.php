<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Home</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-drawer.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <style type="text/css">
      html, body { height: 100%; margin: 0; padding: 0; }
      #map { height: 100%; }
    </style>
    
  </head>
  <body onLoad="initMap()" class="has-drawer">
  
  <input style="position:absolute; visibility:hidden" onFocus="calcRoute();" id="start" type="text" value=""/>
  <input style="position:absolute; visibility:hidden" onFocus="calcRoute();" id="end" type="text" value=""/>
  
	  <div id="drawerExample" class="drawer dw-xs-10 dw-sm-6 dw-md-4 fold" aria-labelledby="drawerExample">
        <div class="drawer-controls">
            <a href="#drawerExample" data-toggle="drawer" href="#drawerExample" aria-foldedopen="false" aria-controls="drawerExample" class="btn btn-primary btn-sm">Menu</a>
        </div>
        <div class="drawer-contents">
            <div class="drawer-heading">
                <h2 class="drawer-title">Menu</h2>
            </div>
            <ul class="drawer-nav">
                <li role="presentation"><a onclick="findShop()" href="#drawerExample" data-toggle="drawer">Shops</a></li>
                <li role="presentation"><a onclick="findRestaurant()" href="#drawerExample" data-toggle="drawer">Restaurants</a></li>
                <li role="presentation"><a onclick="findSight()" href="#drawerExample" data-toggle="drawer">Sightseeing</a></li>
                <li role="presentation"><a onclick="findMedical()" href="#drawerExample" data-toggle="drawer">Medical</a></li>
            </ul>
            <div class="drawer-footer">
                <small>Welcome!</small>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- content as per usual -->
    </div>
    <div id="map"></div>
    
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeyzVY1Ut3tzrysj0Zmt5LdI1EenxjNQs&sensor=false&callback=init&libraries=places">
    </script>
    <script type="text/javascript" src="js/map.js"></script>
    <script src="jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/drawer.min.js"></script>
    <!--<script src="http://maps.google.com/maps/api/js?sensor=true&libraries-places" type="text/javascript"></script>-->
  
  </body>
</html>