<?php

$connection = NULL;

class Order_
{
	public function __construct($conn)
	{
		//echo "con";
		global $connection;
		$connection  = $conn;
		error_reporting(E_STRICT);
	}

	//Basic manipulation functions
	public function insertOrder($receiptID,$date,$CID,$cardNum,$expiryDate,$expectedDate,$deliveredDate)
	{
		global $connection;
		$stmt = $connection->prepare("INSERT INTO Order_ (receiptID,date,cid,cardNum,expiryDate,expectedDate,deliveredDate) Values (?,?,?,?,?,?,?)");
		$stmt->bind_param("isiisss", $receiptID, $date, $CID, $cardNum, $expiryDate, $expectedDate,$deliveredDate);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
			return $stmt->error;
		}
			return 0;
	}

	public function queryAllOrders()
	{
		global $connection;
		if(!$result = $connection->query("SELECT receiptID,date,cid,cardNum,expiryDate,expectedDate,deliveredDate From Order_")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			return $result;
		}
	}

	public function deleteOrder($receiptID)
	{
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Order_ WHERE receiptID=?");
		$stmt->bind_param("i",$receiptID);
		$stmt->execute();
		if($stmt->error) {
			echo "<br>Nothing to delete";
			return $stmt->error;
		} else {
			//echo "<br>Successfully deleted order ".$receiptID."<br>";
			return 0;
		}
	}
}
