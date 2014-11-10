<?php

$connection = NULL;

function initData()
{
		echo "Welcome to Houns ";
		$server = '127.0.0.1';
		$user = 'root';
		$pass = '';
		$dbname = 'Houns';
		
		global $connection;
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

//Basic manipulation functions
function insertLeadSinger($UPC,$Name)
{
	error_reporting(E_STRICT);
	echo "   inserting lead singer   ";
	global $connection;
	$stmt = $connection->prepare("INSERT INTO LeadSinger (upc,name) Values (?,?)");
	$stmt->bind_param("is", $UPC, $Name);
	$stmt->execute();
	if($stmt->error) {
		printf("<b>Error: %s. </b>\n", $stmt->error);
	} else {
		echo "<b>Successfully added ".$Name."</b>";
	}
}

function selectLeadSinger()
{
	error_reporting(E_STRICT);
	echo "   query lead singer   ";
	global $connection;
	if(!$result = $connection->query("Select * From LeadSinger")) {
		die('There was an error running the query [' .$db->error . ']');
	} else {
		echo "<b>Search succussfull<\b>";
	}
	return $result;

}

function deleteLeadSinger($UPC,$Name)
{
	error_reporting(E_STRICT);
	echo "  deleting lead singer   ";
	global $connection;
	$stmt = $connection->prepare("DELETE FROM LeadSinger WHERE upc=? AND name=?");
	$stmt->bind_param("is",$UPC,$Name);
	$stmt->execute();
	if($stmt->error) {
		printf("<b>Error: %s. </b>\n", $stmt->error);
	} else {
		echo "<b>Successfully deleted ".$Name."</b>";
	}
}

?>
