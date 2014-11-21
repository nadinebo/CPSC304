<?php

$connection = NULL;

class Customer
{
	public function __construct($conn)
	{
		global $connection;
		$connection = $conn;
		error_reporting(E_STRICT);
	}
	
	public function login($cid,$password){
		global $connection;
		$stmt = $connection->prepare("SELECT * From Customer WHERE cid = ? && password = ?");
		$stmt->bind_param("is",$cid,$password);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} 
		if($stmt == null){
			echo "null";
		}
		if($stmt->num_rows != 1){
			return null;
		}
		else{
			return $stmt;
		}
	}

	// how are we adding cid into this equation?
	public function insertCustomer($cid, $password, $name, $address, $phone)
	{
		//echo "   inserting customer   ";
		global $connection;
		$stmt = $connection->prepare("INSERT INTO Customer (cid,password,name,address,phone) Values (?,?,?,?,?)");
		$stmt->bind_param("issss", $cid, $password, $name, $address, $phone);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully added ".$cid.", ".$name."</b>";
		}
	}

	public function queryAllCustomers()
	{
		//echo "   query customer   ";
		global $connection;
		if(!$result = $connection->query("Select * FROM Customer")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			//echo "<b>Search successful</b>";
		}
		return $result;
	}

	public function deleteCustomer($cid) 
	{
		//echo "   deleting customer   ";
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Customer WHERE cid=?");
		$stmt->bind_param("i",$cid);
		$stmt->execute();
		if ($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully deleted ".$cid.", ".$name."</b>";
		}
	}
}
?>
