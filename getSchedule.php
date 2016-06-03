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
			if(isset($_GET['q']))
			{
				$sql="SELECT * FROM schedule where userid=".$_GET['q']." order by date asc, starttime asc";
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) >0)
				{
					while($row = mysqli_fetch_array($result)){
						$arr[] = $row;
					}
					echo json_encode($arr);
				}
				else
					echo "no";
			}
				
}

?>
