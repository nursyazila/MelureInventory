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
	
   if(isset($_POST['username']) && isset($_POST['password']))
    {
		  // Innitialize Variable
		 $result='';
	   	 $username = $_POST['username'];
         $password = $_POST['password'];
		  
		  // Query database for row exist or not
          $sql = 'SELECT * FROM hq WHERE  admin_id = :username AND password = :password';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':username', $username, PDO::PARAM_STR);
          $stmt->bindParam(':password', $password, PDO::PARAM_STR);
          $stmt->execute();
          if($stmt->rowCount())
          {
		
			 $result="true";	
          }  
          elseif(!$stmt->rowCount())
          {
			  	$result="false";
          }
		  
		  // send result back to android
   		  echo $result;
  }
	
?>

