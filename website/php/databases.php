<?php


	// ADDS INFO TO THE DATABASE BASED ON THE QUERY THAT IS PASSED IN
	function addToDatabase($query) {
		$con = establishConnection();
		mysqli_query($con, $query);
		mysqli_close($con);
	}

	function getUserIdFromEmail($email) {
		$user_id = getInfoFromDatabase("SELECT user_id FROM users WHERE email = '$email'"); 
		return $user_id[0]['user_id'];
	}

	// RETURNS TRUE IF THE QUERY RETURNS ANY NUMBER OF RESULTS, FALSE OTHERWISE
	function existsInDatabase($query) {
		$con = establishConnection();
		$result = mysqli_query($con, $query);

		if(!$result || mysqli_num_rows($result) == 0) {
			mysqli_close($con);
			return FALSE;
		}
		else {
			mysqli_close($con);
			return TRUE;
		}
	}

	// RETURNS THE RESULTS OF A QUERY AS AN ASSOCIATIVE ARRAY
	function getInfoFromDatabase($query) {
		$con = establishConnection();
		$result = mysqli_query($con, $query);
		mysqli_close($con);

		$return_array = array();
		if($result) {
			while($r = mysqli_fetch_assoc($result)) {
			    $return_array[] = $r;
			}
		}

		return $return_array;
	}


	// UTILITY FUNCTION THAT CONNECTS TO OUR RIPPLE DB
	function establishConnection() {
		$con = mysqli_connect('localhost', 'root', 'mysqlpassword', 'Ripple');
		if (!$con) {
    		die('Could not connect: ' . mysqli_error($con));
		}
		return $con;
	}

?>
