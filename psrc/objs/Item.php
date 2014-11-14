
<?php

$connection = NULL;

class Item 
{
	public function __construct($conn)
	{
		global $connection;
		$connection  = $conn;
		error_reporting(E_STRICT);
	}

	//Basic manipulation functions
	public function insertItem($UPC,$title,$type,$category,$company,$year,$price,$stock)
	{
		global $connection;
		$stmt = $connection->prepare("INSERT INTO Item (upc,title,type,category,company,year,price,stock) Values (?,?,?,?,?,?,?,?)");
		$stmt->bind_param("issssiii", $UPC, $title,$type,$category,$company,$year,$price,$stock);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b><br>\n", $stmt->error);
		} else {
			echo "<b>Successfully added ".$Name."</b><br>";
		}
	}

	public function queryAllItems()
	{
		global $connection;
		if(!$result = $connection->query("Select * From Item")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			echo "<b>Search succussfull</b><br>";
		}
		return $result;
	}

	public function deleteItem($UPC)
	{
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Item WHERE upc=?");
		$stmt->bind_param("i",$UPC);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b><br>\n", $stmt->error);
		} else {
			echo "<b>Successfully deleted ".$Name."</b><br>";
		}
	}
}
