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
	
	public function login($cid,$password){
		global $Data;
		return $Data->login($cid,$password);
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
	
	//public function newOrder($receiptID,$date,$CID,$cardNum,$expiryDate) 
	public function newOrder($date,$CID,$cardNum,$expiryDate) 
	{
		global $Data;
		//return $Data->insertOrder($receiptID,$date,$CID,$cardNum,$expiryDate);
		return $Data->insertOrder($date,$CID,$cardNum,$expiryDate);
	}
	
		public function updateDelivery($receiptID,$deliveredDate)
	{
		global $Data;
		return $Data->updateDelivery($receiptID,$deliveredDate);	
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
	
	
	//public function newReturn($retID,$returnDate,$receiptID)
	public function newReturn($returnDate,$receiptID)
	{
		global $Data;
		//return $Data->insertReturn($retID,$returnDate,$receiptID);	
		return $Data->insertReturn($returnDate,$receiptID);	
	}	
	
	public function getReturn($retID)
	{
		global $Data;
		return $Data->queryReturn($retID);	
	}	

	public function getAllReturns()
	{
		global $Data;
		return $Data->queryAllReturns();	
	}
		
	public function removeReturn($retID)
	{
		global $Data;
		return $Data->deleteReturn($retID);	
	}
	
		public function newReturnItem($retID,$UPC,$returnQuantity)
	{
		global $Data;
		return $Data->insertReturnItem($retID,$UPC,$returnQuantity);	
	}	
	
	public function getReturnItem($retID,$UPC)
	{
		global $Data;
		return $Data->queryReturnItem($retID,$UPC);	
	}	

	public function getAllReturnItems()
	{
		global $Data;
		return $Data->queryAllReturnItems();	
	}
		
	public function removeReturnItem($retID,$UPC)
	{
		global $Data;
		return $Data->deleteReturnItem($retID,$UPC);	
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


		public function newPurchaseItem($receiptID, $UPC, $quantity)
	{
		global $Data;
		return $Data->insertPurchaseItem($receiptID, $UPC, $quantity);	
	}	
	
	public function getAllPurchaseItems()
	{
		global $Data;
		return $Data->queryAllPurchaseItems();	
	}	
	
	public function removePurchaseItem($receiptID,$UPC)
	{
		global $Data;
		return $Data->deletePurchaseItem($receiptID,$UPC);	
	}
	
	public function dailySales($reportDate)
	{
		global $Data;
		return $Data->dailySales($reportDate);	
	}
	
		public function topSelling($queryDate,$n)
	{
		global $Data;
		return $Data->topSelling($queryDate,$n);	
	}
	
}	
?>
