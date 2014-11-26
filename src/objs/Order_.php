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

	public function get_NumOrders($expectedDate){
		
		global $connection;
		$result = $connection->prepare("SELECT COUNT(*) as Num From Order_ where expectedDate=?");
		$result->bind_param("s",$expectedDate);
		$result->execute();
		$result->bind_result($Num);
		
		$result->fetch();
		return $Num;

	}


	//Basic manipulation functions
	public function insertOrder($receiptID,$date,$CID,$cardNum,$expiryDate) //,$expectedDate,$deliveredDate)
	{
		global $connection;
		$maxOrders = 3;
		$expectedDateMin = 14;
		$exp = strtotime($date);
		$expectedDate = date('Y-m-d', mktime(0,0,0,date('m',$exp),date('d',$exp)+$expectedDateMin,date('Y',$exp)));
		
		$i=1;
		while ($this->get_NumOrders($expectedDate) >= $maxOrders)
		{
			$expectedDate = date('Y-m-d', mktime(0,0,0,date('m',$exp),date('d',$exp)+$expectedDateMin+$i,date('Y',$exp)));
			$i++;
		};
		
		$stmt = $connection->prepare("INSERT INTO Order_ (receiptID,date,cid,cardNum,expiryDate,expectedDate) Values (?,?,?,?,?,?)");
		$stmt->bind_param("isiiss", $receiptID, $date, $CID, $cardNum, $expiryDate,$expectedDate);

		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
			return $stmt->error;
		}
			return 0;
	}

	public function updateDelivery($receiptID,$deliveredDate)
	{
		global $connection;
		$stmt = $connection->prepare("update Order_ set deliveredDate=? where receiptID=?");
		$stmt->bind_param("si", $deliveredDate,$receiptID);
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
