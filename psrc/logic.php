<?php
	error_reporting(E_ALL);
class Logic
{
//	include 'data.php';

	public function initLogic()
	{
		echo"Logic time";
	}

	public function getLeadSingers()
	{
		echo "searching for those lead singners";
		return queryAllLeadSingers();	
	}	
}
?>
