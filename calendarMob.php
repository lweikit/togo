<!DOCTYPE html>
<html>
<head>
    <title>ToGo Calendar</title>
	<link rel="stylesheet" href="components/bootstrap2/css/bootstrap.css">
	<link rel="stylesheet" href="components/bootstrap2/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="css/calendar.css">
</head>
<body onload="document.getElementById('today').click();">
	
	
	<div class="page-header">
<h3></h3>
	</br>
		<div class=" form-inline">
			<div class="btn-group btn-sp">
				<button class="btn btn-lg btn-primary btn-sph" data-calendar-nav="prev"><< Prev</button>
				<button class="btn-sph btn btn-lg" id='today' data-calendar-nav="today">Today</button>
				<button class="btn btn-sph btn-lg btn-primary" data-calendar-nav="next">Next >></button>
			</div>
</br>
			<div class="btn-group btn-sp">
				<button class="btn btn-sph btn-lg btn-warning active" data-calendar-view="month">Month</button>
				<button class="btn btn-sph btn-lg btn-warning" data-calendar-view="week">Week</button>
				<button class="btn btn-sph btn-lg btn-warning" data-calendar-view="day">Day</button>
			</div>		
		</div>

	</div>
	
    <div id="calendar"></div>
	
	<script type="text/javascript" src="components/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="components/underscore/underscore-min.js"></script>
	<script type="text/javascript" src="components/bootstrap2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="components/jstimezonedetect/jstz.min.js"></script>
    <script type="text/javascript" src="js/calendar.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	
    
</body>
</html>