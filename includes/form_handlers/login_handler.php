<?php

if(isset($_POST['login_button'])) {

	// Sanitize email
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);

	// Store email into session variable
	$_SESSION['log_email'] = $email;

	// Get password
	$passowrd = md5($_POST['log_password']);

	$check_database_query = mysqli($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
	$check_login_query = mysqli_num_rows($check_databasee_query);

	if($check_login_query == 1) {

		// Store the result of the query in row variable in array format
		$row = mysqli_fetch_array($check_database_query);

		// Access the column related to username
		$username = $row['username'];
		
		// As long as this session variable contains the username and is not nill, that means the the user is logged in. everytime we load a page inside our website, we are going to check and see whether the session varaible contains a value. If it doesn;t it means either the user isn't logged in or is trying to accees the page without being logged in and we are going to redirect them to the log in page
		$_SESSION ['username'] = $username;

		// If they are logged in redirect the users to the index page
		header("Location: index.php");
		exit();
	}

}

?>