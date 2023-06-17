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




.active, .collapsible:hover {
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
  max-width: 300px;
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: 	#FFFFFF;
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
Logs
</title>
<body>

<?php

  $username = $_GET['name'];
   
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

    $q1 = "select exercise_name from workout_plan where member_id = '$member_id' ";
    $q_id1 = oci_parse($con,$q1);
    $r1 = oci_execute($q_id1);	

    $i=0;
    $exercises = array();
    while($row1 = oci_fetch_array($q_id1, OCI_BOTH+OCI_RETURN_NULLS))
    {
      $exercises[$i] = $row1['EXERCISE_NAME'];
      $i++;
    } 

     $exercise_length = count($exercises);   

     $q2 = "select goal from membershipplan where member_id = '$member_id' ";
     $q_id2 = oci_parse($con,$q2);
     $r2 = oci_execute($q_id2);		
     $row2 = oci_fetch_array($q_id2, OCI_BOTH+OCI_RETURN_NULLS); 		

      $goal = $row2['GOAL'];

    $q3 = "select MAX(exercise_log_dayno) as dayno from exerciselog where member_id = '$member_id' ";
     $q_id3 = oci_parse($con,$q3);
     $r3 = oci_execute($q_id3);		
     $row3 = oci_fetch_array($q_id2, OCI_BOTH+OCI_RETURN_NULLS); 

     $numrows = oci_fetch_all($q_id,$res);
     $dayno=0; 

      if($numrows==0)
      {
        $dayno=1;
      }
      else
      {
        $dayno=$row3['dayno'];
        $dayno++;
      }


?>





<div class="navbar">
  <a href="profile.php"class="p2">Home</a>
  <a href="register.php" class="p2">Sign Up</a>
  <a href="login.php" class="p2">Login</a>
  <a href="about.php" class="p2">About Us</a>
</div>

<div class = "main">

<button class="collapsible">Excercise And Nutrition Logs</button>


<div class="content">
<form method="post">
   </br>
    <label for="goal"><b><h3>Your Goal</h3></b></label>
   <input type="text" value= "<?php echo @$goal;?>" name="goal" readonly></br></br>
 
  <label for="excercise_log_dayno"><b><h3>Your Log Day Number</h3></b></label>
   <input type="text" value= "<?php echo @$dayno;?>" name="excercise_log_dayno" ></br></br>
   <h1> Exercise Log </h1>
  
   <label for="duration"><b>Enter Duration</b></label><br>
   <input type="text" placeholder="Duration" name="duration" ></br></br>
   
     <label for="start"><b>Select Exercise Names</b></label></br></br>

<?php
    $i = 0;
    while($i < $exercise_length) {
        echo " <input type='checkbox' id='".$exercises[$i]."' name='exercise_selected[]' value='".$exercises[$i]."'>";
        echo " <label for='exercise names'>".$exercises[$i] ."</label><br> " ;
        $i++;
    }
?>

<h1> Nutrition Log </h1>

   <label for="carbohydrates_con"><b>Carbohydrates Consumed</b></label><br>
   <input type="text" placeholder="Carbohydrates Consumed" name="carbohydrates_con" ></br></br>
   
   <label for="fats_con"><b>Fats Consumed</b></label><br>
   <input type="text" placeholder="Fats Consumed" name="fats_con" ></br></br>
   
   <label for="proteins_con"><b>Proteins Consumed</b></label><br>
   <input type="text" placeholder="Proteins Consumed" name="proteins_con" ></br></br>
   
   <label for="vitamins_con"><b>Vitamins Consumed</b></label><br>
   <input type="text" placeholder="Vitamins Consumed" name="vitamins_con" ></br></br>
<button type="submit" id="sub7" name="sub7" value="sub7" class="signupbtn"><a style="color: black">Submit</button>

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
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>

<?php

	if(isset($_POST["sub7"]))
	{
		$username = $_GET['name'];
    if(!empty($_POST['exercise_selected']))
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
      
      foreach($_POST['exercise_selected'] as $execise_select )
      {
          echo($execise_select);
          echo "<br>";
      }
   
    }
    else
    {
      //header('Location: ./logs.php?name='.$username);
    }

	}
  
?>

</body>
</html>
