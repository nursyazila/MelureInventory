<?php

$hostAddr = "localhost";
$dbName = "melure";
$dbUser = "root";
$dbPwd = "";
$dbPort = 3306;

$dbPDO = new PDO("mysql:host=$hostAddr;dbname=$dbName",$dbUser,$dbPwd);

if(!isset($_POST['agent_id'])) {
	$G_Id  = '';
}
else{
	$G_Id  = $_POST['agent_id'];
}

if(!isset($_POST['password'])) {
	$G_Pswd  = '';
}
else{
	$G_Pswd  = $_POST['password'];
}


	$stmt = $dbPDO->prepare("SELECT Agent_Id, Agent_Password,Agent_Name FROM Agent WHERE Agent_Id =:G_Id AND Agent_Password = :G_Pswd");
	$stmt->bindParam(':G_Id', $G_Id);
	$stmt->bindParam(':G_Pswd', $G_Pswd);
	$stmt->execute();
	$count = $stmt->rowCount();
	$row  = $stmt->fetch();

	if($count==1)
						
		{
							
		session_start();
		$_SESSION['Agent_Id']=$row['Agent_Id'];
		$_SESSION['Agent_Name']=$row['Agent_Name'];
		header('location:LandingPage.php');
							
							
	}



?>