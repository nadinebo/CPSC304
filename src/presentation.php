<?php
	$Logic = NULL;
class Presentation
{
	public function __construct()
	{
		include 'logic.php';
		global $Logic;
		echo "logicinit";
		$Logic = new Logic;
	}
	public function buildTable($tableName,$result,$schema){
		
		echo "<h2>".$tableName."</h2>";
		echo "<table border=0 cellpadding =0 cellspacing=0>";
		echo "<tr valine=center>";
		for($i=0;$i<count($schema);$i++)
		{
			echo "<td class=rowheader>".$schema[$i]."</td>";
		}
		echo "</tr>";
		
		while($row = $result->fetch_assoc()){
			for($i=0;$i<count($schema);$i++)
			{
				echo"<td>".$row[$schema[$i]]."</td>";
			}
			echo "<td>";
       			echo "<a href=\"javascript:formSubmit('".$row['title_id']."');\">DELETE</a>";
			echo"</td></tr>";
		}
		echo"</table>";
		echo"<br><br>";
	}
	
	public function BuildAddForm($schema){
		echo "<form id=\"add\" name=\"add\" method=\"post\" action=\"";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
		echo"\">";
    		echo"<table border=0 cellpadding=0 cellspacing=0>";
		for($i=0;$i<count($schema);$i++)
		{
			echo "<tr><td>".$schema[$i]."</td><td><input type=\"text\" size=30 name=\"new_".$schema[$i]."\"</td></tr>";
		}
        	echo"<tr><td></td><td><input type=\"submit\" name=\"submit\" border=0 value=\"ADD\"></td></tr>";
    		echo"</table>";
		echo"</form>";
	}
	
	public function Itemsd()
	{
		global $Logic;
		
		//Added this
		
		$Logic->newItem(38493,'St.Vincent','CD','POP','muhrecords',2014,20,1);
		$Logic->newItem(11111,'test1','CD','POP','muhrecords',2014,20,10);
		$Logic->newItem(22222,'test2','CD','POP','muhrecords',2014,20,1);
		//testing using the layers as classes
		$result = $Logic->getItems();
		$schema = array('upc','title','type','category','company','year','price','stock');
		$this->buildTable("Items",$result,$schema);
		$this->buildAddForm($schema);
		//Create a table to display the singers
		$Logic->removeItem(38493);
		$Logic->removeItem(11111);
		$Logic->removeItem(22222);
	}
	public function singersd()
	{
		global $Logic;
		
		$Logic->newLeadSinger(38493,'St.Vincent');
		$Logic->newLeadSinger(22231,'Michal Geera');
		
		//testing using the layers as classes
		$result = $Logic->getLeadSingers();
		$schema = array('upc','name');	
		$this->buildTable("Lead Singer",$result,$schema);
		$this->buildAddForm($schema);
		$Logic->removeLeadSingers(22231,'Michal Geera');
		$Logic->removeLeadSingers(38493,'St.Vincent');
	}

	public function orders()
	{
		global $Logic;
		
		$date = date('Y-m-d');
		
		$nextWeek = time() + (7 * 24 * 60 * 60);
		$nextWeek = date('Y-m-d', $nextWeek);
		
		$twoWeeks = time() + (14 * 24 * 60 * 60);
		$twoWeeks = date('Y-m-d', $twoWeeks);
		
		$receiptID = 1;
		
		$Logic->newOrder($receiptID,$date,2,1234,'0101',$nextWeek,$twoWeeks);
		
		$result = $Logic->getAllOrders();
		$schema = array('receiptID','date','cid','cardNum','expiryDate','expectedDate','deliveredDate');
		$this->buildTable("All Orders",$result,$schema);
		
		$Logic->removeOrder($receiptID);
		
	}

	public function songs()
	{
		global $Logic;
		
		$UPC = '38493';
		$title = 'I prefer your love';
		$Logic->newItem('38493','St.Vincent','CD','POP','muhrecords',2014,20,1);
		
		$Logic->newSongTitle($UPC,$title);
		
		$result = $Logic->getAllSongTitles();
		$schema = array('upc','title');
		$this->buildTable("All Songs",$result,$schema);
		
		$Logic->removeSongTitle($UPC,$title);
		$Logic->removeItem('38493');
		
	}

	public function processReturns()
	{
		global $Logic;
		
		// Setup variables for testing
		$UPC = '38493';		
		$cid = 555;
		$date = date('Y-m-d');		
		$receiptID = 1;
		$returnID = 1;

		$nextWeek = time() + (7 * 24 * 60 * 60);
		$nextWeek = date('Y-m-d', $nextWeek);
		
		$twoWeeks = time() + (14 * 24 * 60 * 60);
		$twoWeeks = date('Y-m-d', $twoWeeks);
		
		// create records for testing
		$Logic->newCustomer($cid,'password','Nicole','Cornwall Street','604-837-9964');
		$Logic->newItem($UPC,'St.Vincent','CD','POP','muhrecords',2014,20,1);
		$Logic->newOrder($receiptID,$date,$cid,1234,'0101',$nextWeek,$twoWeeks);
		$Logic->newPurchaseItem($receiptID,$UPC,'1');
		$Logic->newReturn($returnID,$date,$receiptID);
		$Logic->newReturnItem($returnID,'1',$UPC);
		
		// build a table to show the return	
		$result = $Logic->getAllReturnItems();
		$schema = array('retID','returnQuantity','upc');
		$this->buildTable("All Returns",$result,$schema);
		
		// remove test records
		$Logic->removeReturnItem($returnID,$UPC);
		$Logic->removeReturn($returnID);
		$Logic->removePurchaseItem($receiptID,$UPC);
		$Logic->removeOrder($receiptID);
		$Logic->removeItem($UPC);
		$Logic->removeCustomer($cid);
		
	}

	public function SalesReport()
	{
		global $Logic;
		
		// Setup variables for testing
		$UPC = '38493';		
		$cid = 555;
		$date = date('Y-m-d');		
		$receiptID1 = 1;	
		$receiptID2 = 2;

		$nextWeek = time() + (7 * 24 * 60 * 60);
		$nextWeek = date('Y-m-d', $nextWeek);
		
		$twoWeeks = time() + (14 * 24 * 60 * 60);
		$twoWeeks = date('Y-m-d', $twoWeeks);
		
		// create records for testing
		$Logic->newCustomer($cid,'password','Nicole','Cornwall Street','604-837-9964');
		$Logic->newItem($UPC,'St.Vincent','CD','POP','muhrecords',2014,20,1);
		$Logic->newOrder($receiptID1,$date,$cid,1234,'0101',$nextWeek,$twoWeeks);
		$Logic->newOrder($receiptID2,$date,$cid,1234,'0101',$nextWeek,$twoWeeks);
		$Logic->newPurchaseItem($receiptID1,$UPC,'1');
		$Logic->newPurchaseItem($receiptID2,$UPC,'1');
		
		// build a table to show the return	
		$result = $Logic->dailySales($date);
		$schema = array('upc','category','price','quantity','total');
		$this->buildTable("Daily Sales",$result,$schema);
		
		// remove test records
		$Logic->removePurchaseItem($receiptID1,$UPC);
		$Logic->removePurchaseItem($receiptID2,$UPC);
		$Logic->removeOrder($receiptID1);
		$Logic->removeOrder($receiptID2);
		$Logic->removeItem($UPC);
		$Logic->removeCustomer($cid);
		
	}

	public function demo()
	{
		global $Logic;
		echo"entering demo";
		$this->singersd();
		$this->itemsd();
		$this->orders();
		$this->songs();
		echo "finished songs";
		//$this->processReturns();
		//$this->SalesReport();
		$Logic->removeCustomer(1000);
		$Logic->removeCustomer(2000);
		
		$Logic->newCustomer(1000,'ilikejane','JohnDoe','1234 W10th ave','604-123-4567');
		echo "insert a customer ";
		//insert second return
		$Logic->newCustomer(2000,'ilikejohn','JaneDoe','1234 W10th ave','604-123-4567');
		echo "insert a customer ";
		//$Logic->removeCustomer(1000);
		//$Logic->removeCustomer(2000);
		
		$result = $Logic->getCustomers();
		while($row = $result->fetch_assoc()){
			echo"<td>".$row['cid']."</td>";
			echo"<td>".$row['password']."</td>";
			echo"<td>".$row['name']."</td>";
			echo"<td>".$row['address']."</td>";
			echo"<td>".$row['phone']."</td>";
		}
		
		//insert first return
		//retID 12345 returnDate receiptID
		$Logic->newReturn('12345','2014-11-11 01:02:03','12014');
		$Logic->removeOrder(12014);
		$Logic->removeOrder(11014);
		
		//newOrder($receiptID,$date,$CID,$cardNum,$expiryDate,$expectedDate)
		$Logic->newOrder(12014,'2014-11-01 01:02:03',1000,45678,'2017-11-01 01:02:03','2014-12-01 01:02:03');
		$Logic->newOrder(11014,'2014-11-01 01:02:03',2000,45123,'2015-11-01 01:02:03','2014-12-01 01:02:03');
		
		$Logic->removePurchaseItem(12014,11111);
		$Logic->removePurchaseItem(11014,11111);
		
		echo "insert a PurchaseItem";
		$Logic->newPurchaseItem(12014,11111,5);
		echo "insert a PurchaseItem";
		$Logic->newPurchaseItem(11014,22222,5);
		
		$result = $Logic->getPurchaseItems();
		/*while($row = $result->fetch_assoc()){
			echo"<td>".$row['receiptID']."</td>";
			echo"<td>".$row['upc']."</td>";
			echo"<td>".$row['quantity']."</td>";
		}
		*/
		
		echo " done with purchase item ";

		$Logic->newReturn(12345,'2014-11-11 01:02:03',12014);
		
		echo "insert a return";
		$Logic->newReturn(90876,'2014-11-10 03:02:01',11014);
		echo "insert a return";
		
		$result = $Logic->getAllReturns();
		while($row = $result->fetch_assoc()){
			echo"<td>".$row['retID']."</td>";
			echo"<td>".$row['date']."</td>";
			echo"<td>".$row['receiptID']."</td><td>";
		}

		$Logic->newReturnItem(12345,11111,1);
		$Logic->newReturnItem(90876,22222,1);
		echo "insert a return";
		$result = $Logic->getAllReturnItems();
		while($row = $result->fetch_assoc()){
			echo"<td>".$row['retID']."</td>";
			echo"<td>".$row['UPC']."</td>";
			echo"<td>".$row['returnQuantity']."</td><td>";
		}
		
	}
}
?>
