<?php


$connection = NULL;
$LS = NULL; 	//the lead singer reference
class Data
{
	public function __construct()
	{
			include 'objs/LeadSinger.php';

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



}
?>
