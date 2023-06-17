<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="register.css">
<style>

  .navbar {
  overflow: hidden;
  background-color: #333;
  position: fixed; /* Set the navbar to fixed position */
  z-index:2;
  top: 0; /* Position the navbar at the top of the page */
  width: 100%; /* Full width */
}

/* Links inside the navbar */
.navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 16px 16px;
  text-decoration: none;
}

/* Change background on mouse-over */
.navbar a:hover {
  background: #ddd;
  color: black;
}

.main {
  padding: 16px;
  margin-top: 30px;
  height: 700px; /* Used in this example to enable scrolling */

}




body, html {
  height: 100%;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.bgimg {
  /* The image used */
  background-image: url("photo-1571019613454-1cb2f99b2d8b.jpg");

  min-height: 1600px;
  width:1250px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

/* Add styles to the form container */
.container {
  position: absolute;
  right: 300px;
  top: -400px
  margin: 40px;
  max-width: 1000px;
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 30%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit button */
.btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}



.left{
  float:left;
}

.clear{
  clear:both;
}

ul {
  width:100%;
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

li a:hover {
  background-color: #111;
}



</style>
</head>
<title>
Register
</title>

<body>

<div class="navbar">
  <a href="home.php">Home</a>
  <a href="register.php">Sign Up</a>
  <a href="login.php">Login</a>
  <a href="about.php">About Us</a>
</div>



<div class="main">

<div class="bgimg" >

  <form method = "post" action="register.php" class="container" style = "top:440px;" >
    <h1>Register</h1>
	
    <p>Please fill this form to create an account.</p>
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter username" name="username" id="username" required>
   

    
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id = "psw" required><br>
	 &nbsp &nbsp &nbsp 
	<label for="height"><b>Height</b></label>
    <input type="text" placeholder="Enter height in cm" name="height" id= "height" required>	
	&nbsp &nbsp &nbsp 
	<label for="gender"><b>Gender</b></label>
    <input type="text" placeholder="Male or Female" name="gender" id= "gender" required><br>	
	&nbsp &nbsp &nbsp 
	<label for="weight"><b>Weight</b></label>
    <input type="text" placeholder="Enter in kg" name="weight" id= "weight" required>	
		
	<label for="DOB"><b>Date of Birth</b></label>
    <input type="text" placeholder="dd-mm-yyyy"
      min="1997-01-01" max="2021-12-31" name="DOB" id="DOB" required>
			
	  <h1>Enter Plan Details</h1>
	
	<label for="start"><b>Goal</b></label></br></br>
	
  <input type="radio" id="Goal" name="goal" value="Lose Weight" required>
  <label for="target1">Lose Weight</label><br>
  
  <input type="radio" id="Goal" name="goal" value="Getting Fitter" required>
  <label for="target2">Getting Fitter</label><br>
  
  <input type="radio" id="Goal" name="goal" value="Gain Muscle" required>
  <label for="target3">Gain Muscle</label><br><br>
	
  
  
  <label for="start"><b>Total Days</b></label></br></br>
	
	
	<input type="radio" id="Days" name="Days" value=7 required>
  <label for="td0">7</label><br>
  
  <input type="radio" id="Days" name="Days" value=14 required>
  <label for="td1">14</label><br>
  
  <input type="radio" id="Days" name="Days" value=30 required>
  <label for="td2">30</label><br>
  
  <input type="radio" id="Days" name="Days" value=60 required>
  <label for="td3">60</label><br>
  
  <input type="radio" id="Days" name="Days" value=90 required>
  <label for="td4">90</label><br><br>		
			
	 <div class="clearfix">
      <button type="button" class="cancelbtn" onclick="history.back()">
        <a href="home1.html" style = "color:black">Cancel</a>
      </button>
      <button type="submit" name="sub" id="sub" class="signupbtn"><a style = "color:black">Sign Up</a></button>
    </div>
  </div>
   </form>  
   </div>
</div> 

<?php


	if(isset($_POST["sub"]))
	{
			$username = $_POST['username'];
			$password = $_POST['psw'];
			$height = $_POST['height'];
			$gender = $_POST['gender'];
			$weight = $_POST['weight'];
			$DOB = $_POST['DOB'];
			$goal = $_POST['goal'];
			$days = $_POST['Days'];

		   $db_sid = 
		   " (DESCRIPTION =
			(ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-MEINVRG)(PORT = 1521))
			(CONNECT_DATA =
			  (SERVER = DEDICATED)
			  (SERVICE_NAME = Shoaib)
			)
		  )";            // Your oracle SID, can be found in tnsnames.ora  ((oraclebase)\app\Your_username\product\11.2.0\dbhome_1\NETWORK\ADMIN) 
		  
		   $db_user = "scott";   // Oracle username e.g "scott"
		   $db_pass = "1234";    // Password for user e.g "1234"
		   $con = oci_connect($db_user,$db_pass,$db_sid); 
		 
			$q = "CALL insert_member('$username','$password','$height','$gender','$DOB','$weight','$goal','$days')";
			$q_id = oci_parse($con,$q);
			$r = oci_execute($q_id);		
			
      
			header('Location: ./middle.php? name='.$username);			
			
			echo"<br>";
	}	 
?>







</body>
</html>