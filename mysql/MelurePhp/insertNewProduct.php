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
 
 $InsertSQL = "insert into inventory (inventory_name,inventory_description,instock_quantity,unit_price,inventory_image,status)
 values ('$ImageName','$ImageDesc','$ImageQuantity','$ImagePrice','$ServerURL','active')";
 
 if(mysqli_query($conn, $InsertSQL)){

 file_put_contents($ImagePath,base64_decode($ImageData));

 echo "Your Image Has Been Uploaded.";
 }

 
 mysqli_close($conn);
 }else{
 echo "Not Uploaded";
 }

?>