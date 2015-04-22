<?php
	require_once(__DIR__."/databases.php"); // Allow access to the database functions

	$defaultPoints = 10;

	function checkPoints($email) {
		$points = getPoints($email);

		global $defaultPoints;
		if(($points - $defaultPoints) < 0) // They don't have enough points to complete a drop
			return FALSE;
		else
			return TRUE;
	}

	function subtractDefaultPoints($email) {
		$points = getPoints($email);

		global $defaultPoints;
		$points = $points - $defaultPoints;

		updatePoints($email, $points);
	}

	function getPrevDropId($song_id) {
		$query = "SELECT drop_id FROM drops WHERE song_id = $song_id ORDER BY time_stamp DESC";
		$redrop = getInfoFromDatabase($query);
		return $redrop[0]['drop_id']; 
	}


	function updatePoints($email, $points) {
		$query = "UPDATE users SET points=$points WHERE email='$email'";
		addToDatabase($query);
	}

	function getPoints($email) {
		$query = "SELECT points FROM users WHERE email = '$email'";

		$points = getInfoFromDatabase($query);
		$points = $points[0]['points'];

		return $points;
	}

	function insertDrop($email, $song_id, $latitude, $longitude, $prev_id = 0) {
		$user_id = getUserIdFromEmail($email);
		$query = "INSERT INTO drops(user_id, song_id, prev_drop_id, latitude, longitude)
				  VALUES($user_id, $song_id, $prev_id, $latitude, $longitude)";
		addToDatabase($query);
	}




?>