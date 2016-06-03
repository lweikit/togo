<!doctype html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
<title>Togo-Admin</title>
<script src="jquery-2.1.4.min.js"></script>
<style>
      #gmap {
        height: 400px;
      }

.infoTableStyle {
	width:900px;
	cellpadding:0;
	cellspacing:0;
}
</style>

</head>

<script type="text/javascript">

function ssr_()
{
	$.ajax({
	type: 'POST',
	url: 'scheduleCalls.php',
	data: $('#myform').serialize(),
	success: function (data) {
		document.getElementById("hihi").innerHTML = data;
	}
});
		
}

var haveDate ="";
function addToDB()
{
	$.ajax({
	type: 'POST',
	url: 'scheduleCalls.php',
	data: $('#myform').serialize(),
	success: function (data) {
		var myS = document.getElementById("myselect");
		haveDate =myS.value;
		while (myS.firstChild) 
		{
			myS.removeChild(myS.firstChild);
		}
		getSchedule();
		switchTo();
	}
});
}

var timer;
function time()
{
		window.clearTimeout(timer)
		timer = window.setTimeout("getSchedule()", 800);
}

var data;
function getSchedule()
{
	var str =document.getElementById("employeeId").value;
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //document.getElementById("jaxContent").innerHTML = xmlhttp.responseText;
				document.getElementById("userId").value = str;
				if(xmlhttp.responseText =="no")
				{
					alert("no such user");
				}
				else
				{
				data = JSON.parse(xmlhttp.responseText);
				
					for(ii=0; ii<data.length; ii++)
					{
						createLine(data[ii]);
					}
					if(haveDate.length >0)
					{
						document.getElementById("myselect").selected = haveDate;
						haveDate="";
					}
					var myselect = document.getElementById("myselect");
					myselect.style.display ="block";
				}
            }
        }
        xmlhttp.open("GET","getSchedule.php?q="+str,true);
        xmlhttp.send();
}
var currentD ="";

function createLine(data)
{
	if(currentD != data.date)
	{
		addDropList(data.date);
		currentD=data.date;
	}
}

function addDropList(date)
{
	var myselect = document.getElementById("myselect");
	var ele = document.createElement("option");
	ele.setAttribute("value",date);
	ele.innerHTML =date;
	var temp = "switchTo("+date+")";
	ele.setAttribute("onclick",temp);
	myselect.appendChild(ele);
}

function switchTo()
{
	var date = document.getElementById("myselect").value;
	var myTable = document.getElementById("myMainTable");
	while (myTable.firstChild) 
	{
		myTable.removeChild(myTable.firstChild);
	}
	var tr = document.createElement("tr");
	var td1 = document.createElement("th");
	var td2 = document.createElement("th");
	var td3 = document.createElement("th");
	var td4 = document.createElement("th");
	var td5 = document.createElement("th");
	td1.innerHTML ="Time";
	td2.innerHTML ="Event";
	td3.innerHTML ="Location";
	td4.innerHTML ="Dress Code";
	tr.appendChild(td1);
	tr.appendChild(td2);
	tr.appendChild(td3);
	tr.appendChild(td4);
	tr.appendChild(td5);
	myTable.appendChild(tr);
	
	var bTime ="06";
	for(ii =0; ii < data.length; ii++)
	{
		if(data[ii].date == date)
		{
			//addSlot(bTime,data[ii]);
			addToTable(data[ii]);		
		}
	}
	document.getElementById("mySDate").value = date;
}

function addToTable(data)
{
	var myTable = document.getElementById("myMainTable");
	
	var tr = document.createElement("tr");
	var td1 = document.createElement("td");
	var td2 = document.createElement("td");
	var td3 = document.createElement("td");
	var td4 = document.createElement("td");
	var td5 = document.createElement("td");
	
	
	td1.innerHTML = data.startTime+" - "+data.endTime;
	td2.innerHTML = data.eventName;
	td3.innerHTML = data.locationX +" "+data.locationY;
	td4.innerHTML = data.dressCode;
	var str ="del("+data.id+")";
	td5.innerHTML = "<input type='button' onclick='"+str+"' value='X'/>";
	tr.appendChild(td1);
	tr.appendChild(td2);
	tr.appendChild(td3);
	tr.appendChild(td4);
	tr.appendChild(td5);
	myTable.appendChild(tr);
}
function del(id)
{
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                //document.getElementById("jaxContent").innerHTML = xmlhttp.responseText;
				if(xmlhttp.responseText=="2") //del successful
				{
					for(ii=0; ii<data.length; ii++)
					{
						if(data[ii].id==id)
						{
							data.splice(ii, 1);
							switchTo();
							break;
						}
					}
				}
            }
        }
		str=id;
        xmlhttp.open("GET","scheduleCalls.php?del="+str,true);
        xmlhttp.send();
}

function addSlot(t, data)
{
	var st = data.startTime;
	var temp =st.split(":");
	
	if(t.localeCompare(temp[0]) ==-1)
	{
		r =addEmptySlot(t);
		addSlot(r,data);
	}
	else
	{
		addDetail(t,data);
	}
}

function addDetail(t,data)
{
	
	return data.endTime;
}

function addEmptySlot(t)
{
	
	var nt = t;
	nt++;
	if(nt.toString().length==1)
		nt = "0"+nt.toString();
	
	var myTable = document.getElementById("myMainTable");
	
	var tr = document.createElement("tr");
	var td1 = document.createElement("td");
	var td2 = document.createElement("td");
	var td3 = document.createElement("td");
	var td4 = document.createElement("td");
	
	
	td1.innerHTML = t+":"+"00 - "+nt+":00";
	tr.appendChild(td1);
	tr.appendChild(td2);
	tr.appendChild(td3);
	tr.appendChild(td4);
	myTable.appendChild(tr);
	
	return nt;
	
}

function loadMap()
{
	document.getElementById("gmap").style.display = "inline";
	initMap();
}
</script>


<body>


<table style="width:900px; border-collapse:collapse" align="center" cellpadding="0" cellspacing="0" >
	<tr>
    	<td>Employee id :<input type="text" id="employeeId" onKeyUp="time()"/></td>
    </tr>
    <tr>
    	<td>
        <select id="myselect" style="display:none" onChange="switchTo()">
           
        </select>
        </td>
    </tr>
    <tr>
    	<td>
        	<table id="myMainTable" style="border-collapse:collapse" align="center" cellpadding="10" cellspacing="0" >
            	
            </table>
        </td>
    </tr>
    <tr>
    	<td>
        <hr/>
        	<h3> Add items to employee schedule</h3>
            <table>
            	<tr>
                	<td valign="top">
                    <form id="myform">
                        <input type="hidden" value="1" name="eventName"/>
                       <input type="hidden" id="userId" value="" name="user"/>
                        <table>
                            <tr>
                                <td>Event Name</td>
                                <td><input name="event" type="text"/></td>
                            </tr>
                            <tr>
                            	<td>Date</td>
                                <td> <input id="mySDate" type="text" value="" placeholder="YYYY-MM-DD" name="date"/></td>
                            </tr>
                            <tr>
                                <td>Start Time</td>
                                <td><select name="st">
                                    <option value="06:00">06:00</option>
                                    <option value="07:00">07:00</option>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                    <option value="20:00">20:00</option>
                                    <option value="21:00">21:00</option>
                                    <option value="22:00">22:00</option>
                                    <option value="23:00">23:00</option>
                                </select></td>
                            </tr>
                            <tr>
                                <td>End Time</td>
                                <td><select name="et">
                                    <option value="06:00">06:00</option>
                                    <option value="07:00">07:00</option>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                    <option value="20:00">20:00</option>
                                    <option value="21:00">21:00</option>
                                    <option value="22:00">22:00</option>
                                    <option value="23:00">23:00</option>
                                </select></td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td><span onClick="loadMap()" style="color:#00F; cursor:pointer">MAPS</span> 
                                	<table>
                                    	<tr>
                                        	<td><span id="locationX"></span><input type="hidden" id="locX" name="locationX" value=""/></td>
                                        </tr>
                                        <tr>
                                        	<td><span id="locationY"></span><input type="hidden" id="locY" name="locationY" value=""/></td>
                                        </tr>
                                    </table>
                           		</td>
                            </tr>
                            <tr>
                                <td>Dress Code</td>
                                <td><select name="dc">
                                    <option value="-">-</option>
                                    <option value="formal">formal</option>
                                    <option value="casual">casual</option>
                                </select></td>
                            </tr>
                        </table>
                        <input type="button" value="submit" onClick="addToDB()"/>
                        </form>
                    </td>
                    <td><div id="gmap" style="width:450px; height:450px; float:right; display:none"></div></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div id="jaxContent">
 <script>
 var marker;
function initMap() {
  var mapDiv = document.getElementById('gmap');
  var map = new google.maps.Map(mapDiv, {
    zoom: 11,
    center: new google.maps.LatLng(1.3000, 103.8000)
  });

  // We add a DOM event here to show an alert if the DIV containing the
  // map is clicked.
  
 google.maps.event.addListener(map, 'click', function(event) {
    var myLatLng = event.latLng;
    var lat = myLatLng.lat();
    var lng = myLatLng.lng();
	document.getElementById("locationX").innerHTML = lat;
	document.getElementById("locationY").innerHTML = lng;
	document.getElementById("locX").value =lat;
	document.getElementById("locY").value =lng;
	if(marker!=null)
	{
		marker.setMap(null);
	}
	marker = new google.maps.Marker({
    position: event.latLng,
    map: map
  });
  
  
  
});

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      infoWindow.setPosition(pos);
      infoWindow.setContent('Location found.');
      map.setCenter(pos);
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap" async defer></script>
    

</div>
</body>
</html>