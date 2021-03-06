<?php

if(isset($_POST['login_button'])) {

	// Sanitize email
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);

	// Store email into session variable
	$_SESSION['log_email'] = $email;

	// Get password
	$password = md5($_POST['log_password']);

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 1) {
		echo "$check_login_query";
		// Store the result of the query in row variable in array format
		$row = mysqli_fetch_array($check_database_query);

		// Access the column related to username
		$username = $row['username'];

		// If a user had closed their account and try to log in, reopen the account 
		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND user_closed = 'yes'");
		if(mysqli_num_rows($user_closed_query) == 1) {
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed = 'no' WHERE email = '$email'");
		}
		
		// As long as this session variable contains the username and is not nill, that means the the user is logged in. everytime we load a page inside our website, we are going to check and see whether the session varaible contains a value. If it doesn;t it means either the user isn't logged in or is trying to accees the page without being logged in and we are going to redirect them to the log in page
		$_SESSION ['username'] = $username;

		// If they are logged in redirect the users to the index page
		header("Location: index.php");
		exit();
	}
	else {

		array_push($error_array, "Email or password was incorrect<br>");
	}

}

?>