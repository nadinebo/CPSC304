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
		//echo "   adding a return   ";
		global $connection;
		$stmt = $connection->prepare("INSERT INTO Return_ (retID, returnDate, receiptID) Values (?,?,?)");
		$stmt->bind_param("isi", $retID, $returnDate, $receiptID);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
			return $stmt->error;
		} else {
			return 0;
			//echo "<b>Successfully added return #".$retID."</b>";
		}
	}
	
	
	public function queryAllReturns()
	{
		//echo "   query a return   ";
		global $connection;
		if(!$result = $connection->query("Select * From Return_")) {
			die('An error occured while running the query on Return[' .$db->error . ']');
		} else {
			//echo "<b>Search is succussfull for Return</b>";
		}
		return $result;
	}
	
	
		public function queryReturn($retID)
	{
		//echo "   get the date and receiptID for the return   ";
		global $connection;
		$stmt = $connection->prepare("Select returnDate, receiptID FROM Return_ WHERE retID=?");
		$stmt->bind_param("i",$retID);
		$stmt->execute();
		if($stmt->error) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			//echo "<b>Search successful<\b>";
		}
		return $result;
	}
	
	
	public function deleteReturn($retID)
	{
		//echo "  deleting a return   ";
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Return_ WHERE retID=?");
		$stmt->bind_param("i",$retID);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
			return $stmt->error;
		} else {
			return 0;
			//echo "<b>Successfully deleted the return #".$retID."</b>";
		}
	}
}
