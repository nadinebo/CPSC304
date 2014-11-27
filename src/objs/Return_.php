<?php
$connection = NULL;
class Return_
{
	public function __construct($conn)
	{
		global $connection;
		$connection  = $conn;
		error_reporting(E_STRICT);
	}
	
	public function insertReturn($returnDate,$receiptID)
	{
		global $connection;
		//ADDED HERE
		$res = $connection->prepare("select date from Order_ o where o.receiptID=?");
		$res->bind_param("i",$receiptID);
		$res->execute();
		if($res->error) {
			printf("<b>Error: %s. </b>\n", $res->error);
			return $res->error;
		} else {
			
			$res->bind_result($mydate);
			
			while($res->fetch()){
			
				$date1=date_create($returnDate);
				$date2=date_create($mydate);
				
				$diff = date_diff($date1,$date2);
				
				if($diff->format("%a") <= "15"){
					
					$res->close();

					
					$stmt = $connection->prepare("INSERT INTO Return_ (returnDate, receiptID) Values (?,?)");
					$stmt->bind_param("si", $returnDate, $receiptID);
					$stmt->execute();
					
					if($stmt->error) {
						printf("<b>Error: %s. </b>\n", $stmt->error);
						return $stmt->error;
					} else {
						return 0;
					}
				}else{
		
					echo "The return period has passed. Items can only be returned within 15 days from purchase. ";
					echo "\r\n";
					echo "It has been ";
					echo $diff->format("%a days since the purchase was made.");
					
					
				}
			}
	
		}

			
	}
	
	
	

	
	
	public function queryAllReturns()
	{
		global $connection;
		if(!$result = $connection->query("Select * From Return_")) {
			die('An error occured while running the query on Return[' .$db->error . ']');
		} else {
		}
		return $result;
	}
	
	
		public function queryReturn($retID)
	{
		global $connection;
		$stmt = $connection->prepare("Select returnDate, receiptID FROM Return_ WHERE retID=?");
		$stmt->bind_param("i",$retID);
		$stmt->execute();
		if($stmt->error) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
		}
		return $result;
	}
	
	
	public function deleteReturn($retID)
	{
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Return_ WHERE retID=?");
		$stmt->bind_param("i",$retID);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
			return $stmt->error;
		} else {
			return 0;
		}
	}
}
