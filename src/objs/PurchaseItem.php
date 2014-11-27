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
		
		$result = $connection->prepare("select stock from Item_ i where i.upc=?");
		$result->bind_param("i", $UPC);

		$result->execute();	
		
		if($result->error) {
			printf("<b>Error looking up item stock: %s. </b\n", $result->error);
			//return $result->error;
		} else {
		
		$result->bind_result($itemstock);
		
		$result->fetch();
		
		
		if($quantity > $itemstock){
			
			echo "We only have " .$itemstock. " units of item " .$UPC. " in stock, please select a different quantity.";
		
		}else{
			
			$result->close();
			$newstock = $itemstock - $quantity;
			
			$stmt = $connection->prepare("UPDATE Item_ set stock =? where upc =?");
			$stmt->bind_param("ii", $newstock, $UPC);

			$stmt->execute();
			if($stmt->error) {
				printf("<b>Error updating stock: %s. </b\n", $stmt->error);
				//return $stmt->error;
			} else {
		
			
			$stmt->close();
			
			$res = $connection->prepare("INSERT INTO PurchaseItem (receiptID, upc, quantity) Values (?,?,?)");
			$res->bind_param("iii", $receiptID, $UPC, $quantity);

			$res->execute();
			if($res->error) {
				printf("<b>Error inserting: %s. </b\n", $res->error);
				return $res->error;
			} else {
				//echo "Successfully purchased " .$UPC. "! ";
			}
		
		}
		
		}//else close
		
		}//close first error catch
		
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
					IFNULL(p.upc,'') as UPC, 
					IFNULL(category,'Total') as Category, 
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
				
	    $result->bind_result($Date, $UPC, $Category, $ItemPrice, $Quantity, $Total);
		$schema = array('Date','UPC','Category','ItemPrice','Quantity','Total');
		
		if ($result->fetch()){
		
		// Build result table		
		echo "<table border = 1>";
		
		// title row
		echo "<tr><h3> Daily Sales Report For ".$Date."</h3></tr>";

		// Column titles
		echo "<tr>";
		for($j=1;$j<count($schema);$j++)
		{
			echo "<td>".$schema[$j]."</td>";
		}
		echo "</tr>";
				
		//$i = 0;		

		// first row
		echo "<tr>";	
			echo "<td>". $UPC ."</td>";	
			echo "<td>". $Category ."</td>";
			echo "<td>". $ItemPrice ."</td>";
			echo "<td>". $Quantity ."</td>";	
			echo "<td>". $Total ."</td>";
		echo "</tr>";
				
		// remaining rows		
		while ($row = $result->fetch()) {
						
			// data rows
			echo "<tr>";	
				echo "<td>". $UPC ."</td>";	
				echo "<td>". $Category ."</td>";
				echo "<td>". $ItemPrice ."</td>";
				echo "<td>". $Quantity ."</td>";	
				echo "<td>". $Total ."</td>";
			echo "</tr>";
			//$i++;
		}
		
		echo "</table><br>";

	}	
	else {
			echo "No sales for this day";
		}
	}
	
	
	
	public function topSelling($queryDate, $n)
	{
		
		global $connection;
		$stmt = $connection->prepare("select o.date, i.upc, 
												i.title, i.company, 
												i.stock, sum(pi.quantity) as quantity
												from Order_ o,
													Item_ i,
    												PurchaseItem pi
										where o.receiptID = pi.receiptID 
												and i.upc = pi.upc and o.date=?
										group by pi.upc
										order by sum(pi.quantity) desc");
		$stmt->bind_param("s",$queryDate);
		$stmt->execute();
		if($stmt->error) {
			die('There was an error running the topSelling[' .$db->error . ']');
		} else {
			//echo "<b>Search successful</b>";
		}
		
		$stmt->bind_result($date, $upc, $title, $company, $stock, $quantity);
		$schema = array('date','upc','title','company','stock','quantity');
		
				
		//echo "<table border = 1>";
		echo "<table>";


		for($j=1;$j<count($schema);$j++)
		{
			echo "<td class=rowheader>".$schema[$j]."</td>";
		}
		echo "</tr>";
				
		$i = 1;		
		echo "<tr><h3> Top Selling Items Report For ".$queryDate."</h3></tr>";

		while ($row = $stmt->fetch()&& $i <= $n) {
		
			echo "<tr>";
				
				echo "<td>".$upc."</td>";	
				echo "<td>".$title."</td>";
				echo "<td>".$company."</td>";
				echo "<td>".$stock."</td>";	
				echo "<td>".$quantity."</td>";
				
			echo "</tr>";
			$i++;
		}
		
		echo "</table><br>";

	}
	
	
}
?>
