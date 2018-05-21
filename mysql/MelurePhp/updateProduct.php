<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "melure";

$conn= mysqli_connect($servername,$username,$password,$dbname) or die ("Unable to connect");

 
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
 $DefaultId = 0;
 
 $ImageData = $_POST['image_path'];
 
 $ImageId = $_POST['image_id'];
 $ImageName = $_POST['image_name'];
 $ImageName2 = str_replace(' ', '', $ImageName);
 $ImageDesc = $_POST['image_desc'];
 $ImageQuantity = $_POST['image_quantity'];
 $ImagePrice = $_POST['image_price'];

 $GetOldIdSQL ="SELECT inventory_id FROM  ORDER BY inventory_id ASC";
 
 $Query = mysqli_query($conn,$GetOldIdSQL);
 
 while($row = mysqli_fetch_array($conn,$Query)){
 
 $DefaultId = $row['inventory_id'];
 }
 
 $ImagePath = $ImageName2.".png";
 
 $ServerURL = "http://172.20.10.2/Melure/$ImagePath";
 
 $InsertSQL = "update inventory set inventory_name='$ImageName',inventory_description='$ImageDesc',instock_quantity='$ImageQuantity',unit_price='$ImagePrice', inventory_image='$ServerURL' Where inventory_id='$ImageId'";

 
 if(mysqli_query($conn, $InsertSQL)){

 file_put_contents($ImagePath,base64_decode($ImageData));

 echo "Your Inventory Has Been Updated.";
 }
 
 mysqli_close($conn);
 }else{
 echo "Not Updated";
 }

?>