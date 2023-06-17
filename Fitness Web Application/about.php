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
  padding: 2px;
  margin-top: 30px;
  height: 700px; /* Used in this example to enable scrolling */

}

.p2 {
  font-family: Arial, Helvetica, sans-serif;
}


.textWithBlurredBg{
    width:300px;
    height:auto;
    display:inline-block;
    position:relative;
    transition:.3s;
    margin:4px;
  }
  
  .textWithBlurredBg img{
    width:415%;
    height:300%;
    transition:.3s;
    border-radius:4px;
  }
  
  .textWithBlurredBg:hover img{
    filter:blur(4px) brightness(60%);
    box-shadow:0 0 16px cyan;
  }
   
  .textWithBlurredBg :not(img){
    position:absolute;
    z-index:1;
    top:30%;
    width:415%;
    text-align:center;
    color:#fff;
    opacity:0;
    transition:.3s;
  }
  
  .textWithBlurredBg h2{
    top:40%
  }
  .textWithBlurredBg h3{
    top:50%
  }
  
  .textWithBlurredBg:hover :not(img){
    opacity:1;
  }
  div.a {
  font-size: 100px;
  top:35%
}

div.b {
  font-size: 70px;
  top:50%
}

div.c {
  font-size: 200%;
  top:65%
  
}
</style>
</head>
<title>
About Us
</title>
<body>

<div class="navbar">
  <a href="home.php"class="p2">Home</a>
  <a href="register.php" class="p2">Sign Up</a>
  <a href="login.php" class="p2">Login</a>
  <a href="about.php" class="p2">About Us</a>
</div>

<div class = "main">

  <div class="textWithBlurredBg">
  <img src="iStock-871070868.jpg">
  <div class="a">Fit Me</div>
  <div class="b">The Ultimate Fitness Experience</div>
  <div class="c">In these modern days when people all over the world have become so much concerned
about their health and diet, it is obvious that they continually seek out for a Workout/Gym
platform. This FIT-ME application is an easy way to use gym and health membership system.
It can help to keep the record of your fitness routine both excercise and nutrition and keep fit.
</div>
</div>
</div>




   
</body>
</html> 
