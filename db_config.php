 <?php
	$servername = "mysql.hostinger.es";
	$username = "u701737716_root";
	$password = "sistemasweb17";
	$dbname = "u701737716_sw17";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

?> 