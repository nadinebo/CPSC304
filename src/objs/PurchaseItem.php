<?php

$connection = NULL;

class PurchaseItem
{
	public function __construct($conn)
	{
		global $connection;
		$connection = $conn;
		error_reporting(E_STRICT);
	}

	public function insertPurchaseItem($receiptID, $UPC, $quantity) 
	{
		//echo "   adding a purchased item   ";
		global $connection;
		$stmt = $connection->prepare("INSERT INTO PurchaseItem (receiptID, upc, quantity) Values (?,?,?)");
		$stmt->bind_param("iii", $receiptID, $UPC, $quantity);

		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b\n", $stmt->error);
		} else {
			//echo "<b>Successfully added purchase item #".$UPC."</b>";
		}
	}

	public function queryAllPurchaseItems()
	{
		//echo "   query a purchase   ";
		global $connection;
		if(!$result = $connection->query("SELECT receiptID,upc,quantity FROM PurchaseItem")) {
			die('There was an error running the query on PurchaseItem[' .$db->error . ']');
		} else {
			//echo "<b>Search is succesful for PurchaseItem</b>";
			return $result;
		}
	}

	public function deletePurchaseItem($receiptID, $UPC)
	{
		//echo "   delete a purchased item   ";
		global $connection;
		$stmt = $connection->prepare("DELETE FROM PurchaseItem WHERE receiptID=? AND UPC=?");
		$stmt->bind_param("ii",$receiptID,$UPC);

		$stmt->execute();
		if ($stmt->error) {
			printf("<b>Error: %s. <b>\n", $stmt->error);
		} else {
			//echo "<b>Successfully deleted purchase item #".$UPC."</b>";
		}
	}
	
	
	public function dailySales($reportDate)
	{
		global $connection;
		if(!$result = $connection->execute("CALL dailySales($reportDate)"))
		{
			die('There was an error running the query [' .$db->error . ']');
		} else {
				return $result;
		}
	}
	
}
?>
