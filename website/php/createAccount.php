<?php
	require_once(__DIR__."/databases.php"); // Allow access to the database functions
	require_once(__DIR__."/sessions.php"); // Allow access to the sessions functions

	// DECODE THE INFORMATION (IT IS PASSED IN JSON FORMAT)
	$post_json = file_get_contents("php://input");
	$post = json_decode($post_json, true);

	$email = $post['email'];
	$password = $post['password'];

	if(existsInDatabase("SELECT * FROM users WHERE email = '$email'")) {
		echo "email"; // 'Error Code' that will be tested in the java script and will let the user know the email has already been registered
	}

	else {
		addToDatabase("INSERT INTO users(fname, lname, pword, email) VALUES('TEST', 'USER', '$pword', '$email')");
		startSession($email)
		echo "success";
	}
?>
