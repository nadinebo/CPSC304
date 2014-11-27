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
		$stmt = $connection->prepare("SELECT * From Customer WHERE cid = ? and password = ?");
		$stmt->bind_param("is",$cid,$password);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		}
		$stmt->bind_result($ucid,$upassword,$name,$address,$phone);
		$stmt->fetch();
		$user = array($ucid,$upassword,$name,$address,$phone);
		if($stmt == null){
			echo "null";
		}
		if($user[0] <= 0){
			return null;
		}
		else{
			return $user;
		}
	}

	/* upon a succussfull insertion the 0 is returned, otherwise its the error message*/
	public function insertCustomer($cid, $password, $name, $address, $phone)
	{
		global $connection;
		$stmt = $connection->prepare("INSERT INTO Customer (cid,password,name,address,phone) Values (?,?,?,?,?)");
		$stmt->bind_param("issss", $cid, $password, $name, $address, $phone);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
			return $stmt->error;
		} else {
			return 0;
		}
	}

	public function queryAllCustomers()
	{
		global $connection;
		if(!$result = $connection->query("Select * FROM Customer")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
		}
		return $result;
	}

	/* upon a succussfull insertion the 0 is returned, otherwise its the error message*/
	public function deleteCustomer($cid) 
	{
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Customer WHERE cid=?");
		$stmt->bind_param("i",$cid);
		$stmt->execute();
		if ($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
			return $stmt->error;
		} else {
			return 0;
		}
	}
}
?>
