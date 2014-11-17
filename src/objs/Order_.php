<?php

$connection = NULL;

class Order_
{
	public function __construct($conn)
	{
		echo "con";
		global $connection;
		$connection  = $conn;
		error_reporting(E_STRICT);
	}

	//Basic manipulation functions
	public function insertOrder($receiptID,$date,$CID,$cardNum,$expiryDate,$expectedDate)
	{
		echo "<br>   creating a new order   ";
		global $connection;
		$stmt = $connection->prepare("INSERT INTO Order_ (receiptID,date,cid,cardNum,expiryDate,expectedDate) Values (?,?,?,?,?,?)");
		$stmt->bind_param("isiiss", $receiptID, $date, $CID, $cardNum, $expiryDate, $expectedDate);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully added new order for ".$CID."</b>";
		}
	}

	public function queryOrder($CID)
	{
		global $connection;
		$stmt = $connection->prepare("SELECT receiptID, cid, date FROM Order_ WHERE cid=?");
		$stmt->bind_param("s",$CID);
		$stmt->execute();
		if($stmt->error) {	
			die('There was an error running the query [' .$db->error . ']');
		} else {
			return $result;
		}
	}

	public function queryAllOrders()
	{
		global $connection;
		if(!$result = $connection->query("SELECT * From Order_")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			return $result;
		}
	}

	public function deleteOrder($receiptID)
	{
		echo "<br>  deleting order   ";
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Order_ WHERE receiptID=?");
		$stmt->bind_param("s",$receiptID);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully deleted ".$receiptID."</b>";
		}
	}
}
