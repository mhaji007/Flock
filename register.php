<?php

session_start();

// variable to hold connection to our database
$con = mysqli_connect("localhost","root","","flock");

// checks to see if connection to the database was successful
if(mysqli_connect_errno()) {
	echo "Failed to connect: " . mysqli_connect_errno();
}

//Declaring varaibles to prevent errors
$fname = ""; // First name
$lname = ""; //Last name
$em = ""; //email
$em2 = ""; //email 2
$password = ""; //password
$password2 = ""; //password 2
$date = ""; //Sign up date
$error_array=""; //Holds error messages

// if the register button is set start handling the form
if(isset($_POST['register_button'])) {

	// Registration form values
	// strip_tags is a security measure that takes away html tags that might
	
		/// First name ///

	// add some unwanted code to your website
	$fname = strip_tags($_POST['reg_fname']);

	// removes spaces. str_replace(search, replace, subject)
	$fname = str_replace('', '', $fname);

	// Capitalizes only the first letter
	$fname = ucfirst(strtolower($fname));

	// Stores first name into session variable
	$_SESSION['reg_fname'] = $fname;

		/// Last name ///

	$lname = strip_tags($_POST['reg_lname']);

	$lname = str_replace('', '', $lname);

	$lname = ucfirst(strtolower($lname));

	$_SESSION['reg_lname'] = $lname;


		/// Email ///

	$em = strip_tags($_POST['reg_email']);

	$em = str_replace('', '', $em);

	$em = ucfirst(strtolower($em));

	$_SESSION['reg_email'] = $em;

		/// Email 2 ///

	$em2 = strip_tags($_POST['reg_email2']);

	$em2 = str_replace('', '', $em2);

	$em2 = ucfirst(strtolower($em2));

	$_SESSION['reg_email2'] = $em2;

		/// Password ///

	$password = strip_tags($_POST['reg_password']);

		/// Password 2 ///

	$password2 = strip_tags($_POST['reg_password2']);

	//Gets the current date
	$date = date ("Y-m-d"); 


	if($em == $em2) {
	// Check if email is in valid format
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			// Check if email already exists
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

			// Checking the error
			// echo "Error: " . mysqli_error($con)

			// Count number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				echo "Email already in use";
			}
		}
		else {
			echo "Invalid format";
		}

	}
	else {
		echo "Emails don't match";
	}

	if(strlen($fname) > 25 || strlen($fname)<2 ) {
		echo "Your first name must be between 2 and 25 characters";
	}

	if(strlen($lname) > 25 || strlen($lname)<2 ) {
		echo "Your last name must be between 2 and 25 characters";
	}

	if($password != $password2) {
		echo "Your passwords do not match";
	}

	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			echo "Your password can only contain English characters or numbers";
		}
	}

	if(strlen($password) > 30 || strlen($password) < 5 ) {
		echo "Your password must be between 5 and 30 characters";
	}





}
?>



<html>
<head>
	<title>Welcom to Flock!</title>
</head>
<body>


	<form action="register.php" method="POST">
		<input type="text" name="reg_fname" placeholder="First Name" value="<?php
		if(isset($_SESSION['reg_fname'])) {
			echo $_SESSION['reg_fname'];
		} ?>"required>
		<br>
		<input type="text" name="reg_lname" placeholder="Last Name" value=" <?php
		if(isset($_SESSION['reg_lname'])) {
			echo $_SESSION['reg_lname'];
		} ?>"required>
		<br>
		<input type="email" name="reg_email" placeholder="Email" value= "<?php
		if(isset($_SESSION['reg_email'])) {
			echo $_SESSION['reg_email'];
		} ?>" required>
		<br>
		<input type="email" name="reg_email2" placeholder="Confirm Email" value = "<?php
		if(isset($_SESSION['reg_email2'])) {
			echo $_SESSION['reg_email2'];
		} ?>"required>
		<br>
		<input type="password" name="reg_password" placeholder="Password" value="<?php
		if(isset($_SESSION['reg_password'])) {
			echo $_SESSION['reg_password'];
		} ?>" required>
		<br>
		<input type="password" name="reg_password2" placeholder="Confirm Password" value ="<?php
		if(isset($_SESSION['reg_password2'])) {
			echo $_SESSION['reg_password2'];
		} ?>" required>
		<br>
		<input type="submit" name="register_button" value="Register">
	</form>

</body>
</html>