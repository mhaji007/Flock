<?php


//Declaring varaibles to prevent errors
$fname = ""; // First name
$lname = ""; //Last name
$em = ""; //email
$em2 = ""; //email 2
$password = ""; //password
$password2 = ""; //password 2
$date = ""; //Sign up date
$error_array=array(); //Holds error messages

// if the register button is set start handling the form
if(isset($_POST['register_button'])) {

	// Registration form values
	// strip_tags is a security measure that takes away html tags that might
	// add some unwanted code to your website


		/// First name ///
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
		//filter_var(variable) similar to strip_tags but also filter and
		//sanitizes the variable as well as stripping the script tags
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			// Check if email already exists
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

			// Checking the error
			// echo "Error: " . mysqli_error($con)

			// Count number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				//echo "Email already in use";
				array_push($error_array, "Email already in use<br>");
			}
		}
		else {
			//echo "Invalid format";
			array_push($error_array, "Invalid email format<br>");
		}

	}
	else {
		//echo "Emails don't match";
		array_push($error_array, "Emails don't match<br>");
	}

	if(strlen($fname) > 25 || strlen($fname)<2 ) {
		//echo "Your first name must be between 2 and 25 characters";
		array_push($error_array,"Your first name must be between 2 and 25 characters<br>");
	}

	if(strlen($lname) > 25 || strlen($lname)<2 ) {
		//echo "Your last name must be between 2 and 25 characters";
		array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
	}

	if($password != $password2) {
		//echo "Your passwords do not match";
		array_push($error_array, "Your passwords do not match<br>");
	}

	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)) {
			//echo "Your password can only contain English characters or numbers";
			array_push($error_array, "Your password can only contain English characters or numbers<br>");
		}
	}

	if(strlen($password) > 30 || strlen($password) < 5 ) {
		//echo "Your password must be between 5 and 30 characters";
		array_push($error_array,"Your password must be between 5 and 30 characters<br>");
	}

	if(empty($error_array)) {
		
		//Encrypt password before sending to database
		$password = md5($password);

		//Generate username by concatenating first name and last name
		$username = strtolower($fname . "_" . $lname);

		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username ='$username'");

		$i = 0;

		//if username exists add number to the username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++;
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username ='$username'");
		}

		//Profile picture assignment

		// random number between 1 and 2
		$rand = rand(1,2);
		
		if($rand==1)
			$profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
		else if($rand == 2)
			$profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";

		$query = mysqli_query($con, "INSERT INTO users VALUES ('','$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic','0','0','no',',')");

		array_push($error_array, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>");

		//Clear session variables
		$_SESSION['reg_fname'] ="";
		$_SESSION['reg_lname'] ="";
		$_SESSION['reg_email'] ="";
		$_SESSION['reg_email2'] ="";
	}





}
?>