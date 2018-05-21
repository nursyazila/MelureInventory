<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "melure";

$conn= mysqli_connect($servername,$username,$password,$dbname) or die ("Unable to connect");
if($_SERVER['REQUEST_METHOD']=='POST'){

$ID = $_POST['InventoryID'];

$Sql_Query = "Update inventory set status='Inactive' WHERE inventory_id = '$ID'";

 if(mysqli_query($conn,$Sql_Query))
{
 echo 'Record Deleted Successfully';
}
else
{
 echo 'Something went wrong';
 }
 }
 mysqli_close($conn);
?>