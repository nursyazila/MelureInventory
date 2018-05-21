<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "melure";

try {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    	die("OOPs something went wrong");
    }
	
$sql = "SELECT * FROM inventory where status='Active'";
$r = mysqli_query($conn,$sql);
$result = array();
while($res = mysqli_fetch_array($r)){
array_push($result,array(
"inventory_name"=>$res['inventory_name'],
"inventory_image"=>$res['inventory_image']
)
);
}
echo json_encode(array("result"=>$result));
mysqli_close($conn);
?>
