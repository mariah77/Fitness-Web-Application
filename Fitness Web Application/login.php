<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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



    body,
    html {
      height: 100%;
      font-family: Arial, Helvetica, sans-serif;
    }

    * {
      box-sizing: border-box;
    }

    .bgimg {
      /* The image used */
      background-image: url("photo-1571019613454-1cb2f99b2d8b.jpg");

      min-height: 730px;
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
      right: 440px;
      top: -300px margin: 40px;
      max-width: 300px;
      padding: 16px;
      background-color: white;
    }

    /* Full-width input fields */
    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
    }

    input[type=text]:focus,
    input[type=password]:focus {
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



  </style>
</head>
<title>
  Login
</title>

<body>

<?php

if($_GET)
{
  $error = $_GET['error'];
}



?>



<div class="navbar">
  <a href="home.php">Home</a>
  <a href="register.php">Sign Up</a>
  <a href="login.php">Login</a>
  <a href="about.php">About Us</a>
</div>

<div class = "main">
  <div class="bgimg">
    <form method="post" class="container" style="top:250px;">
      <h1>Login</h1>

      <label for="user"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="user" id ="user"  required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

      <button type="submit" id="login" name="login" value="login" class="btn"><a style="color:black">Login</a></button>
      <p style= "color:red" ><?php echo @$error;?></p>

    </form>
  </div>
  
 </div>

  <?php
  if (isset($_POST['login'])) {

    $username = $_POST['user'];
    $password = $_POST['psw'];   

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
    $con = oci_connect($db_user, $db_pass, $db_sid);

     $q = "select username from registeredmembers where username= '$username' AND password = '$password' ";
			$q_id = oci_parse($con,$q);
			$r = oci_execute($q_id);
      $numrows = oci_fetch_all($q_id,$res);
      echo ($numrows);

      if($numrows==1)
      {
       header('Location: ./profile.php?name='.$username);
      }
      else
      {      
        header('Location: ./login.php?error=invalid username/password');
      }

  }


  ?>

</body>

</html>