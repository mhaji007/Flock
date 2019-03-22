<?php

require 'config/config.php';

if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
}
else { //send them back to the register page
	header("Location: register.php");
}

?>
<html>
<head>
	<title>Flock</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>
<body>