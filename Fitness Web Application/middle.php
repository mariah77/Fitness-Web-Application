<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="register.css">
    <style>
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

        min-height: 850px;

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    /* Add styles to the form container */
    .container {
        right: 50px;
        top: -330px margin: 40px;
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

    form {
        position: absolute;
        top: 300px;
        left: 550px;
        width: 250px;
    }
    </style>
</head>

<body>
    <title>
        Middle
    </title>

    <div class="bgimg">
        <form method="post" class="container">

            <label for="start"><b>
                    <h1>Select Plan</h1>
                </b></label></br></br>
            <form action="/action_page.php" required>

                <div class="clearfix">
                    <button type="submit" name="sub3" id="sub3" class="cancelbtn"> <a style="color: black">Automatically
                            Generated Plan</a>
                    </button>
                    <button type="submit" name = "sub4" id="sub4" class="signupbtn"><a style="color: black">Self Created
                            Plan</button>
                </div>
    </div>
    </form>
    </div>

<?php

	if(isset($_POST["sub3"]))
	{
    $username= $_GET['name']; 

    header('Location: ./automatic.php?name='.$username); 
    
			echo"<br>";
	}
  
  if(isset($_POST["sub4"]))
	{
    $username= $_GET['name']; 

    header('Location: ./plans.php?name='.$username); 
    
			echo"<br>";
	}
  

?>


</body>

</html>