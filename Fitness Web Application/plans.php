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
  padding: 0px;
  margin-top: 30px;
  height: 700px; /* Used in this example to enable scrolling */

}

.p2 {
  font-family: Arial, Helvetica, sans-serif;
}
    .collapsible {
        background-color: #777;
        color: white;
        cursor: pointer;
        padding: 20px;
        width: 101%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
		 font-family: Arial, Helvetica, sans-serif;
    }

    .active,
    .collapsible:hover {
        background-color: #555;
    }

    .collapsible:after {
        content: '\002B';
        color: white;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .active:after {
        content: "\2212";
    }

    .content {
        padding: 0 18px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
        background-color: #f1f1f1;
    }

    /* Add styles to the form container */
    .container {
        position: absolute;
        right: 0;
        margin: 20px;
        max-width: 500px;
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
        background: #FFFFFF;
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

    button {
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }
    </style>
</head>
<title>
    Plans
</title>

<body>

<div class="navbar">
  <a href="profile.php"class="p2">Home</a>
  <a href="register.php" class="p2">Sign Up</a>
  <a href="login.php" class="p2">Login</a>
  <a href="about.php" class="p2">About Us</a>
</div>

<div class = "main">


    <button class="collapsible">Excercise Plan</button>
    <div class="content">
        </br>

        <label for="start"><b>Muscle Groups</b></label></br></br>

        <form method="post">
            <input type="checkbox" id="Hips" name="MuscleGroup[]" value="Hips">
            <label for="mg1">Hips</label><br>
            <input type="checkbox" id="Chest" name="MuscleGroup[]" value="Chest">
            <label for="mg2">Chest</label><br>
            <input type="checkbox" id="Legs" name="MuscleGroup[]" value="Legs">
            <label for="mg3">Legs</label><br>
            <input type="checkbox" id="Back" name="MuscleGroup[]" value="Back">
            <label for="mg4">Back</label><br>
            <input type="checkbox" id="Arms" name="MuscleGroup[]" value="Arms">
            <label for="mg5">Arms</label><br>
            <input type="checkbox" id="Whole_Body" name="MuscleGroup[]" value="Whole Body">
            <label for="mg6">Whole Body</label><br>
            <input type="checkbox" id="Stomach" name="MuscleGroup[]" value="Stomach">
            <label for="mg7">Stomach</label><br>
            <br>

            <button type="submit" name="sub5" id="sub5" class="signupbtn"><a style="color: black">Submit</button>
  </form>
    </div>
    <img src="iStock-871070868.jpg" width='100%' height='100%'>
</div>
    <script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }
    </script>


<?php

	if(isset($_POST["sub5"]))
	{
		$username = $_GET['name'];
    if(!empty($_POST['MuscleGroup']))
    {      
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
      
        $q = "select member_id from registeredmembers where username = '$username' ";
        $q_id = oci_parse($con,$q);
        $r = oci_execute($q_id);		
        $row = oci_fetch_array($q_id, OCI_BOTH+OCI_RETURN_NULLS); 		
  
        $member_id = $row['MEMBER_ID'];
  
        $q1 = "select goal from membershipplan where member_id = '$member_id' ";
        $q_id1 = oci_parse($con,$q1);
        $r1 = oci_execute($q_id1);		
        $row1 = oci_fetch_array($q_id1, OCI_BOTH+OCI_RETURN_NULLS); 		
  
         $goal = $row1['GOAL'];

      foreach($_POST['MuscleGroup'] as $Muscle_Group )
      {
        $q2 = "CALL self_workout_plan('$member_id','$goal','$Muscle_Group') ";
        $q_id2 = oci_parse($con,$q2);
        $r2 = oci_execute($q_id2);		
      }
      $q3 = "CALL self_nutritional_plan('$member_id') ";
      $q_id3 = oci_parse($con,$q3);
      $r3 = oci_execute($q_id3);

      header('Location: ./profile.php?name='.$username);
    }
    else
    {
      header('Location: ./plans.php?name='.$username);
    }

	}
  
?>

</body>
</html>