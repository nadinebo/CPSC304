
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
		$stmt->bind_param("issssidi", $UPC, $title,$type,$category,$company,$year,$price,$stock);
		
		$stmt->execute();

		if($stmt->error) {
			
			//ADDED HERE
			if($price != null && $stock != null){
				$res = $connection->prepare("update Item_ set price = ?,stock = ?
													where upc=?");
				$res->bind_param("dii",$price,$stock,$UPC);
				
			}elseif($price == null && $stock != null){
				$res = $connection->prepare("update Item_ set stock = ?
													where upc=?");
				$res->bind_param("ii",$stock,$UPC);
			}elseif($price != null && $stock == null){
				$res = $connection->prepare("update Item_ set price = ?
													where upc=?");
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
				return 0;
			}
				
		} 
		else {
			return 0;
		}
	}

	public function searchItems($cat,$tit,$lead)
	{
		global $connection;

		if($cat != null && $tit != null && $lead != null){
			// all
			$stmt = $connection->prepare("select 		I.UPC, title, name, type, category, company, year, price, stock
											FROM		Item_ I, LeadSinger L
											WHERE		I.UPC = L.UPC AND category = ? AND title = ? AND name = ?
											GROUP BY	I.upc
											ORDER BY	type DESC, upc ASC");
			$stmt->bind_param("sss",$cat,$tit,$lead);
			$stmt->bind_result($upc, $title, $name, $type, $category, $company, $year, $price, $stock);
			$schema = array('upc','title', 'leadSinger', 'type', 'category', 'company', 'year', 'price', 'stock');
		}
		elseif($cat != null && $tit == null && $lead == null) {
			// category only
			$stmt = $connection->prepare("select 		upc, title, type, category, company, year, price, stock
											FROM		Item_ I
											WHERE		category = ? 
											GROUP BY	upc
											ORDER BY	type DESC, upc ASC");
			$stmt->bind_param("s",$cat);
			$stmt->bind_result($upc, $title, $type, $category, $company, $year, $price, $stock);
			$schema = array('upc','title', 'type', 'category', 'company', 'year', 'price', 'stock');
		}
		elseif($cat == null && $tit != null && $lead == null) {
			// title only
			$stmt = $connection->prepare("select 		UPC, title, type, category, company, year, price, stock
											FROM		Item_ I
											WHERE		title = ?
											GROUP BY	upc
											ORDER BY	type DESC, upc ASC");
			$stmt->bind_param("s",$tit);
			$stmt->bind_result($upc, $title, $type, $category, $company, $year, $price, $stock);
			$schema = array('upc','title', 'type', 'category', 'company', 'year', 'price', 'stock');
		}
		elseif($cat == null && $tit == null && $lead != null) {
			// leadSinger only
			$stmt = $connection->prepare("select 		I.UPC, title, name, type, category, company, year, price, stock
											FROM		Item_ I, LeadSinger L
											WHERE		I.UPC = L.UPC AND name = ?
											GROUP BY	I.upc
											ORDER BY	type DESC, upc ASC");
			$stmt->bind_param("s",$lead);
			$stmt->bind_result($upc, $title, $name, $type, $category, $company, $year, $price, $stock);
			$schema = array('upc','title', 'leadSinger', 'type', 'category', 'company', 'year', 'price', 'stock');
		}
		elseif($cat != null && $tit != null && $lead == null) {
			// category & title
			$stmt = $connection->prepare("select 		UPC, title, type, category, company, year, price, stock
											FROM		Item_ I
											WHERE		category = ? AND title = ?
											GROUP BY	upc
											ORDER BY	type DESC, upc ASC");
			$stmt->bind_param("ss",$cat,$tit);
			$stmt->bind_result($upc, $title, $type, $category, $company, $year, $price, $stock);
			$schema = array('upc','title', 'type', 'category', 'company', 'year', 'price', 'stock');
		}
		elseif($cat != null && $tit == null && $lead != null) {
			// category & leadSinger
			$stmt = $connection->prepare("select 		I.UPC, title, name, type, category, company, year, price, stock
											FROM		Item_ I, LeadSinger L
											WHERE		I.UPC = L.UPC AND category = ? AND name = ?
											GROUP BY	I.upc
											ORDER BY	type DESC, upc ASC");
			$stmt->bind_param("ss",$cat,$lead);
			$stmt->bind_result($upc, $title, $name, $type, $category, $company, $year, $price, $stock);
			$schema = array('upc','title', 'leadSinger', 'type', 'category', 'company', 'year', 'price', 'stock');
		}
		elseif($cat == null && $tit != null && $lead != null) {
			// leadSinger & title
			$stmt = $connection->prepare("select 		I.UPC, title, name, type, category, company, year, price, stock
											FROM		Item_ I, LeadSinger L
											WHERE		I.UPC = L.UPC AND title = ? AND name = ?
											GROUP BY	I.upc
											ORDER BY	type DESC, upc ASC");
			$stmt->bind_param("ss",$tit,$lead);
			$stmt->bind_result($upc, $title, $name, $type, $category, $company, $year, $price, $stock);
			$schema = array('upc','title', 'leadSinger', 'type', 'category', 'company', 'year', 'price', 'stock');
		}
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b><br>\n", $stmt->error);
			return $stmt->error;
		} else {
			
		}

		$searchResult = null;
		$searchItem = null;
				
		echo "<tr><h3> Search Results </h3></tr>";
		$i=0;
		if (count($schema) === 9) {
			// LeadSinger would have been used to search
			while ($row = $stmt->fetch()) {

				$searchItem['upc']=$upc;	
				$searchItem['title']=$title;
				$searchItem['name']=$name;
				$searchItem['type']=$type;
				$searchItem['category']=$category;
				$searchItem['company']=$company;
				$searchItem['year']=$year;
				$searchItem['price']=$price;
				$searchItem['stock']=$stock;	
				$searchResult[$i] = $searchItem;
				$i++;
			}
		} else {
			// LeadSinger would not have been used
			while ($row = $stmt->fetch()) {

				$searchItem['upc']=$upc;	
				$searchItem['title']=$title;
				$searchItem['type']=$type;
				$searchItem['category']=$category;
				$searchItem['company']=$company;
				$searchItem['year']=$year;
				$searchItem['price']=$price;
				$searchItem['stock']=$stock;	
				$searchResult[$i] = $searchItem;
				$i++;
			}
		}
		return $searchResult;

	}


	public function queryAllItems()
	{
		global $connection;
		if(!$result = $connection->query("Select * From Item_")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
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
			return 0;
		}
	}
}
