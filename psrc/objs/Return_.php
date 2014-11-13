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
	
	
	public function insertReturn($returnID,$date,$receiptID)
	{
		echo "   adding a return   ";
		global $connection;
		$stmt = $connection->prepare("INSERT INTO Return_ (returnID,date,receiptID) Values (?,?,?)");
		$stmt->bind_param("isi", $returnID, $date, $receiptID);
		echo "binded";
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully added return #".$returnID."</b>";
		}
	}
	
	
	public function queryAllReturns()
	{
		echo "   query a return   ";
		global $connection;
		if(!$result = $connection->query("Select * From Return_")) {
			die('An error occured while running the query on Return_[' .$db->error . ']');
		} else {
			echo "<b>Search is succussfull for Return_<\b>";
		}
		return $result;
	}
	
	
		public function queryReturn($returnID)
	{
		echo "   get the date and receiptID for the return   ";
		global $connection;
		$stmt = $connection->prepare("Select date, receiptID FROM Return_ WHERE returnID=?");
		$stmt->bind_param("is",$returnID);
		$stmt->execute();
		if($stmt->error) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			echo "<b>Search successful<\b>";
		}
		return $result;
	}
	
	
	public function deleteReturn($returnID)
	{
		echo "  deleting a return   ";
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Return_ WHERE returnID=?");
		$stmt->bind_param("is",$returnID);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully deleted the return #".$returnID."</b>";
		}
	}
}
