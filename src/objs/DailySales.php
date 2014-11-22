<?php

$connection = NULL;

	class DailySales
	{
		public function __construct($conn)
		{
			global $connection;
			$connection = $conn;
			error_reporting(E_STRICT);
		}
		
	public function dailySales(){
		
		global $Logic;
		$input = array('date');
		$this->buildAddForm($input,"Get my daily sales");
		$result = $Logic->dailySales('2014-11-01');
		$schema = array('UPC','Category','ItemPrice','Quantity','Total');
		$this->buildTable("Daily Sales",$result,$schema);
		
		
	}

>
