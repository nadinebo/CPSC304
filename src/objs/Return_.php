<?php
$connection = NULL;
class Return_
{
	public function __construct($conn)
	{
		global $connection;
		$connection  = $conn;
		error_reporting(E_STRICT);
	}
	
	
	public function insertReturn($retID,$returnDate,$receiptID)
	{
		echo "   adding a return   ";
		global $connection;
		$stmt = $connection->prepare("INSERT INTO Return_ (retID, returnDate, receiptID) Values (?,?,?)");
		//$stmt = $connection->prepare("INSERT INTO `Return` (returnID,date,receiptID) Values (?,?,?)");
		$stmt->bind_param("sss", $retID, $returnDate, $receiptID);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully added return #".$retID."</b>";
		}
	}
	
	
	public function queryAllReturns()
	{
		echo "   query a return   ";
		global $connection;
		if(!$result = $connection->query("Select * From Return_")) {
		//if(!$result = $connection->query("Select * From `Return`")) {
			die('An error occured while running the query on Return[' .$db->error . ']');
		} else {
			echo "<b>Search is succussfull for Return<\b>";
		}
		return $result;
	}
	
	
		public function queryReturn($retID)
	{
		echo "   get the date and receiptID for the return   ";
		global $connection;
		$stmt = $connection->prepare("Select returnDate, receiptID FROM Return_ WHERE retID=?");
		//$stmt = $connection->prepare("Select date, receiptID FROM `Return_ WHERE returnID=?");
		$stmt->bind_param("s",$retID);
		$stmt->execute();
		if($stmt->error) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			echo "<b>Search successful<\b>";
		}
		return $result;
	}
	
	
	public function deleteReturn($retID)
	{
		echo "  deleting a return   ";
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Return_ WHERE retID=?");
		//$stmt = $connection->prepare("DELETE FROM `Return` WHERE returnID=?");
		$stmt->bind_param("s",$retID);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully deleted the return #".$retID."</b>";
		}
	}
}