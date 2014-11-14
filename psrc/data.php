<?php


$connection = NULL;
$LS = NULL; 	//the lead singer reference
class Data
{
	public function __construct()
	{
			include 'objs/LeadSinger.php';
			include 'objs/HasSong.php';
			include 'objs/Order.php';
			include 'objs/Return_.php';
			include 'objs/ReturnItem.php';
			include 'objs/Customer.php';
			include 'objs/PurchaseItem.php';
			echo "dinit";
			include 'objs/Item.php';

			$server = '127.0.0.1';
			$user = 'root';
			$pass = '';
			$dbname = 'Houns';
		echo "conninit";	
			global $connection;
			$connection = new mysqli($server, $user, $pass, $dbname);
			mysql_select_db($dbname);
		    
		    if (!mysqli_connect_errno()) {
			echo "You connected!";
		    }
		
		// Check that the connection was successful, otherwise exit
		    if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		    }	

			//create references to the data objects
			global $LS;
			$LS = new LeadSinger($connection);
			
			global $O;
			$O = new Order($connection);
			
			global $HS;
			$HS = new HasSong($connection);
			
			global $R;
			$R = new Return_($connection);
			
			global $RI;
			$RI = new ReturnItem($connection);

			global $I;
			$I = new Item($connection);
			
			global $PI;
			$PI = new PurchaseItem($connection);

			global $C;
			$C = new Customer($connection);
	}

	public function insertItem($UPC,$title,$type,$category,$company,$year,$price,$stock){
		global $I;
		$I->insertItem($UPC,$title,$type,$category,$company,$year,$price,$stock);
	}
	
	public function queryAllItems(){
		global $I;
		return $I->queryAllItems();
	}

	public function deleteItem($UPC){
		global $I;
		$I->deleteItem($UPC);
	}

	public function insertLeadSinger($UPC,$Name){
		global $LS;
		$LS->insertLeadSinger($UPC,$Name);
	}
	
	public function queryAllLeadSingers(){
		global $LS;
		return $LS->queryAllLeadSingers();
	}

	public function deleteLeadSinger($UPC,$Name){
		global $LS;
		$LS->deleteLeadSinger($UPC,$Name);
	}

	public function insertOrder($date,$CID,$cardNum,$expiryDate,$expectedDate){
		echo"orderinsertCalled DATA";
		global $O;
		$O->insertOrder($date,$CID,$cardNum,$expiryDate,$expectedDate);
	}
	
	public function queryOrder($CID){
		global $O;
		return $O->queryOrder($CID);
	}

	public function queryAllOrders(){
		global $O;
		return $O->queryAllOrders();
	}

	public function deleteOrder($receiptID){
		global $O;
		$O->deleteOrder($receiptID);
	}

	public function insertHasSong($UPC,$title){
		echo"HasSonginsertCalled DATA";
		global $HS;
		$HS->insertHasSong($UPC,$title);
	}
	
	public function querySongTitles($UPC){
		global $HS;
		return $HS->querySongTitles($UPC);
	}

	public function queryAllSongTitles(){
		global $HS;
		return $HS->queryAllSongTitles();
	}

	public function deleteSongTitle($UPC,$title){
		global $HS;
		$HS->deleteSongTitle($UPC,$title);
	}
	
	public function insertReturn($returnID,$date,$receiptID){
		echo"returnInsert Called DATA";
		global $R;
		$R->insertReturn($returnID,$date,$receiptID);
	}
	
	public function queryAllReturns(){
		global $R;
		return $R->queryAllReturns();
	}
	
	public function queryReturn(){
		global $R;
		return $R->queryReturn();
	}

	public function deleteReturn($returnID){
		global $R;
		$R->deleteReturn($returnID);
	}
	
	public function insertReturnItem($returnID,$UPC,$returnQuantity){
		echo"returnItemInsert Called DATA";
		global $RI;
		$RI->insertReturn($returnID,$UPC,$returnQuantity);
	}
	
	public function queryAllReturnItems(){
		global $RI;
		return $RI->queryAllReturnItems();
	}
	
	public function queryReturnItem($returnID,$UPC){
		global $RI;
		return $RI->queryReturnItem($returnID,$UPC);
	}

	public function deleteReturnItem($returnID,$UPC){
		global $RI;
		$RI->deleteReturnItem($returnID,$UPC);
	}

	public function insertCustomer($cid,$password,$name,$address,$phone)
	{
		echo"customerInsertCalled DATA";
		global $C;
		$C->insertCusotmer($cid,$password,$name,$address,$phone);
	}
	
	public function queryAllCustomers()
	{
		global $C;
		return $C->queryAllCustomers();
	}

	public function deleteCustomer($cid)
	{
		global $C;
		$C->deleteCustomer($cid);
	}

	public function insertPurchaseItem($receiptID,$UPC,$purchaseQuantity)
	{
		echo"purchaseItemInsertCalled DATA";
		global $PI;
		$PI->insertPurchaseItem($receiptID,$UPC,$purchaseQuantity);
	}
	
	public function queryAllPurchaseItems()
	{
		global $PI;
		return $PI->queryAllPurchaseItems();
	}

	public function deletePurchaseItem($receiptID,$UPC)
	{
		global $PI;
		$PI->deletePurchaseItem($receiptID,$UPC);
	}

}
?>
