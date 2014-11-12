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

	public function demo()
	{
		global $Logic;
		$Logic->newLeadSinger('384932647092','St.Vincent');
		echo "insert comp";
		//testing using the layers as classes
		$result = $Logic->getLeadSingers();
		//a bit of test display for the sake of it
		while($row = $result->fetch_assoc()){
			echo"<td>".$row['upc']."</td>";
			echo"<td>".$row['name']."</td>";
		}
		$Logic->removeLeadSingers('384932647092','St.Vincent');

		$Logic->getAllOrders();
		echo "getting all orders";
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
