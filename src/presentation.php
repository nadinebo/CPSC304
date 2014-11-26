<?php
	$Logic = NULL;
class Presentation
{
	public function __construct()
	{
		include 'logic.php';
		global $Logic;
		$Logic = new Logic;
	}
	public function buildTable($tableName,$result,$schema,$delete,$primary){
		
			//Added here
	// Avoid Cross-site scripting (XSS) by encoding PHP_SELF (this page) using htmlspecialchars.
    echo "<form id=\"delete\" name=\"delete\" action=\"";
    echo htmlspecialchars($_SERVER["PHP_SELF"]);
    echo "\" method=\"POST\">";
    // Hidden value is used if the delete link is clicked
    echo "<input type=\"hidden\" name=\"upc\" value=\"-1\"/>";
   // We need a submit value to detect if delete was pressed 
    echo "<input type=\"hidden\" name=\"submitDelete\" value=\"DELETE ITEM\"/>";

	//End add

		
		echo "<h2>".$tableName."</h2>";
		echo "<table border=0 cellpadding =0 cellspacing=0>";
		echo "<tr valine=center>";
		for($i=0;$i<count($schema);$i++)
		{
			echo "<td class=rowheader>".$schema[$i]."</td>";
		}
		echo "</tr>";
		
		while($row = $result->fetch_assoc()){
			for($i=0;$i<count($schema);$i++)
			{
				echo"<td>".$row[$schema[$i]]."</td>";
			}
			echo "<td>";
       			echo "<a href=\"javascript:formSubmit('".$row['upc']."');\">".$delete."</a>";
			echo"</td></tr>";
		}
		echo"</table>";
		echo"<br><br>";
		
		echo "</form>";
	}
	
	public function buildAddForm($schema, $action){
		echo "<form id=\"add\" name=\"add\" method=\"post\" action=\"";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
		echo"\">";
    		echo"<table border=0 cellpadding=0 cellspacing=0>";
		for($i=0;$i<count($schema);$i++)
		{
			echo "<tr><td>".$schema[$i]."</td><td><input type=\"text\" size=30 name=\"new_".$schema[$i]."\"</td></tr>";
		}
        	echo"<tr><td></td><td><input type=\"submit\" name=\"submit\" border=0 value=\"".$action."\"></td></tr>";
    		echo"</table>";
		echo"</form>";
	}
	
		public function buildTopSellersForm($schema, $action){
		echo "<form id=\"add\" name=\"add\" method=\"post\" action=\"";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
		echo"\">";
    		echo"<table border=0 cellpadding=0 cellspacing=0>";
		for($i=0;$i<count($schema);$i++)
		{
			echo "<tr><td>".$schema[$i]."</td><td><input type=\"text\" size=30 name=\"new_".$schema[$i]."\"</td></tr>";
		}
        	echo"<tr><td></td><td><input type=\"submit\" name=\"submit\" border=0 value=\"".$action."\"></td></tr>";
    		echo"</table>";
		echo"</form>";
	}

	
	/*
		returns -1 if the customer does not exit or invalid
		returns 0  if the customer is good, also the logged in customer is set
	*/	
	public function login($cid,$password){
		global $Logic;
		$resp = $Logic->login($cid,$password);
		$schema = array('cid','password','name', 'address','phone');	
		if($resp == null){
			return -1;
		}
		else{
			for($i=0;$i<count($schema);$i++){
				$ret[$schema[$i]] = $resp[$i];
			}	
			return $ret;
		}
	}
	
	public function register($cid,$password,$name,$address,$phone){
		global $Logic;
		$Logic->newCustomer($cid,$password,$name,$address,$phone);
	}
		
	public function Itemsd()
	{
		global $Logic;
		
		//Added this
		$Logic->removeItem(38493);
		$Logic->removeItem(22231);
		$Logic->removeItem(11111);
		$Logic->removeItem(22222);
		$Logic->newItem(38493,'St.Vincent','CD','POP','muhrecords',2014,20,1);
		$Logic->newItem(11111,'test1','CD','POP','muhrecords',2014,20,10);
		$Logic->newItem(22222,'test2','CD','POP','muhrecords',2014,20,1);
		//testing using the layers as classes
		$result = $Logic->getItems();
		$schema = array('upc','title','type','category','company','year','price','stock');
		$delete = "DELETE ITEM";
		$primary = 'upc';
		$this->buildTable("All Items",$result,$schema,$delete,$primary);
		$action = "Add Item";
		$this->buildAddForm($schema, $action);

	}

	public function getItems()
	{
		global $Logic;
		$result = $Logic->getItems();
		return $result;
	}

	
	public function singersd()
	{
		global $Logic;
		
		$Logic->removeLeadSingers(38493,'St.Vincent');
		$Logic->removeLeadSingers(22231,'Michal Geera');
		
		$Logic->newLeadSinger(38493,'St.Vincent');
		$Logic->newLeadSinger(22231,'Michal Geera');
		
		//testing using the layers as classes
		$result = $Logic->getLeadSingers();
		$schema = array('upc','name');	
		$this->buildTable("All Lead Singers",$result,$schema);
		$action = "Add Lead Singers";
		$this->buildAddForm($schema, $action);

	}


	public function songs()
	{
		global $Logic;
		
		$Logic->removeSongTitle(38493,'I prefer your love');
		$Logic->removeItem(38493);
		
		$Logic->newItem(38493,'St.Vincent','CD','POP','muhrecords',2014,20,1);
		$Logic->newSongTitle(38493,'I prefer your love');
		
		$result = $Logic->getAllSongTitles();
		$schema = array('upc','title');
		$this->buildTable("All Songs",$result,$schema);
		$action = "Add A Song";
		$this->buildAddForm($schema, $action);
		$Logic->removeItem(38493);
			
	}

	
	public function customers(){
	
		global $Logic;
		
		$Logic->removeCustomer(1000);
		$Logic->removeCustomer(2000);
		$Logic->newCustomer(1000,'ilikejane','JohnDoe','1234 W10th ave','604-123-4567');
		$Logic->newCustomer(2000,'ilikejohn','JaneDoe','1234 W10th ave','604-123-4567');

		$result = $Logic->getCustomers();
		
		/*while($row = $result->fetch_assoc()){
			echo"<td>".$row['cid']."</td>";
			echo"<td>".$row['password']."</td>";
			echo"<td>".$row['name']."</td>";
			echo"<td>".$row['address']."</td>";
			echo"<td>".$row['phone']."</td>";
		}*/
		
		$result = $Logic->getCustomers();
		$schema = array('cid','password','name', 'address','phone');	
		$this->buildTable("All Customers",$result,$schema);
		$action = "Add Customer";
		$this->buildAddForm($schema, $action); 
		
	}
	
	
	public function orders1(){
	
		global $Logic;
		
		$Logic->removeOrder(12014);
		$Logic->removeOrder(11014);
		
		$Logic->newOrder(12014,'2014-11-01',1000,45678,'2017','2014-12-01',null);
		$Logic->newOrder(11014,'2014-11-01',2000,45123,'2015','2014-12-01',null);
			
		$result = $Logic->getAllOrders();
		$schema = array('receiptID','date','cid','cardNum','expiryDate','expectedDate','deliveredDate');
		$this->buildTable("All Orders",$result,$schema);
		$this->buildAddForm($schema, "Add Order"); 
		
	}
	
	
	public function purchaseitems(){
	
		global $Logic;
		$Logic->removePurchaseItem(12014,11111);
		$Logic->removePurchaseItem(11014,22222);
		$Logic->newPurchaseItem(12014,11111,5);
		$Logic->newPurchaseItem(11014,22222,5);
		$result = $Logic->getAllPurchaseItems();
		$schema = array('receiptID','upc','quantity');
		$this->buildTable("All Purchased Items",$result,$schema);
		$this->buildAddForm($schema,"Add PurchaseItem");
	
	}
	
	
	
	public function returns(){
	
		global $Logic;
		
		$Logic->newReturn(12345,'2014-11-11',12014);
		$Logic->newReturn(90876,'2014-11-10',11014);
		
		$result = $Logic->getAllReturns();
		$schema = array('retID','returnDate','receiptID');
		$this->buildTable("All Returns",$result,$schema);
		$action = "Add A Return";
		$this->buildAddForm($schema, $action);
	
	}


	public function returnitems(){
	
		global $Logic;
		
		$Logic->newReturnItem(12345,11111,1);
		$Logic->newReturnItem(90876,22222,1);

		$result = $Logic->getAllReturnItems();
		$schema = array('retID','upc','returnQuantity');
		$this->buildTable("All Returned Items",$result,$schema);
		$this->buildAddForm($schema,"Add Return Item");
		
	}
		
	
}
?>
