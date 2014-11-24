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
		
		// update stock
		$result = $connection->prepare("UPDATE Item_ set stock = stock - ? where upc = ?");
		$result->bind_param("ii", $quantity, $UPC);

		$result->execute();	
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

		// Column titles
		echo "<tr>";
		for($j=1;$j<count($schema);$j++)
		{
			echo "<td>".$schema[$j]."</td>";
		}
		echo "</tr>";
				
		$i = 0;		
				
		// details		
		while ($row = $result->fetch()) {
			
			// title row
			if ($i == 0) {echo "<tr><h3> Daily Sales Report For ".$Date."</h3></tr>";}
			
			// data rows
			echo "<tr>";	
				echo "<td>". $UPC ."</td>";	
				echo "<td>". $Category ."</td>";
				echo "<td>". $ItemPrice ."</td>";
				echo "<td>". $Quantity ."</td>";	
				echo "<td>". $Total ."</td>";
			echo "</tr>";
			$i++;
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
										order by pi.quantity desc");
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