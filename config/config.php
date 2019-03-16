<?php

// Turns on output buffering

//PHP is loaded to a broswer in sections. What this line does is saving the data when php is loaded and passing the data to the browser all at once when it is loaded. Saves a lot of headaches wehn it comes to hosting the website
ob_start();

session_start();

// For status updates to see how long ago a status was posted
$timezone = date_default_timezone_set("America/New_York");

// variable to hold connection to our database
$con = mysqli_connect("localhost","root","","flock");

// checks to see if connection to the database was successful
if(mysqli_connect_errno()) {
	echo "Failed to connect: " . mysqli_connect_errno();
}

?>
