<?php

// variable to hold connection to our database
$con = mysqli_connect("localhost","root","","flock");

if(mysqli_connect_errno()) {
	echo "Failed to connect: " . mysqli_connect_errno();
}
$query = mysqli_query($con, "INSERT INTO test VALUES('','Mehdi')");
?>
<html>
<head>
	<title>Flock</title>
</head>
<body>

</body>
</html>