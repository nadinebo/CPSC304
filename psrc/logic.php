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
	
	public function newItem($UPC,$title,$type,$category,$company,$year,$price,$stock){
		global $Data;
		$Data->insertItem($UPC,$title,$type,$category,$company,$year,$price,$stock);
	}
	
	public function getItems(){
		global $Data;
		return $Data->queryAllItems();
	}

	public function removeItem($UPC){
		global $Data;
		$Data->deleteItem($UPC);
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
	
	
	public function newReturn($returnID,$date,$receiptID)
	{
		global $Data;
		return $Data->insertReturn($returnID,$date,$receiptID);	
	}	
	
	public function getReturn($returnID)
	{
		global $Data;
		return $Data->queryReturn($returnID);	
	}	

	public function getAllReturns()
	{
		global $Data;
		return $Data->queryAllReturns();	
	}
		
	public function removeReturn($returnID)
	{
		global $Data;
		return $Data->deleteReturn($returnID);	
	}
	
		public function newReturnItem($returnID,$UPC,$returnQuantity)
	{
		global $Data;
		return $Data->insertReturnItem($returnID,$UPC,$returnQuantity);	
	}	
	
	public function getReturnItem($returnID,$UPC)
	{
		global $Data;
		return $Data->queryReturnItem($returnID,$UPC);	
	}	

	public function getAllReturnItems()
	{
		global $Data;
		return $Data->queryAllReturnItems();	
	}
		
	public function removeReturnItem($returnID,$UPC)
	{
		global $Data;
		return $Data->deleteReturnItem($returnID,$UPC);	
	}

	public function newCustomer($cid,$password,$name,$address,$phone)
	{
		global $Data;
		return $Data->insertCustomer($cid,$password,$name,$address,$phone);	
	}	
	
	public function getCustomers()
	{
		global $Data;
		return $Data->queryAllCustomers();	
	}	
	
	public function removeCustomer($cid)
	{
		global $Data;
		return $Data->deleteCustomer($cid);	
	}


		public function newPurchaseItem($receiptID, $UPC, $purchaseQuantity)
	{
		global $Data;
		return $Data->insertPurchaseItem($receiptID, $UPC, $purchaseQuantity);	
	}	
	
	public function getPurchaseItems()
	{
		global $Data;
		return $Data->queryAllPurchaseItems();	
	}	
	
	public function removePurchaseItem($receiptID,$UPC)
	{
		global $Data;
		return $Data->deletePurchaseItem($receiptID$UPC);	
	}
}	
?>
