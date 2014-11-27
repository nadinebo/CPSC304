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
		global $connection;
		$stmt = $connection->prepare("INSERT INTO ReturnItem (retID,UPC,returnQuantity) Values (?,?,?)");
		$stmt->bind_param("iii", $retID, $UPC, $returnQuantity);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
			return $stmt->error;
		} else {
			
			// update stock
			$result = $connection->prepare("UPDATE Item_ set stock = stock + ? where upc = ?");
			$result->bind_param("ii", $returnQuantity, $UPC);

			$result->execute();
			return 0;
		}
	}
	
	
	public function queryAllReturnItems()
	{
		global $connection;
		if(!$result = $connection->query("Select retID,returnQuantity,upc From ReturnItem")) {
			die('An error occured while running the query on ReturnItem[' .$db->error . ']');
		} else {
		}
		return $result;
	}
	
	
		public function queryReturnItem($retID, $UPC)
	{
		global $connection;
		$stmt = $connection->prepare("Select returnQuantity FROM Return_ WHERE retID=? AND upc=?");
		$stmt->bind_param("ii",$retID, $UPC);
		$stmt->execute();
		if($stmt->error) {
			die('There was an error running the query [' .$db->error . ']');
			return $stmt->error;
		} else {
		}
		return $result;
	}
	
	
	public function deleteReturn($retID, $UPC)
	{
		global $connection;
		$stmt = $connection->prepare("DELETE FROM ReturnItem WHERE retID=? AND upc=?");
		$stmt->bind_param("ii",$retID, $UPC);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
			return $stmt->error;
		} else {
			return 0;
		}
	}
}
