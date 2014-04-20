<?php
	$hostname = 'localhost';        			// Your MySQL hostname. Usualy named as 'localhost', so you're NOT necessary to change this even this script has already online on the internet.
	$dbname   = 'gw2wardrobe'; 		// Your database name.
	$username = 'root';            	// Your database username.
	$password = '';				// Your database password. If your database has no password, leave it empty.
	
	$con = mysqli_connect($hostname, $username, $password, $dbname);

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>
