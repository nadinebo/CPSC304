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
	
	
/*	public function insertReturn($retID,$returnDate,$receiptID)
	{
		//echo "   adding a return   ";
		global $connection;
		
		$stmt = $connection->prepare("INSERT INTO Return_ (retID, returnDate, receiptID) Values (?,?,?)");
		$stmt->bind_param("isi", $retID, $returnDate, $receiptID);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
			return $stmt->error;
		} else {
			return 0;
			//echo "<b>Successfully added return #".$retID."</b>";
		}
	}*/
	
	
		
	public function insertReturn($retID,$returnDate,$receiptID)
	{
		//echo "   adding a return   ";
		global $connection;
		//ADDED HERE
		$res = $connection->prepare("select date from Order_ o where o.receiptID=?");
		$res->bind_param("i",$receiptID);
		$res->execute();
		if($res->error) {
			printf("<b>Error: %s. </b>\n", $res->error);
			return $res->error;
		} else {
			return $res;
			
			$diff = date_diff($returnDate,$res);
			
			if($diff <= 15){
			echo "$res = " .$res."!";
			$stmt = $connection->prepare("INSERT INTO Return_ (retID, returnDate, receiptID) Values (?,?,?)");
			$stmt->bind_param("isi", $retID, $returnDate, $receiptID);
			$stmt->execute();
			if($stmt->error) {
				printf("<b>Error: %s. </b>\n", $stmt->error);
				return $stmt->error;
			} else {
				return 0;
			//echo "<b>Successfully added return #".$retID."</b>";
			}
		}else{
		
		echo "The return period has passed. Items can only be returned within 15 days from purchase.";
		
		}//closes if
		
		}
		
		//
		
	
	}
	
	
	
	
	public function queryAllReturns()
	{
		//echo "   query a return   ";
		global $connection;
		if(!$result = $connection->query("Select * From Return_")) {
			die('An error occured while running the query on Return[' .$db->error . ']');
		} else {
			//echo "<b>Search is succussfull for Return</b>";
		}
		return $result;
	}
	
	
		public function queryReturn($retID)
	{
		//echo "   get the date and receiptID for the return   ";
		global $connection;
		$stmt = $connection->prepare("Select returnDate, receiptID FROM Return_ WHERE retID=?");
		$stmt->bind_param("i",$retID);
		$stmt->execute();
		if($stmt->error) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			//echo "<b>Search successful<\b>";
		}
		return $result;
	}
	
	
	public function deleteReturn($retID)
	{
		//echo "  deleting a return   ";
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Return_ WHERE retID=?");
		$stmt->bind_param("i",$retID);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
			return $stmt->error;
		} else {
			return 0;
			//echo "<b>Successfully deleted the return #".$retID."</b>";
		}
	}
}
