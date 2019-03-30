<?php

require 'config/config.php';

if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else { //send them back to the register page
	header("Location: register.php");
}

?>
<html>

<head>
	<title>Flock</title>

	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>

<body>
	<div class = "top_bar">

		<div class = "logo">
			
			<a href="index.php">Flock!</a>

		</div>

		<nav>
			<a href="#">
				<?php echo $user['first_name'] ?>
			</a>
			<a href="index.php"><i class="fas fa-home"></i></a>
			<a href="#"><i class="fas fa-envelope"></i></a>
			<a href="#"><i class="fas fa-bell"></i></a>
			<a href="#"><i class="fas fa-users"></i></i></a>
			<a href="#"><i class="fas fa-cogs"></i></a>
			<a href="includes/handlers/logout.php"><i class="fas fa-sign-out-alt"></i></a>


		</nav>
		



	</div>

	<!-- opening tag for wrapper class. The closing tag will be in the index.php -->
	<div class="wrapper">