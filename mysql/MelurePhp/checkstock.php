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
		  width:70%;
		  padding: 3% 0 0;
		  margin: auto;
		}
		.form {
		  position: relative;
		  z-index: 1;
		  background: #FFFFFF;
		  margin: 0 auto 100px;
		  padding: 45px;
		  text-align: center;
		  height:400px;
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
		
		.button{
			background-color: #333; /* Green */
			border: none;
			color: white;
			padding: 10px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			width: 200px;
			float: left;
			margin-left:190px;
}

		.quantity{
			height:25px;
			width:100px;
		}
		
		
		[class*='close-'] {
		  color: #777;
		  font: 30px/100% arial, sans-serif;
		  position: absolute;
		  right: 10px;
		  text-decoration: none;
		  text-shadow: 0 1px 0 #fff;
		  top: 5px;
		}

		.close-classic:after {
		  content: 'X'; 
		}

		.close-thin:after {
		  content: '×'; 
		}

		.close-thik:after {
		  content: '✖'; 
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
				<form method="post" action="" class="login-form">
				 <a href="placeorder.php" class="close-thin"></a>
				<?php
				$hostAddr = "localhost";
				$dbName = "melure";
				$dbUser = "root";
				$dbPwd = "";
				$dbPort = 3306;

				$dbPDO = new PDO("mysql:host=$hostAddr;dbname=$dbName",$dbUser,$dbPwd);
				
				    $inventory_id = $_GET['inventory'];
					$stmt=$dbPDO->prepare("SELECT * FROM inventory where inventory_id='$inventory_id' ");
					$stmt->execute();
					
				     $i = 1;
						while($row=$stmt->fetch()){
							$quantity = $row['instock_quantity'];
							$desc = $row['inventory_description'];
							$name = $row['inventory_name'];

				?>
				
				<div class="gallery">
			
				  <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['inventory_image'] ).'"/>'; ?>
				  </a>
				  <div class="desc">
					
					<?php 
						  echo '<h3 style="color:green;">In Stock : '.$row['instock_quantity'].'</h3>';
					
					?>
				  </div>
				</div>
				
				<?php
				
						}
				?>
				<br><br>
				<h2> Place Your Order Here! </h2>
				<br><br>
				<?php echo '<p>Item Name: '.$name.'</p>'; 
					  echo '<p>'.$desc.'</p>'; 
				?> 
				<br><br>
				<h4> Order Quantity: 
				
				<input type="number" class="quantity" name="quantity" min="1" max="<?php echo $quantity;?>"> </h4>
				<br>
                <input class="button" name="order" value="Order" type="submit">
				
					<?php if(isset($_POST['order']))  
					{
					  if(!empty($_POST['quantity']))  {
						$quantityorder = $_POST['quantity'];
						$date = date("Y-m-d") ;
						
						$stmt2 =$dbPDO->prepare("INSERT INTO orders (Order_Id,Agent_Id,inventory_id,quantity,OrderDate,Status) 
		                VALUES ('','$agentid','$inventory_id','$quantityorder','$date','Pending')");
						$stmt2->execute();
						
						$stmt3 =$dbPDO->prepare("Update inventory SET instock_quantity = (instock_quantity -$quantityorder) where inventory_id='$inventory_id'");
						$stmt3->execute();
						
						echo '<script>';
						echo 'alert("order success")';
						echo '</script>';
						echo "<meta http-equiv=\"refresh\"content=\"1;URL=checkstock.php?inventory=$inventory_id\">";
					  }
				
					
					
					}
					?>
			 
			    </form>
		  </div>
		</div>


	</body>

</html>