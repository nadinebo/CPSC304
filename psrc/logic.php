<?php
	
	$Data = NULL;
class Logic
{
	public function __construct()
	{
		include 'data.php';

		global $Data;
		$Data = new Data();
	}
	
	public function newLeadSinger($UPC,$Name)
	{
		global $Data;
		return $Data->insertLeadSinger($UPC,$Name);	
	}	
	
	public function getLeadSingers()
	{
		global $Data;
		return $Data->queryAllLeadSingers();	
	}	
	
	public function removeLeadSingers($UPC,$Name)
	{
		global $Data;
		return $Data->deleteLeadSinger($UPC,$Name);	
	}
	
	public function newOrder($date,$CID,$cardNum,$expiryDate,$expectedDate)
	{
		global $Data;
		return $Data->insertOrder($date,$CID,$cardNum,$expiryDate,$expectedDate);	
	}	
	
	public function getOrder($CID)
	{
		global $Data;
		return $Data->queryOrder($CID);	
	}	

	public function getAllOrders()
	{
		global $Data;
		return $Data->queryAllOrders();	
	}
		
	public function removeOrder($receiptID)
	{
		global $Data;
		return $Data->deleteOrder($receiptID);	
	}
	
	public function newSongTitle($UPC,$title)
	{
		global $Data;
		return $Data->insertHasSong($UPC,$title);	
	}	
	
	public function getSongTitles($UPC)
	{
		global $Data;
		return $Data->querySongTitles($UPC);	
	}	

	public function getAllSongTitles()
	{
		global $Data;
		return $Data->queryAllSongTitles();	
	}
		
	public function removeSongTitle($UPC,$title)
	{
		global $Data;
		return $Data->deleteSongTitle($UPC,$title);	
	}
	
}	
?>
