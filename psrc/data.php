<?php

function initData()
{
		echo "Welcome to Houns ";
		$server = '127.0.0.1';
		$user = 'root';
		$pass = '';
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
}
?>
