
<html>
<body>

<?php
	if($_GET)
	{

		$username = $_GET['name'];
        echo($username);

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
            
			$q2 = "CALL insert_plan('$member_id','$goal') ";
			$q_id2 = oci_parse($con,$q2);
			$r2 = oci_execute($q_id2);

			header('Location: ./profile.php?name='.$username );
			echo"<br>";
	}	 
?>

</body>
</html>