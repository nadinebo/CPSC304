<?php

$connection = NULL;

class HasSong
{
	public function __construct($conn)
	{
		global $connection;
		$connection  = $conn;
		error_reporting(E_STRICT);
	}

	//Basic manipulation functions
	public function insertHasSong($UPC,$title)
	{	
		global $connection;
		$stmt = $connection->prepare("INSERT INTO hasSong (upc,title) Values (?,?)");
		echo "has song";
		$stmt->bind_param("is", $UPC, $title);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} 
	}

	public function queryAllSongTitles()
	{
		global $connection;
		if(!$result = $connection->query("Select upc,title From hasSong")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			return $result;
		}
		
	}

	public function deleteSongTitle($UPC,$title)
	{
		global $connection;
		$stmt = $connection->prepare("DELETE FROM hasSong WHERE upc=? AND title=?");
		$stmt->bind_param("is",$UPC,$title);
		$stmt->execute();
		if($stmt->error) {
			echo "<br>Nothing to delete";
		} else {
			//echo "<br>Successfully deleted song <i>".$title."</i><br>";
		}
	}
}
