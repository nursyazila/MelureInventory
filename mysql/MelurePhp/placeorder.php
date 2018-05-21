<html>
<head>
	<style>
		* {
		  margin: 0; padding: 0; font-family: "Roboto", sans-serif;}
		  
		body{
			 background-image: url('whitelily.jpg');
			 
		}
		ul {
			list-style-type: none;
			margin: 0;padding: 0;
			overflow: hidden; background-color: #333;}

		li {float: left;}

		li a {
			display: block;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		li a:hover:not(.active) { background-color: #333;}

		.active {background-color:#333;}
		
		.login-page {
		  width:90%;
		  padding: 3% 0 0;
		  margin: auto;
		  height:auto;
		}
		.form {
		  position: relative;
		  z-index: 1;
		  background: #FFFFFF;
		  margin: 0 auto 100px;
		  padding: 45px;
		  text-align: center;
		  height:1200px;
		  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
		}
		div.gallery {
			margin: 5px;
			border: 1px solid #ccc;
			float: left;
			width: 267px;
			margin-bottom : 10px;
			
		}

		div.gallery:hover {
			border: 1px solid #777;
		}

		div.gallery img {
			width: 100%;
			height: 267px;
		}

		div.desc {
			padding: 15px;
			text-align: center;
		}
	</style>
	
	<?php 
		session_start();
		  if(!isset($_SESSION['Agent_Name'])) {
			$agentname  = '';}
		else{
			$agentname  = $_SESSION['Agent_Name'];}
			
		  if(!isset($_SESSION['Agent_Id'])) {
			$agentid  = '';}
		else{
			$agentid  = $_SESSION['Agent_Id'];}
 ?> 
	
</head>
	<body>
		<ul>
		<li><a class="active" href="#home">Melure Dropship System</a></li>
		<li style="float:right"><a class="active" href="Logout.php">Logout</a></li>
		</ul>

		
		<div class="login-page">
		  <div class="form">
				<form method="post" action="login.php" class="login-form">
				
				<?php
				$hostAddr = "localhost";
				$dbName = "melure";
				$dbUser = "root";
				$dbPwd = "";
				$dbPort = 3306;

				$dbPDO = new PDO("mysql:host=$hostAddr;dbname=$dbName",$dbUser,$dbPwd);
				
					$stmt=$dbPDO->prepare("SELECT * FROM inventory ");
					$stmt->execute();
					
				     $i = 1;
						while($row=$stmt->fetch()){

	
	
				
				?>
				
				<div class="gallery">
				  <a target="" href="checkstock.php?inventory=<?php echo $row['inventory_id'];?>">
				  
				  <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['inventory_image'] ).'"/>'; ?>
				  </a>
				  <div class="desc">
					<?php echo '<h4>'.$row['inventory_name'].'</h4>';
					      echo '<h6>'.$row['inventory_description'].'</h6>';
						  
						  echo '<h3 style="color:green;">In Stock : '.$row['instock_quantity'].'</h3>';
					
					
					?>
				  
				  
				  </div>
				</div>
				
				<?php
				
						}
				?>
					
			    </form>
		  </div>
		</div>


	</body>

</html>