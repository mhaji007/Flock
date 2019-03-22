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
</head>
<body>