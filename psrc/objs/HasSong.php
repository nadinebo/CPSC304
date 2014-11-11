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
		echo "   inserting song title   ";
		global $connection;
		$stmt = $connection->prepare("INSERT INTO HasSong (upc,title) Values (?,?)");
		$stmt->bind_param("is", $UPC, $title);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully added ".$title."</b>";
		}
	}

	public function querySongTitles($UPC)
	{
		echo "   get the song titles for this item   ";
		global $connection;
		$stmt = $connection->prepare("Select title FROM HasSong WHERE upc=?");
		$stmt->bind_param("is",$UPC);
		$stmt->execute();
		if($stmt->error) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			echo "<b>Search successful<\b>";
		}
		return $result;
	}

	public function queryAllSongTitles()
	{
		echo "   query song titles   ";
		global $connection;
		if(!$result = $connection->query("Select * From HasSong")) {
			die('There was an error running the query [' .$db->error . ']');
		} else {
			echo "<b>Search successful<\b>";
		}
		return $result;
	}

	public function deleteSongTitle($UPC,$title)
	{
		echo "  deleting song title   ";
		global $connection;
		$stmt = $connection->prepare("DELETE FROM HasSong WHERE upc=? AND title=?");
		$stmt->bind_param("is",$UPC,$title);
		$stmt->execute();
		if($stmt->error) {
			printf("<b>Error: %s. </b>\n", $stmt->error);
		} else {
			echo "<b>Successfully deleted ".$title."</b>";
		}
	}
}
