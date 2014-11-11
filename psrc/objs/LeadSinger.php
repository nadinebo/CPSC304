<?php

$connection = NULL;

class LeadSinger
{
	public function __construct($conn)
	{
		global $connection;
		$connection  = $conn;
		error_reporting(E_STRICT);
	}

	//Basic manipulation functions
	public function insertLeadSinger($UPC,$Name)
	{
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

	public function queryAllLeadSingers()
	{
		echo "   query lead singer   ";
		global $connection;
		if(!$result = $connection->query("Select * From LeadSinger")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			echo "<b>Search succussfull<\b>";
		}
		return $result;
	}

	public function deleteLeadSinger($UPC,$Name)
	{
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
}
