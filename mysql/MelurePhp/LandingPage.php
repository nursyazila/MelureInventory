<!-- web content taken from wikipedia page -->
<html>
<body>
<head>
<style>

* {
  margin: 0;
  padding: 0;
   font-family: "Roboto", sans-serif;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #333;
}

.active {
    background-color:#333;
}

.page-wrap{   
   
    font-family: 'Lato', sans-serif;
    }

header::after{
  display:block;
  position:fixed;
}

header{
 
    height:100vh; 
    background-image: url('whitelily.jpg');
    background-size: cover;
    z-index: 2;
    display: flex;
    flex-flow: column;
    justify-content: center;
    position: relative;
}

.header-wrap{
    position: relative;
}

h1 {
    position: relative;
    display: inline-block;
    text-align: center;
    margin-bottom:-10px;
    z-index: 1;
    font-size: 50px;
    color: ghostwhite;
    text-shadow: -2px 2px 5px rgba(0,0,0,0.7); // this shadow is maintained across header items
}

.head-link{
    position: relative;
    display: inline-block;
    font-size: 25px;
    text-decoration: overline;
    color: ghostwhite;
    margin: 20px auto 20px; //brings the link to center
    -webkit-font-smoothing: antialiased;
    text-shadow: -2px 2px 5px rgba(0,0,0,0.7);
}

// hover effect to intuit user to click on the link to enable scrolling
.head-link:hover{
    position: relative;
    display: block;
    font-size: 27px;
    color:ghostwhite;
    text-decoration: none;
    margin: 20px auto 20px;}
   

// Adding psudo class before to create an overlay on header background
header::before{
    content:"";
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    position: absolute;
    background: rgba(9,9,9, 0.7);
        }

.content{
// this encapsulates all the content below header
    
     display: block;
     position:relative;
     left:60px;
     padding:15px;
     margin:0px;
     background-color: whitesmoke;   
}
h4{
	padding: 20px;
	max-width: 600px; 
    padding: 20px;
    left:0;
    margin: 0px auto 0px; 
    display: block;
    color: darkslategrey;
}

p { 
    max-width: 600px; 
    padding: 20px;
    left:0;
    font-size: 15px;
    margin: 0px auto 0px; 
    display: block;
    color: darkslategrey;
    }

.button, .button1 {
    background-color: #333; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
	width: 150px;
	float: left;
}
.button1{
	margin-left:600px;
}

}



</style>
</head>
	<ul>
		<li><a class="active" href="#home">Melure Dropship System</a></li>
		<li style="float:right"><a class="active" href="logout.php">Logout</a></li>
	</ul>
<div class="page-wrap">
<header> 
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
 
  <h1> Welcome</h1>
  <a href="#" class="head-link"><?php echo $agentname; ?>  </a>
    <form method="post">
    <center><input class="button1" type="submit" name="placeorder" value="Place Order"/></center>
	</form>
	
	<?php 
	if(isset($_POST['placeorder'])){
		header("location:placeorder.php");
	}
	?>
   
</header>       
  
<div id="hl-content" class="content">
<h4> Why choose Melure Perfumes? </h4>
<p>﻿The best product that can save you in various ways.
Melure perfumes are the inspired perfume that is HALAL, long lasting and lastly, SAVE COST!
Each box can last 1-2 months, each bottle is 25ml and not to mention.Affordable price for all! Now Melure Perfume caters for both ladies (M1-M6) and men (M7-M9).</p>
        

  </p>
  </div> <!-- content ends here -->
  
 
</div> <!-- page wrap ends here -->
</body>
</html>