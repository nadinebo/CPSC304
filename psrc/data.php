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

			$server = '127.0.0.1';
			$user = 'root';
			$pass = '';
			$dbname = 'Houns';
			
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
	}

	public function insertLeadSinger($UPC,$Name){
		echo"leadSingerinsertCalled DATA";
		global $LS;
		$LS->insertLeadSinger($UPC,$Name);
	}
	
	public function queryAllLeadSingers(){
		global $LS;
		return $LS->queryAllLeadSingers();
	}

	public function deleteLeadinger($UPC,$Name){
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
}
?>
