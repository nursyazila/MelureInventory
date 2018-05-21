<html>
<head>
	<style>
			@import url(https://fonts.googleapis.com/css?family=Roboto:300);

			* {margin: 0;padding: 0;}
			
			ul {list-style-type: none;margin: 0;padding: 0;overflow: hidden;background-color: #333;}

			li {float: left;}

			li a {display: block;color: white;text-align: center;padding: 14px 16px;text-decoration: none;}

			li a:hover:not(.active) {background-color: #333;}

			.active { background-color: #333;}

			.login-page {width: 360px;padding: 8% 0 0; margin: auto;}
			
			.form {
			  position: relative; z-index: 1;
			  background: #FFFFFF;
			  max-width: 360px;
			  margin: 0 auto 100px;padding: 45px;text-align: center;
			  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
			}
			.form input {
			  font-family: "Roboto", sans-serif;
			  outline: 0;background: #f2f2f2;width: 100%;
			  border: 0;margin: 0 0 15px;padding: 15px;
			  box-sizing: border-box;font-size: 14px;
			}
			
			.form button {
			  font-family: "Roboto", sans-serif;text-transform: uppercase;
			  outline: 0;background: #4CAF50;width: 100%;
			  border: 0;padding: 15px;color: #FFFFFF;
			  font-size: 14px;
			  -webkit-transition: all 0.3 ease;transition: all 0.3 ease;cursor: pointer;
			}
			
			.form button:hover,.form button:active,.form button:focus {background: #43A047;
			}
			
			.form .message {
			  margin: 15px 0 0;
			  color: #b3b3b3;
			  font-size: 12px;
			}
			.form .message a {
			  color: #4CAF50;
			  text-decoration: none;
			}
			.form .register-form {
			  display: none;
			}
			.container {
			  position: relative;
			  z-index: 1;
			  max-width: 300px;
			  margin: 0 auto;
			}
			.container:before, .container:after {
			  content: "";
			  display: block;
			  clear: both;
			}
			.container .info {
			  margin: 50px auto;
			  text-align: center;
			}
			.container .info h1 {
			  margin: 0 0 15px;
			  padding: 0;
			  font-size: 36px;
			  font-weight: 300;
			  color: #1a1a1a;
			}
			.container .info span {
			  color: #4d4d4d;
			  font-size: 12px;
			}
			.container .info span a {
			  color: #000000;
			  text-decoration: none;
			}
			.container .info span .fa {
			  color: #EF3B3A;
			}
			body {
			  background: #76b852; /* fallback for old browsers */
			  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
			  background: -moz-linear-gradient(right, #76b852, #8DC26F);
			  background: -o-linear-gradient(right, #76b852, #8DC26F);
			  background: linear-gradient(to left, #76b852, #8DC26F);
			  font-family: "Roboto", sans-serif;
			  -webkit-font-smoothing: antialiased;
			  -moz-osx-font-smoothing: grayscale;      
			}
	</style>
</head>
	<body>
			<ul>
			  <li><a class="active" href="#home">Melure Dropship System</a></li>
	
			</ul>
		<div class="login-page">
		  <div class="form">
			
			<form method="post" action="" class="login-form">
			  <img style="border-radius:50%;border:2px solid grey" src="melure.jpg" alt="Smiley face" height="150" width="150"> 
			  <br><br>
			  
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

						if($count!=0)
											
							{
												
							session_start();
							$_SESSION['Agent_Id']=$row['Agent_Id'];
							$_SESSION['Agent_Name']=$row['Agent_Name'];
							header('location:LandingPage.php');
						
						}
						
						if($G_Id != $row['Agent_Id'] && $G_Pswd != $row['Agent_Password']){
							echo 'Login Fail';
							echo '<br>';
						}

					?>
			  <input type="text" name="agent_id" placeholder="Agent ID" required/>
			  <input type="password" name="password" placeholder="password" required/>
			  
		
			  <button>login</button>
			</form>
			
	       
		  </div>
		</div>
	</body>
</html>