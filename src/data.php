<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">

	<title>CPSC 304 Project Pt. 3</title>
<!--
    A simple stylesheet is provided so you can modify colours, fonts, etc.
-->
<!--<link href="cals.css" rel="stylesheet" type="text/css">-->

<!--
    Javascript to submit a title_id as a POST form, used with the "delete" links
-->
<script>
	function formSubmit(upc) {
		'use strict';
		if (confirm('Are you sure you want to delete this item?')) {
      // Set the value of a hidden HTML element in this form
      var form = document.getElementById('delete');
      form.upc.value = upc;
      // Post this form
      form.submit();
  }
}
</script>
</head>

<body>
	<?php

	$connection = NULL;
	$LoggedInUser = NULL;
$LS = NULL; 	//the lead singer reference
class Data
{
	public function __construct()
	{
		include 'objs/LeadSinger.php';
		include 'objs/HasSong.php';
		include 'objs/Order_.php';
		include 'objs/Return_.php';
		include 'objs/ReturnItem.php';
		include 'objs/Customer.php';
		include 'objs/PurchaseItem.php';
		include 'objs/Item_.php';

		$server = '127.0.0.1';
		$user = 'root';
		$pass = '';
		$dbname = 'Houns';
		
		global $connection;
		$connection = new mysqli($server, $user, $pass, $dbname);

		if (!mysqli_connect_errno()) {
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
		$O = new Order_($connection);

		global $HS;
		$HS = new HasSong($connection);

		global $R;
		$R = new Return_($connection);

		global $RI;
		$RI = new ReturnItem($connection);

		global $I;
		$I = new Item_($connection);

		global $PI;
		$PI = new PurchaseItem($connection);

		global $C;
		$C = new Customer($connection);


			    // Check that the connection was successful, otherwise exit
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			if (isset($_POST["submitDelete"])){
				if ($_POST["submitDelete"] == "DELETE ITEM") {

					$upc = $_POST['upc'];
					$this->deleteItem($upc);

       		} //DELETE ITEM close


	       } elseif (isset($_POST["submit"])){
	       	if( $_POST["submit"] ==  "Add Item") {   
	       		$UPC = $_POST["new_upc"];
	       		$title = $_POST["new_title"];
	       		$type = $_POST["new_type"];
	       		$category = $_POST["new_category"];
	       		$company = $_POST["new_company"];
	       		$year = $_POST["new_year"];
	       		$price = $_POST["new_price"];
	       		$stock = $_POST["new_stock"];
	       		$this->insertItem($UPC,$title,$type,$category,$company,$year,$price,$stock);
	       	}


	       	elseif($_POST["submit"] ==  "Add Lead Singers"){
	       		$UPC = $_POST["new_upc"];
	       		$name = $_POST["new_name"];
	       		$this->insertLeadSinger($UPC,$name);
	       	}

	       	elseif($_POST["submit"] ==  "Add A Song"){
	       		$UPC = $_POST["new_upc"];
	       		$title = $_POST["new_title"];
	       		$this->insertHasSong($UPC,$title);
	       	}
	       	elseif($_POST["submit"] ==  "Add A Return"){
	       		$returnDate = $_POST["new_returnDate"];
	       		$receiptID = $_POST["new_receiptID"];
	       		$this->insertReturn($returnDate,$receiptID);
	       	}
	       	elseif($_POST["submit"] ==  "Add Customer"){
	       		$cid = $_POST["new_cid"];
	       		$password = $_POST["new_password"];
	       		$name = $_POST["new_name"];
	       		$address = $_POST["new_address"];
	       		$phone = $_POST["new_phone"];
	       		$this->insertCustomer($cid,$password,$name,$address,$phone);

	       	}
	       	elseif($_POST["submit"] ==  "Add Order"){
	       		$date = $_POST["new_date"];
	       		$cid = $_POST["new_cid"];
	       		$cardNum = $_POST["new_cardNum"];
	       		$expiryDate = $_POST["new_expiryDate"];
				$this->insertOrder($date,$cid,$cardNum,$expiryDate); 
			}
			elseif($_POST["submit"] ==  "Update Delivery Date"){
				$receiptID = $_POST["new_receiptID"];
				$deliveredDate = $_POST["new_deliveredDate"];
				$this->updateDelivery($receiptID,$deliveredDate);
			}

			elseif($_POST["submit"] ==  "Add PurchaseItem"){
				$receiptID = $_POST["new_receiptID"];
				$UPC = $_POST["new_upc"];
				$quantity = $_POST["new_quantity"];
				$this->insertPurchaseItem($receiptID,$UPC,$quantity);
			}

			elseif($_POST["submit"] ==  "Add Return Item"){
				$retID = $_POST["new_retID"];
				$UPC = $_POST["new_upc"];
				$returnQuantity = $_POST["new_returnQuantity"];
				$this->insertReturnItem($retID,$UPC,$returnQuantity);
			}

			elseif($_POST["submit"] ==  "Get my daily sales"){
				$date = $_POST["new_Date"];
				$this->dailySales($date);
			}


			elseif($_POST["submit"] ==  "Get Top Selling"){
				$queryDate = $_POST["new_queryDate"];
				$n = $_POST["new_quantity"];
				$this->getTopSelling($queryDate,$n);
			}	


      		} //from elseif
  		}

	}

public function login($cid,$password){
	global $C;
	global $LoggedInUser;
	$LoggedInUser= $C->login($cid,$password);
	return $LoggedInUser;
}	

public function insertItem($UPC,$title,$type,$category,$company,$year,$price,$stock){
	global $I;
	return $I->insertItem($UPC,$title,$type,$category,$company,$year,$price,$stock);
}

public function queryAllItems(){
	global $I;
	return $I->queryAllItems();
}

public function deleteItem($UPC){
	global $I;
	return $I->deleteItem($UPC);
}

public function insertLeadSinger($UPC,$Name){
	global $LS;
	return $LS->insertLeadSinger($UPC,$Name);
}

public function queryAllLeadSingers(){
	global $LS;
	return $LS->queryAllLeadSingers();
}

public function deleteLeadSinger($UPC,$Name){
	global $LS;
	return $LS->deleteLeadSinger($UPC,$Name);
}

public function insertOrder($date,$CID,$cardNum,$expiryDate){ 
	global $O;
	return $O->insertOrder($date,$CID,$cardNum,$expiryDate); 
}

public function queryAllOrders(){
	global $O;
	return $O->queryAllOrders();
}

public function updateDelivery($receiptID,$deliveredDate){
	global $O;
	return $O->updateDelivery($receiptID,$deliveredDate);
}

public function deleteOrder($receiptID){
	global $O;
	return $O->deleteOrder($receiptID);
}

public function insertHasSong($UPC,$title){
	global $HS;
	return 	$HS->insertHasSong($UPC,$title);
}

public function queryAllSongTitles(){
	global $HS;
	return $HS->queryAllSongTitles();
}

public function deleteSongTitle($UPC,$title){
	global $HS;
	return $HS->deleteSongTitle($UPC,$title);
}

public function insertReturn($returnDate,$receiptID){
	global $R;
	return $R->insertReturn($returnDate,$receiptID);
}

public function queryAllReturns(){
	global $R;
	return $R->queryAllReturns();
}

public function queryReturn(){
	global $R;
	return $R->queryReturn();
}

public function deleteReturn($retID){
	global $R;
	return $R->deleteReturn($retID);
}

public function insertReturnItem($retID,$UPC,$returnQuantity){
	global $RI;
	return $RI->insertReturnItem($retID,$UPC,$returnQuantity);
}

public function queryAllReturnItems(){
	global $RI;
	return $RI->queryAllReturnItems();
}

public function queryReturnItem($retID,$UPC){
	global $RI;
	return $RI->queryReturnItem($retID,$UPC);
}

public function deleteReturnItem($retID,$UPC){
	global $RI;
	return $RI->deleteReturnItem($retID,$UPC);
}

public function insertCustomer($cid,$password,$name,$address,$phone)
{
	global $C;
	return $C->insertCustomer($cid,$password,$name,$address,$phone);
}

public function queryAllCustomers()
{
	global $C;
	return $C->queryAllCustomers();
}

public function deleteCustomer($cid)
{
	global $C;
	return $C->deleteCustomer($cid);
}

public function insertPurchaseItem($receiptID,$UPC,$quantity)
{
	global $PI;
	return $PI->insertPurchaseItem($receiptID,$UPC,$quantity);
}

public function queryAllPurchaseItems()
{
	global $PI;
	return $PI->queryAllPurchaseItems();
}

public function getTopSelling($queryDate,$n)
{
	global $PI;
	return $PI->topSelling($queryDate,$n);
}

public function deletePurchaseItem($receiptID,$UPC)
{
	global $PI;
	return $PI->deletePurchaseItem($receiptID,$UPC);
}

public function dailySales($reportDate)
{
	global $PI;
	return $PI->dailySales($reportDate);
}

public function searchItems($category,$title,$leadSinger)
{
	global $I;
	return $I->searchItems($category,$title,$leadSinger);
}

}
?>
</body>
</html>
