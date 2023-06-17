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
  padding: 5px 10px;
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
        
        .textWithBlurredBg {
            width: 215px;
            height: auto;
            display: inline-block;
            position: relative;
            transition: .3s;
            margin: 4px;
        }
        
        .textWithBlurredBg img {
            width: 700%;
            height: 300%;
            transition: .3s;
            border-radius: 4px;
        }
        
        .textWithBlurredBg:hover img {
            filter: blur(2px) brightness(60%);
            box-shadow: 0 0 16px cyan;
        }
        
        .textWithBlurredBg :not(img) {
            position: absolute;
            z-index: 1;
            top: 30%;
            width: 700%;
            text-align: center;
            color: #fff;
            opacity: 0;
            transition: .3s;
        }
        
        .textWithBlurredBg h2 {
            top: 40%
        }
        
        .textWithBlurredBg h3 {
            top: 50%
        }
        
        .textWithBlurredBg:hover :not(img) {
            opacity: 1;
        }
        
        div.a {
            font-size: 100px;
            top: 35%
        }
        
        div.b {
            font-size: 70px;
            top: 45%
        }
        
        div.c {
            font-size: 200%;
            top: 55%
        }
		
		
		
		
		.btn {
  background-color: #333;
  color: white;
  padding: 10px 5px;
  border: none;
  cursor: pointer;
  width: 15%;
  text-align: center;
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

.p2 {
  font-family: Arial, Helvetica, sans-serif;
  font-size:16px;
}

		
    </style>
</head>
<title>
    Profile
</title>




<body>


    <div class="navbar">
	
        <form method="post">
	    <button type="submit" id="Home" name="Home" value="Home" class="btn" >
        <a style = "color:white" class="p2">Home</a>
      </button>
	  
	  <button type="submit" class="btn" id="Mem" name="Mem" value="Mem">
        <a style = "color:white" class="p2">Membership Plan</a>
      </button>
	  
	  <button type="submit" class="btn" id="Logs" name="Logs" value="Logs" >
        <a style = "color:white" class="p2">Logs</a>
      </button>
	  
	  <button type="submit" class="btn" id="Report" name="Report" value="Report" >
        <a style = "color:white" class="p2" href="report.php">Report</a>
      </button>
	  
	  <button type="submit" class="btn" id="LogOut" name="LogOut" value="LogOut" >
        <a style = "color:white" class="p2" href="home.php">Log Out</a>
      </button> 
    </form>
        

    </div>

    <div class="textWithBlurredBg">
        <img src="iStock-871070868.jpg">
        <div class="a">Welcome to Fit Me</div>
        <div class="b">The Ultimate Fitness Experience</div>
    </div>

<?php
  $username = $_GET['name'];  
  if(isset($_POST['Mem']))
  {
    header('Location: ./report.php?name='.$username);
  }

  if(isset($_POST['LogOut']))
  {
    header('Location: ./home.php');
  }


?>
    



</body>

</html>

