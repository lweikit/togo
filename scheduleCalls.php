<?php 


// Define connection variables
$DBServer = "localhost";  // server name or IP address
$DBUser = "root";
$DBPass = "";
$DBName = "togo";

// Create connection
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// Check connection
if ($conn->connect_error) {
	echo "We have encountered some dfficulities connecting to the server. Please try again later";
}
else 
{
	if(isset($_GET['del']))
	{
		$sql="delete from schedule where id=".$_GET['del'];

				if (!mysqli_query($conn,$sql)) {
					echo "1";
				}
				else 
					echo "2";
	}
	else if(isset($_POST['eventName']))
	{
			$sql="INSERT INTO schedule (userId,eventName,date,startTime, endTime, dressCode, locationX, locationY) VALUES ('".$_POST['user']."','".$_POST['event']."','".$_POST['date']."','".$_POST['st']."','".$_POST['et']."','".$_POST['dc']."','".$_POST['locationX']."','".$_POST['locationY']."')";

				if (!mysqli_query($conn,$sql)) {
					if(mysqli_errno($conn) == 1062) // same username exist.
					{
						echo "1";
					}
					else
					{
						echo "2";
					}
				}
	}
	else if($_GET['q']==123)
	{
		$sql="SELECT * FROM schedule order by date asc, starttime asc";
		$result = mysqli_query($conn,$sql);
		$out = array();
		while($row = mysqli_fetch_array($result)) {
			$d = $row['date']." ".$row['startTime']."-6hours";
			$d2 = $row['date']." ".$row['endTime']."-6hours";
			$out[] = array(
				'id' => $row['id'],
				'title' => $row['eventName'],
				'url' => '',
				'start' => strtotime($d)*1000,
				'end' => strtotime($d2)*1000
			);
		}
		echo json_encode(array('success' => 1, 'result' => $out));
	}
	else
	{
			$sql="SELECT * FROM schedule order by date asc, starttime asc";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) >0)
			{
				while($row = mysqli_fetch_array($result)) {
					echo json_encode($row);
				}
			}
	}
				
}


?>
