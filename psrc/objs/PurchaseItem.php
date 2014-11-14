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

	public function insertPurchaseItem($receiptID, $UPC, $purchaseQuantity) 
	{
		echo "   adding a purchased item   ";
		global $connection;
		$stmt = $connection->prepare("INSERT INTO PurchaseItem (receiptID, UPC, purchaseQuantity) Values (?,?,?)");
		$stmt->bind_param("is", $receiptID, $UPC, $purchaseQuantity);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b\n", $stmt->error);
		} else {
			echo "<b>Successfully added purchase item #".$UPC."</b>";
		}
	}

	public function queryAllPurchaseItems()
	{
		echo "   query a purchase   ";
		global $connection;
		if(!$result = $connection->query("Select * FROM PurchaseItem") {
			die('There was an error running the query on PurchaseItem[' .$db->error . ']');
		} else {
			echo "<b>Search is succesful for PurchaseItem";
		}
	}

	public function deletePurchaseItem($receiptID, $UPC)
	{
		echo "   delete a purchased item   ";
		global $connection;
		$stmt = $connection->prepare("DELETE FROM PurchaseItem WHERE receiptID=? AND UPC=?");
		$stmt->bind_param("is",$receiptID,$UPC);
		$stmt->execute();
		if ($stmt->error) {
			printf("<b>Error: %s. <b>\n", $stmt->error);
		} else {
			echo "<b>Successfully deleted purchase item #".$UPC."</b>";
		}
	}
}
?>