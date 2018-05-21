<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "melure";

$conn= mysqli_connect($servername,$username,$password,$dbname) or die ("Unable to connect");

	
$query=mysqli_query($conn,"SELECT * FROM inventory where status='Active'");

if($query)
	{
		while($row=mysqli_fetch_array($query))
		{
			$flag[]=$row;
		}
		
		print(json_encode($flag));
	}
	else{
		
	
	}
	mysqli_close($conn);
	
	?>