<!DOCTYPE html>
<html>
<head>
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

.p2 {
  font-family: Arial, Helvetica, sans-serif;
}


</style>
</head>
<title>
Profile
</title>
<body>
<div class="navbar">
  <a href="home.php"class="p2">Home</a>
  <a href="register.php" class="p2">Sign Up</a>
  <a href="login.php" class="p2">Login</a>
  <a href="about.php" class="p2">About Us</a>
</div>

<div class = "main">

  
  <img src="photo-1571019613454-1cb2f99b2d8b.jpg" width = "1500px">
  
</div>



   
</body>
</html> 
