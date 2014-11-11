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
}	
?>
