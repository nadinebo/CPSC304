
<?php

$connection = NULL;

class Item_ 
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
		$stmt = $connection->prepare("INSERT INTO Item_ (upc,title,type,category,company,year,price,stock) Values (?,?,?,?,?,?,?,?)");
		//$stmt->bind_param("issssiii", $UPC, $title,$type,$category,$company,$year,$price,$stock);
		$stmt->bind_param("issssidi", $UPC, $title,$type,$category,$company,$year,$price,$stock);
		
		$stmt->execute();
		if($stmt->error) {
			//printf("<b>Error: %s. </b><br>\n", $stmt->error);
			//return $stmt->error;
			
			//ADDED HERE
			if($price != null && $stock != null){
				$res = $connection->prepare("update Item_ set price = ?,stock = ?
													where upc=?");
				//$res->bind_param("iii",$price,$stock,$UPC);
				$res->bind_param("dii",$price,$stock,$UPC);
				
			}elseif($price == null && $stock != null){
				$res = $connection->prepare("update Item_ set stock = ?
													where upc=?");
				$res->bind_param("ii",$stock,$UPC);
			}elseif($price != null && $stock == null){
				$res = $connection->prepare("update Item_ set price = ?
													where upc=?");
				//$res->bind_param("ii",$price,$UPC);
				$res->bind_param("di",$price,$UPC);
			}else{
			//Error control for now
				$res = $connection->prepare("update Item_ set upc = ?
													where upc=?");
				$res->bind_param("i",$UPC);
			}
			$res->execute();
			
			if($res->error) {
			printf("<b>Error: %s. </b><br>\n", $res->error);
			return $res->error;
			} else {
			//echo "<b>Successfully deleted ".$Name."</b><br>";
				return 0;
			}
			
			//
			
		} else {
			return 0;
			//echo "<b>Successfully added ".$UPC."</b><br>";
		}
	}

	public function queryAllItems()
	{
		global $connection;
		if(!$result = $connection->query("Select * From Item_")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			//echo "<b>Search succussfull</b><br>";
		}
		return $result;
	}

	public function deleteItem($UPC)
	{
		global $connection;
		$stmt = $connection->prepare("DELETE FROM Item_ WHERE upc=?");
		$stmt->bind_param("i",$UPC);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b><br>\n", $stmt->error);
			return $stmt->error;
		} else {
			//echo "<b>Successfully deleted ".$Name."</b><br>";
			return 0;
		}
	}
}
