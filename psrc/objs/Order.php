<?php

$connection = NULL;

class Order_
{
	public function __construct($conn)
	{
		global $connection;
		$connection  = $conn;
		error_reporting(E_STRICT);
	}

	//Basic manipulation functions
	public function insertOrder($date,$CID,$cardNum,$expiryDate,$expectedDate)
	{
		echo "   creating a new order   ";
		global $connection;
		$stmt = $connection->prepare("INSERT INTO Order_ (date,cid,cardNum,expiryDate,expectedDate) Values (?,?,?,?,?)");
		$stmt->bind_param("is", $date, $CID, $cardNum, $expiryDate, $expectedDate);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully added new order for ".$CID."</b>";
			$query = $queryOrder($CID);
			return $query;
		}
	}

	public function queryOrder($CID)
	{
		echo "   get the most recent order for this customer   ";
		global $connection;
		$stmt = $connection->query("Select max(receiptID), cid, max(date) FROM Order_ WHERE cid=?");
		$stmt->bind_param("is",$CID);
		$stmt->execute();
		if($stmt->error) {	
			die('There was an error running the query [' .$db->error . ']');
		} else {
			echo "<b>Search successful<\b>";
		}
		return $result;
	}

	public function queryAllOrders()
	{
		echo "   query orders   ";
		global $connection;
		if(!$result = $connection->query("Select * From Order_")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			echo "<b>Search successful<\b>";
		}
		return $result;
	}

	public function deleteOrder($receiptID)
	{
		echo "  deleting order   ";
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Order_ WHERE receiptID=?");
		$stmt->bind_param("is",$UPC,$Name);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully deleted ".$receiptID."</b>";
		}
	}
}
