
<html>
<body>
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
  padding: 5px 5px;
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
    padding: 25px;
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
  background-color: #333;
  color: white;
  padding: 0px 0px;
  border: none;
  cursor: pointer;
  width: 15%;
  text-align: center;
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
Report
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

    $q1 = "select * from workout_plan where member_id = '$member_id'";
    $q_id1 = oci_parse($con,$q1);
    $r1 = oci_execute($q_id1);
    

  $goal='';  
  $muscle_groups='';
  $exercises = '';
  $equipmemts ='';
  $Times=''; 
  $equipmemts='';
  while($row1 = oci_fetch_array($q_id1, OCI_BOTH+OCI_RETURN_NULLS))
  {
    $goal= $row1['GOAL'];
    $exercises .= $row1['EXERCISE_NAME'].', ';
    $muscle_groups .=$row1['MUSCLE_GROUP'].', ';
    $Times .= $row1['WORKOUT_TIME'].', ';
    $equipmemts .= $row1['EQUIPMENT'].', ';
  }


  $q2 = "select * from nutritionalplan where member_id = '$member_id'";
  $q_id2 = oci_parse($con,$q2);
  $r2 = oci_execute($q_id2);
  $row2 = oci_fetch_array($q_id2, OCI_BOTH+OCI_RETURN_NULLS);

  $status=$row2['NUTRITION_STATUS'];
  $carbs=$row2['CARBOHYDRATES'];
  $fats=$row2['FATS'];
  $proteins=$row2['PROTEINS'];
  $vitamins=$row2['VITAMINS'];

?>
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
	  
	  
	  <button type="submit" class="btn" id="LogOut" name="LogOut" value="LogOut" >
        <a style = "color:white" class="p2" >Log Out</a>
      </button> 
    </form>
        

    </div>

<div class = "main">
<button class="collapsible" >Excercise Plan</button>
<div class="content">
   </br>
   <label for="goal"><b>Goal</b></label><br>
   <input type="text" value= "<?php echo @$goal;?>"  name="goal" required readonly></br></br>
   
   <label for="muscle group"><b>Muscle Group</b></label><br>
   <input type="text" value= "<?php echo @$muscle_groups;?>"  name="group" required readonly></br></br>
	
   <label for="exercise names"><b>Exercise Names</b></label><br>
   <input type="text" value= "<?php echo @$exercises;?>" name="names" required readonly></br></br>
   
   <label for="exercise equipment"><b>Exercise Equipment </b></label><br>
   <input type="text" value= "<?php echo @$equipmemts;?>" name="equipment" required readonly></br></br>
 
 
  <label for="time"><b>Exercise Times</b></label><br>
   <input type="text" value= "<?php echo @$Times;?>" name="time" required readonly></br></br> 
   
   

 
</div>
<button class="collapsible">Nutrition Plan</button>
<div class="content">
<br>   

    <label for="status"><b>Nutrition Status</b></label><br>
   <input type="text" value= "<?php echo @$status;?>" name="status" required readonly></br></br>
   
   <label for="carbohydrates_con"><b>Carbohydrates to Consume</b></label><br>
   <input type="text" value= "<?php echo @$carbs;?>" name="carbohydrates_con" required readonly></br></br>
   
   <label for="fats_con"><b>Fats to Consume</b></label><br>
   <input type="text" value= "<?php echo @$fats;?>" name="fats_con" required readonly></br></br>
   
   <label for="proteins_con"><b>Proteins to Consume</b></label><br>
   <input type="text" value= "<?php echo @$proteins;?>" name="proteins_con" required readonly></br></br>
   
   <label for="vitamins_con"><b>Vitamins to Consume</b></label><br>
   <input type="text" value= "<?php echo @$vitamins;?>" name="vitamins_con" required readonly></br></br>
   </div>


  <img src="iStock-871070868.jpg" width= '100%' height='110%' >
 
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