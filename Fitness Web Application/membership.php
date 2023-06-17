<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.bg-img {
  /* The image used */
  background-image: url("iStock-871070868.jpg");

  min-height: 1200px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
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

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
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

button:hover {
  opacity:1;
}


.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 400px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
</head>
<title>
Membership
</title>
<body>


<div class="bg-img">
  <form method="post" action="/action_page.php" class="container" required>
    <h1>Enter Plan Details</h1>
	
	<label for="start"><b>Goal</b></label></br></br>
	
  <input type="radio" id="Goal" name="goal" value="LoseWeight" required>
  <label for="target1">Lose Weight</label><br>
  
  <input type="radio" id="Goal" name="goal" value="Fitter" required>
  <label for="target2">Getting Fitter</label><br>
  
  <input type="radio" id="Goal" name="goal" value="Muscle" required>
  <label for="target3">Gain Muscle</label><br><br>
	
  
  
  <label for="start"><b>Total Days</b></label></br></br>
	
	
	<input type="radio" id="Days" name="Days" value="7" required>
  <label for="td0">7</label><br>
  
  <input type="radio" id="Days" name="Days" value="14" required>
  <label for="td1">14</label><br>
  
  <input type="radio" id="Days" name="Days" value="30" required>
  <label for="td2">30</label><br>
  
  <input type="radio" id="Days" name="Days" value="60" required>
  <label for="td3">60</label><br>
  
  <input type="radio" id="Days" name="Days" value="90" required>
  <label for="td4">90</label><br><br>
  
  
  
  <label for="start"><b>Select Plan</b></label></br></br>
  <form action="/action_page.php" required>
 
 
  <div class="clearfix">
     <button type="button" class="cancelbtn"><a href="profile.html" style="color: black">Create Yourself</a>
     </button >
     <button type="button" class="signupbtn"><a href="plans.html" style="color: black">Generate Plan</a></button>
  </div>
 </form> 
</div>


</body>
</html>


