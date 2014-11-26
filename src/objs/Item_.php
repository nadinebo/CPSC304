
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
		$stmt->bind_param("issssiii", $UPC, $title,$type,$category,$company,$year,$price,$stock);
		$stmt->execute();
		if($stmt->error) {
			//printf("<b>Error: %s. </b><br>\n", $stmt->error);
			//return $stmt->error;
			
			//ADDED HERE
			if($price != null && $stock != null){
				$res = $connection->prepare("update Item_ set price = ?,stock = ?
													where upc=?");
				$res->bind_param("iii",$price,$stock,$UPC);
			}elseif($price == null && $stock != null){
				$res = $connection->prepare("update Item_ set stock = ?
													where upc=?");
				$res->bind_param("ii",$stock,$UPC);
			}elseif($price != null && $stock == null){
				$res = $connection->prepare("update Item_ set price = ?
													where upc=?");
				$res->bind_param("ii",$price,$UPC);
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

	public function searchItems($category,$title,$leadSinger)
	{
		global $connection;

		if($category != null && $title != null && $leadSinger != null){
			// all
			$res = $connection->prepare("SELECT 		I.UPC, title, type, category, company, year, price, stock
											FROM		Item_ I, LeadSigner L
											WHERE		I.UPC = L.UPC AND category LIKE '?%' AND title LIKE '?%' AND name LIKE '?%'
											GROUP BY	I.upc
											ORDER BY	type DESC, upc ASC");
			$res->bind_param("sss",$category,$title,$leadSinger);
		}
		elseif($category != null && $title == null && $leadSinger == null) {
			// category only
			$res = $connection->prepare("SELECT 		UPC, title, type, category, company, year, price, stock
											FROM		Item_ I
											WHERE		category LIKE '?%' 
											GROUP BY	upc
											ORDER BY	type DESC, upc ASC");
			$res->bind_param("s",$category);
		}
		elseif($category == null && $title != null && $leadSinger == null) {
			// title only
			$res = $connection->prepare("SELECT 		UPC, title, type, category, company, year, price, stock
											FROM		Item_ I
											WHERE		title LIKE '?%' 
											GROUP BY	upc
											ORDER BY	type DESC, upc ASC");
			$res->bind_param("s",$title);
		}
		elseif($category == null && $title == null && $leadSinger != null) {
			// leadSinger only
			$res = $connection->prepare("SELECT 		I.UPC, title, type, category, company, year, price, stock
											FROM		Item_ I, LeadSigner L
											WHERE		I.UPC = L.UPC AND name LIKE '?%'
											GROUP BY	I.upc
											ORDER BY	type DESC, upc ASC");
			$res->bind_param("s",$leadSinger);
		}
		// elseif($category != null && $title != null && $leadSinger == null) {
		// 	// category & title
		// 	$res = $connection->prepare("SELECT 		UPC, title, type, category, company, year, price, stock
		// 									FROM		Item_ I
		// 									WHERE		category LIKE '?%' AND title LIKE '?%''
		// 									GROUP BY	upc
		// 									ORDER BY	type DESC, upc ASC");
		// 	$res->bind_param("ss",$category,$title);
		// }
		// elseif($category != null && $title == null && $leadSinger != null) {
		// 	// category & leadSinger
		// 	res = $connection->prepare("SELECT 			I.UPC, title, type, category, company, year, price, stock
		// 									FROM		Item_ I, LeadSigner L
		// 									WHERE		I.UPC = L.UPC AND category LIKE '?%' AND name LIKE '?%'
		// 									GROUP BY	I.upc
		// 									ORDER BY	type DESC, upc ASC");
		// 	$res->bind_param("ss",$category,$leadSinger);
		// }
		// elseif($category == null && $title != null && $leadSinger != null) {
		// 	// leadSinger & title
		// 	res = $connection->prepare("SELECT 			I.UPC, title, type, category, company, year, price, stock
		// 									FROM		Item_ I, LeadSigner L
		// 									WHERE		I.UPC = L.UPC AND title LIKE '?%' AND name LIKE '?%'
		// 									GROUP BY	I.upc
		// 									ORDER BY	type DESC, upc ASC");
		// 	$res->bind_param("ss",$title,$leadSinger);
		// }

		$res->execute();

		if($res->error) {
			printf("<b>Error: %s. </b><br>\n", $res->error);
			return $res->error;
		} else {
			//echo "<b>Successfully deleted ".$Name."</b><br>";
			return 0;
		}

		$res->bind_result($upc, $title, $leadSinger, $type, $category, $company, $year, $price $stock);
		$schema = array('upc','title', 'leadSinger', 'type', 'category', 'company', 'year', 'price', 'stock');
		
				
		//echo "<table border = 1>";
		echo "<table>";


		for($j=0;$j<count($schema);$j++)
		{
			echo "<td class=rowheader>".$schema[$j]."</td>";
		}
		echo "</tr>";
				
		$i = count($schema);		
		echo "<tr><h3> Search Results </h3></tr>";

		while ($row = $res->fetch() && $i > 0) {
		
			echo "<tr>";
				
				echo "<td>".$upc."</td>";	
				echo "<td>".$title."</td>";
				echo "<td>".$leadSinger."</td>";
				echo "<td>".$type."</td>";
				echo "<td>".$category."</td>";
				echo "<td>".$company."</td>"
				echo "<td>".$year."</td>";
				echo "<td>".$price."</td>";
				echo "<td>".$stock."</td>";	
				
			echo "</tr>";
			$i--;
		}
		
		echo "</table><br>";
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
