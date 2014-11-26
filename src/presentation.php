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
		echo "<table class='table'>";
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
    		echo"<table>";
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
		if($resp == null){
			return -1;
		}
		else{
			return 0;
		}
	}
	
	public function register($cid,$password,$name,$address,$phone){
		global $Logic;
		$Logic->newCustomer($cid,$password,$name,$address,$phone);
	}
		
	public function Itemsd()
	{
		global $Logic;
				
		//testing using the layers as classes
		$result = $Logic->getItems();
		$schema = array('upc','title','type','category','company','year','price','stock');
		
		$delete = "DELETE ITEM";
		$primary = 'upc';
		$this->buildTable("All Items",$result,$schema,$delete,$primary);
		$action = "Add Item";
		$this->buildAddForm($schema, $action);

	}

	
	public function singersd()
	{
		global $Logic;

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
		
		$result = $Logic->getAllSongTitles();
		$schema = array('upc','title');
		$this->buildTable("All Songs",$result,$schema);
		$action = "Add A Song";
		$this->buildAddForm($schema, $action);
		$Logic->removeItem(38493);
			
	}

	
	public function customers(){
	
		global $Logic;
		
		$result = $Logic->getCustomers();
		$schema = array('cid','password','name', 'address','phone');	
		$this->buildTable("All Customers",$result,$schema);
		$action = "Add Customer";
		$this->buildAddForm($schema, $action); 
		
	}
	
	
	public function orders1(){
	
		global $Logic;
		
		$result = $Logic->getAllOrders();
		$schema = array('receiptID','date','cid','cardNum','expiryDate','expectedDate','deliveredDate');
		$this->buildTable("All Orders",$result,$schema);
		$this->buildAddForm($schema, "Add Order"); 
		
		//ADDED HERE
		$schema1 = array('receiptID','deliveredDate');
		//$this->buildTable("All Orders",$result,$schema);
		echo "<h3>Update Order</h3>";
		$this->buildAddForm($schema1, "Update Delivery Date"); 
		
		//
		
	}
	
	
	public function purchaseitems(){
	
		global $Logic;
		
		$result = $Logic->getAllPurchaseItems();
		$schema = array('receiptID','upc','quantity');
		$this->buildTable("All Purchased Items",$result,$schema);
		$this->buildAddForm($schema,"Add PurchaseItem");
	
	}
	
	
	
	public function returns(){
	
		global $Logic;
		
		$result = $Logic->getAllReturns();
		$schema = array('retID','returnDate','receiptID');
		$this->buildTable("Process Return for Refund",$result,$schema);
		$action = "Add A Return";
		$this->buildAddForm($schema, $action);
	
	}


	public function returnitems(){
	
		global $Logic;
		
		$result = $Logic->getAllReturnItems();
		$schema = array('retID','upc','returnQuantity');
		$this->buildTable("Specify Returned Items",$result,$schema);
		$this->buildAddForm($schema,"Add Return Item");
		
	}
		
	public function initData(){
		global $Logic;

		// Re-initialize Database

		// CD Albums
		$Logic->newItem(20001,'1989','CD','Pop','Big Machine Records',2014,14.99,10);
		$Logic->newItem(20002,'Bitches Brew','CD','Jazz','Original',1970,9.99,10);
		$Logic->newItem(20003,'Led Zeppelin','CD','Rock','Atlantic Recording Corp.',1969,9.99,10);
		$Logic->newItem(20004,'Songs About Jane','CD','Pop','Interscope Records',2002,9.99,10);
		$Logic->newItem(20005,'Crash My Party','CD','Country','Capitol Records Nashville',2013,14.99,10);
		$Logic->newItem(20006,'Tailgates & Tanlines','CD','Country','Capitol Records Nashville',2011,14.99,10);
		$Logic->newItem(20007,'Dream Your Life Away','CD','Alternative','Atlantic Recording Corp.',2014,14.99,10);

		// DVDs
		$Logic->newItem(10001,'Now You See Me','DVD','Thriller','Summit Entertainment',2013,19.99,10);
		$Logic->newItem(10002,'Gone Girl','DVD','Drama','20th Century',2014,19.99,10);
		$Logic->newItem(10003,'The Hunger Games','DVD','Adventure','Lionsgate',2012,19.99,10);
		$Logic->newItem(10004,'The Hunger Games: Catching Fire','DVD','Adventure','Lionsgate',2013,19.99,10);
		$Logic->newItem(10005,'The Hunger Games: Mockingjay - Part 1','DVD','Adventure','Lionsgate',2014,19.99,10);
		$Logic->newItem(10006,'Inception','DVD','Action','Warner Bros.',2010,19.99,10);
		$Logic->newItem(10007,'Guardians of the Galaxy','DVD','Action','Marvel Studios.',2014,19.99,10);
		$Logic->newItem(10008,'The Party','DVD','Comedy','Mirisch Corp.',2014,19.99,10);
		$Logic->newItem(10009,'Fight Club','DVD','Drama','20th Century',1999,19.99,10);
		$Logic->newItem(10010,'The Shawshank Redemption','DVD','Drama','Castle Rock Entertainment',1994,19.99,10);
		$Logic->newItem(10011,'The Dark Knight','DVD','Action','Warner Bros.',2008,19.99,10);
		$Logic->newItem(10012,'The Lego Movie','DVD','Animation','Warner Bros.',2014,19.99,10);

		// Artists of Albums
		$Logic->newLeadSinger(20001,'Taylor Swift');
		$Logic->newLeadSinger(20002,'Miles Davis');
		$Logic->newLeadSinger(20003,'Led Zeppelin');
		$Logic->newLeadSinger(20004,'Maroon 5');
		$Logic->newLeadSinger(20005,'Luke Bryan');
		$Logic->newLeadSinger(20006,'Luke Bryan');
		$Logic->newLeadSinger(20007,'Vance Joy');

		// Taylor Swift, 1989
		$Logic->newSongTitle(20001,'Shake it off');
		$Logic->newSongTitle(20001,'Blank space');
		$Logic->newSongTitle(20001,'Welcome to New York');

		// Miles Davis, Bitches Brew
		$Logic->newSongTitle(20002,"Pharaoh's Dance");
		$Logic->newSongTitle(20002,'Bitches Brew');
		$Logic->newSongTitle(20002,'Miles Runs the Voodoo Down');
		$Logic->newSongTitle(20002,'Spanish Key');
		$Logic->newSongTitle(20002,'Feio');

		// Led Zeppelin, Led Zeppelin II
		$Logic->newSongTitle(20003,"Whole Lotta Love");
		$Logic->newSongTitle(20003,'What Is and What Should Never Be');
		$Logic->newSongTitle(20003,'The Lemon Song');
		$Logic->newSongTitle(20003,'Thank You');
		$Logic->newSongTitle(20003,'Heartbreaker');
		$Logic->newSongTitle(20003,"Living Loving Maid (She's Just a Woman)");
		$Logic->newSongTitle(20003,'Ramble On');
		$Logic->newSongTitle(20003,'Moby Dick');
		$Logic->newSongTitle(20003,'Bring It On Home');

		// Maroon 5, Songs About Jane
		$Logic->newSongTitle(20004,"Harder to Breathe");
		$Logic->newSongTitle(20004,'This Love');
		$Logic->newSongTitle(20004,'Shiver');
		$Logic->newSongTitle(20004,'She Will Be Loved');
		$Logic->newSongTitle(20004,'Tangled');
		$Logic->newSongTitle(20004,"The Sun");
		$Logic->newSongTitle(20004,'Must Get Out');
		$Logic->newSongTitle(20004,'Sunday Morning');
		$Logic->newSongTitle(20004,'Secret');
		$Logic->newSongTitle(20004,'Through With You');
		$Logic->newSongTitle(20004,'Not Coming Home');
		$Logic->newSongTitle(20004,'Sweetest Goodbye');

		// Luke Bryan, Crash My Party
		$Logic->newSongTitle(20005,"That's My Kind of Night");
		$Logic->newSongTitle(20005,'Crash My Party');
		$Logic->newSongTitle(20005,'Roller Coaster');
		$Logic->newSongTitle(20005,'Drink a Beer');
		$Logic->newSongTitle(20005,'Play It Again');
		$Logic->newSongTitle(20005,"Dirt Road Diary");
		$Logic->newSongTitle(20005,'I See You');

		// Luke Bryan, Tailgates & Tanlines
		$Logic->newSongTitle(20006,"Country Girl (Shake It for Me)");
		$Logic->newSongTitle(20006,'Kiss Tomorrow Goodbye');
		$Logic->newSongTitle(20006,'Drunk On You');
		$Logic->newSongTitle(20006,"I Don't Want This Night To End");

		// Vance Joy, Dream Your Life Away
		$Logic->newSongTitle(20007,'Mess Is Mine');
		$Logic->newSongTitle(20007,'Wasted Time');
		$Logic->newSongTitle(20007,'Riptide');
		$Logic->newSongTitle(20007,'Who Am I');
		$Logic->newSongTitle(20007,'Red Eye');
		$Logic->newSongTitle(20007,'Georgia');


		// From customers()
		$Logic->newCustomer(304,'cs304','DevTest','1234 Main Mall','778-123-4567');
		$Logic->newCustomer(1000,'ilikejane','JohnDoe','1234 W10th ave','604-123-4567');
		$Logic->newCustomer(2000,'ilikejohn','JaneDoe','1234 W10th ave','604-123-4567');

		// From orders1()
		$Logic->newOrder(12014,'2014-11-01',1000,45678,'2017','2014-12-01',null);
		$Logic->newOrder(11014,'2014-11-01',2000,45123,'2015','2014-12-01',null);

		// From purchaseitems()
		$Logic->newPurchaseItem(12014,10007,5);
		$Logic->newPurchaseItem(12014,20005,2);
		$Logic->newPurchaseItem(12014,20002,7);
		$Logic->newPurchaseItem(11014,20001,2);
		$Logic->newPurchaseItem(11014,10003,1);
		$Logic->newPurchaseItem(11014,20004,3);

		// From returns()
		$Logic->newReturn(12345,'2014-11-11',12014);
		$Logic->newReturn(90876,'2014-11-10',11014);

		$Logic->newReturnItem(12345,10007,2);
		$Logic->newReturnItem(12345,20002,1);
		$Logic->newReturnItem(90876,20004,3);
	}
	
}
?>
