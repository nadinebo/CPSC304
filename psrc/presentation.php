<?php
	$Logic = NULL;
class Presentation
{
	public function __construct()
	{
		include 'logic.php';
		global $Logic;
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
			echo"</td></tr>";
		}
		echo"</table>";
		echo"<br><br>";
	}
	
	public function singersd()
	{
		global $Logic;
		
		$Logic->newLeadSinger('384932647092','St.Vincent');
		$Logic->newLeadSinger('222313441242','Michal Geera');
		
		//testing using the layers as classes
		$result = $Logic->getLeadSingers();
		
		$this->buildTable("Lead Singer",$result,['upc','name']);
		//Create a table to display the singers

		
		//a bit of test display for the sake of it


		$Logic->removeLeadSingers('2147483647','St.Vincent');
		$Logic->removeLeadSingers('2147483647','Michal Geera');
	}

	public function demo()
	{
		global $Logic;
		$this->singersd();
		//$Logic->getAllOrders();
		//echo "getting all orders";
		//insert first return
		$Logic->newReturn('1234567890','11/11/2014','0011112014');
		echo "insert a return";
		//insert second return
		$Logic->newReturn('0987654321','10/11/2014','0010112014');
		echo "insert a return";

		$result = $Logic->getAllReturns();

		while($row = $result->fetch_assoc()){
			echo"<td>".$row['returnID']."</td>";
			echo"<td>".$row['date']."</td>";
			echo"<td>".$row['receiptID']."</td><td>";
		}
		$Logic->removeReturn('0987654321');
		
		
		$Logic->newReturnItem('1234567890','1111111111','1');
		echo "insert a return";

		$result = $Logic->getAllReturnItems();

		while($row = $result->fetch_assoc()){
			echo"<td>".$row['returnID']."</td>";
			echo"<td>".$row['UPC']."</td>";
			echo"<td>".$row['quantity']."</td><td>";
		}
		//$Logic->removeReturnItem('1234567890','1111111111');

	}
}

?>
