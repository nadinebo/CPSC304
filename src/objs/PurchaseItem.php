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
			return $stmt->error;
		} else {
			return 0;
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
			return $stmt->error;
		} else {
			//echo "<b>Successfully deleted purchase item #".$UPC."</b>";
			return 0;
		}
	}
	
	
	public function dailySales($reportDate)
	{
		global $connection;
				
		$result = $connection->prepare("SELECT max(?) as Date,
					p.upc as UPC, 
					category as Category, 
					sum(price) as ItemPrice, 
		            sum(quantity) as Quantity, 
		            sum(price * quantity) as Total
		    from PurchaseItem p
		    inner join Order_ o on p.receiptID = o.receiptID
		    inner join Item_ i on p.upc = i.upc
		    where datediff(?,o.date) < 1
		    group by category, p.upc with rollup");
		
		$result->bind_param("ss",$reportDate, $reportDate);
		$result->execute();
		
	    $result->bind_result($Date, $UPC, $ItemPrice, $Quantity, $Total);
		$i = 0;
		$schema = array('Date','UPC','ItemPrice','Quantity','Total');
		
		// Build result table	
		echo "<h2>Daily Sales Report</h2>";
		echo "<table border=0 cellpadding =0 cellspacing=0>";

		// Column titles
		echo "<tr valine=center>";
		for($j=0;$j<count($schema);$j++)
		{
			echo "<td class=rowheader>".$schema[$j]."</td>";
		}
		echo "</tr>";
				
		// details		
		while ($row = $result->fetch()) {
			echo "<tr valine=center>";
			for($k=0;$k<count($schema);$k++)
			{
				//echo "<td>".$row[$schema[$k]]."</td>";
				echo "<td>Test</td>";				
			}
			echo "</tr>";
							
			$i++;
		}
		
		echo "</table><br>";

	}
	
}
?>
