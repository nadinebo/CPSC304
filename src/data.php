<?php
$connection = NULL;
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
			include 'objs/TopSellingItems.php';
			include 'objs/Item_.php';
			$server = '127.0.0.1';
			$user = 'root';
			$pass = '';
			$dbname = 'Houns';
		
			global $connection;
			$connection = new mysqli($server, $user, $pass, $dbname);
			//mysql_select_db($dbname);
		    
		    if (!mysqli_connect_errno()) {
			echo "<b>Welcome!</b>";
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
			
			//echo "data init";
			global $PI;
			$PI = new PurchaseItem($connection);
			global $C;
			$C = new Customer($connection);
			
			
			
			//Added this
			
			    // Check that the connection was successful, otherwise exit
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST["submitDelete"]) && $_POST["submitDelete"] == "DELETE") {
       /*
          Delete the selected item
        */
  /*     
       // Create a delete query prepared statement with a ? for the title_id
       $stmt = $connection->prepare("DELETE FROM titles WHERE title_id=?");
       $deleteTitleID = $_POST['title_id'];
       // Bind the title_id parameter, 's' indicates a string value
       $stmt->bind_param("s", $deleteTitleID);
       
       // Execute the delete statement
       $stmt->execute();
          
       if($stmt->error) {
         printf("<b>Error: %s.</b>\n", $stmt->error);
       } else {
         echo "<b>Successfully deleted ".$deleteTitleID."</b>";
       }*/
            
     // } elseif (isset($_POST["submit"]) && $_POST["submit"] ==  "ADD") { 
           
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
       	 	$stmt = $connection->prepare("INSERT INTO Item_ (upc, title, type, category, company, year, price, stock) VALUES (?,?,?,?,?,?,?,?)");
          
        	$stmt->bind_param("issssiii", $UPC, $title, $type, $category, $company, $year, $price, $stock);
        }
      //}
      
      elseif($_POST["submit"] ==  "Add Lead Singers"){
       	$UPC = $_POST["new_upc"];
        $name = $_POST["new_name"];
      
        $stmt = $connection->prepare("INSERT INTO LeadSinger (upc, name) VALUES (?,?)");
          
        $stmt->bind_param("is", $UPC, $name);
        
      }
      
    	elseif($_POST["submit"] ==  "Add A Song"){
       	$UPC = $_POST["new_upc"];
        $title = $_POST["new_title"];
      
        $stmt = $connection->prepare("INSERT INTO HasSong (upc, title) VALUES (?,?)");
          
        $stmt->bind_param("is", $UPC, $title);
      
      }
    	elseif($_POST["submit"] ==  "Add A Return"){
       	$retID = $_POST["new_retID"];
        $returnDate = $_POST["new_returnDate"];
        $receiptID = $_POST["new_receiptID"];
      
        $stmt = $connection->prepare("INSERT INTO Return_ (retID, returnDate, receiptID) VALUES (?,?,?)");
          
        $stmt->bind_param("isi", $retID, $returnDate, $receiptID);
              
      }
      
        elseif($_POST["submit"] ==  "View Top Selling Items"){
        
       	printf("You are viewing the 'Top Selling' table stub!");
       	
       	$date = $_POST["new_date"];
        $n = $_POST["new_n"];
      
        //$stmt = $connection->prepare("INSERT INTO LeadSinger (upc, name) VALUES (?,?)");
          
        //$stmt->bind_param("is", $UPC, $name);
        
        
        
        $TS = new TopSellingItems();
        //$TS->queryAllTopSellingItems();
       	
        
      }
      
      	$stmt->execute();
    	if($stmt->error) {       
          printf("<b>Error: %s.</b>\n", $stmt->error);
        } else {
          echo "<b>Successfully added entry!</b>";
        }
      } //from elseif
   }
			
			//End add
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
	public function insertOrder($receiptID,$date,$CID,$cardNum,$expiryDate,$expectedDate,$deliveredDate){
		global $O;
		$O->insertOrder($receiptID,$date,$CID,$cardNum,$expiryDate,$expectedDate,$deliveredDate);
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
		global $HS;
		$HS->insertHasSong($UPC,$title);
	}
	public function queryAllSongTitles(){
		global $HS;
		return $HS->queryAllSongTitles();
	}
	public function deleteSongTitle($UPC,$title){
		global $HS;
		$HS->deleteSongTitle($UPC,$title);
	}
	
	public function insertReturn($retID,$returnDate,$receiptID){
		//echo"returnInsert Called DATA";
		global $R;
		$R->insertReturn($retID,$returnDate,$receiptID);
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
		$R->deleteReturn($retID);
	}
	
	public function insertReturnItem($retID,$UPC,$returnQuantity){
		//echo"returnItemInsert Called DATA";
		global $RI;
		$RI->insertReturnItem($retID,$UPC,$returnQuantity);
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
		$RI->deleteReturnItem($retID,$UPC);
	}
	public function insertCustomer($cid,$password,$name,$address,$phone)
	{
		//echo"customerInsertCalled DATA";
		global $C;
		$C->insertCustomer($cid,$password,$name,$address,$phone);
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
	public function insertPurchaseItem($receiptID,$UPC,$quantity)
	{
		//echo"purchaseItemInsertCalled DATA";
		global $PI;
		$PI->insertPurchaseItem($receiptID,$UPC,$quantity);
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
	public function dailySales($reportDate)
	{
		global $PI;
		$PI->dailySales($reportDate);
	}
}
?>