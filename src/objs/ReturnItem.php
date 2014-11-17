<?php
$connection = NULL;
class ReturnItem
{
	public function __construct($conn)
	{
		global $connection;
		$connection  = $conn;
		error_reporting(E_STRICT);
	}
	
	
	public function insertReturnItem($retID,$UPC,$returnQuantity)
	{
		echo "   adding a return item  ";
		global $connection;
		$stmt = $connection->prepare("INSERT INTO ReturnItem (retID,UPC,returnQuantity) Values (?,?,?)");
		$stmt->bind_param("sss", $retID, $UPC, $returnQuantity);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully added return item #".$UPC."</b>";
		}
	}
	
	
	public function queryAllReturnItems()
	{
		echo "   query a return   ";
		global $connection;
		if(!$result = $connection->query("Select * From ReturnItem")) {
			die('An error occured while running the query on ReturnItem[' .$db->error . ']');
		} else {
			echo "<b>Search is succussfull for ReturnItem<\b>";
		}
		return $result;
	}
	
	
		public function queryReturnItem($retID, $UPC)
	{
		echo "   get the quantity for the return item  ";
		global $connection;
		$stmt = $connection->prepare("Select returnQuantity FROM Return_ WHERE retID=? AND upc=?");
		$stmt->bind_param("ss",$retID, $UPC);
		$stmt->execute();
		if($stmt->error) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			echo "<b>Search is successful for ReturnItem<\b>";
		}
		return $result;
	}
	
	
	public function deleteReturn($retID, $UPC)
	{
		echo "  deleting a return item   ";
		global $connection;
		$stmt = $connection->prepare("DELETE FROM ReturnItem WHERE retID=? AND upc=?");
		$stmt->bind_param("ss",$retID, $UPC);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully deleted the return item #".$UPC."</b>";
		}
	}
}