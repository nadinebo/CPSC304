<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
</head>

<body>
	<?php
		echo "Welcome to Houns ";
		$server = '127.0.0.1';
		$user = 'root';
		$pass = 'iwicbV15';
		$dbname = 'Houns';

		$connection = new mysqli($server, $user, $pass, $dbname);
		mysql_select_db($dbname);
		echo "Connection attempt made";
	    
	    if (!mysqli_connect_errno()) {
	        echo "You connected!";
	    }
	
	// Check that the connection was successful, otherwise exit
	    if (mysqli_connect_errno()) {
	        printf("Connect failed: %s\n", mysqli_connect_error());
	        exit();
	    }	
	
	?>
</body>
</html>
