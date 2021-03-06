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
		global $connection;
		$stmt = $connection->prepare("INSERT INTO LeadSinger (upc,name) Values (?,?)");
		$stmt->bind_param("is", $UPC, $Name);
		$stmt->execute();
		if($stmt->error) {
			return $stmt->error;
		} else {
			return 0;
		}
	}

	public function queryAllLeadSingers()
	{
		global $connection;
		if(!$result = $connection->query("Select * From LeadSinger")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
		}
		return $result;
	}

	public function deleteLeadSinger($UPC,$Name)
	{
		global $connection;
		$stmt = $connection->prepare("DELETE FROM LeadSinger WHERE upc=? AND name=?");
		$stmt->bind_param("is",$UPC,$Name);
		$stmt->execute();
		if($stmt->error) {
			return $stmt->error;
		} else {
			return 0;
		}
	}
}
