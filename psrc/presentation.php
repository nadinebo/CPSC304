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
	}
}

?>
