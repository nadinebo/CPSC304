<?php
function devtabs($funct){
	echo"<!DOCTYPE html>";
	echo"<html lang=en>";
	echo"<head>";

	echo"	<link rel=\"stylesheet\" href=\"styles/main.css\">";

	echo"	<!-- Latest compiled and minified CSS -->";
	echo"	<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css\">";

	echo"	<!-- Optional theme -->";
	echo"	<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css\">";
	echo"</head>";

	echo"<body>";
	echo"	<header class=\"navbar-inverse\">";
	echo"		<div class=\"container\">";
	echo"			<nav role=\"navigation\">";
	echo"				<!-- Brand and toggle get grouped for better mobile display -->";
	echo"				<div class=\"navbar-header\">";
	echo"					<button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">";
	echo"						<span class=\"sr-only\">Toggle navigation</span>";
	echo"						<span class=\"icon-bar\"></span>";
	echo"						<span class=\"icon-bar\"></span>";
	echo"						<span class=\"icon-bar\"></span>";
	echo"					</button>";
	echo"					<a class=\"navbar-brand\" href=\"../customerHome.php\">Home</a>";
	echo"					<a class=\"navbar-brand\" href=\"customer.php\">Customer</a>";
	echo"					<a class=\"navbar-brand\" href=\"item.php\">Item</a>";
	echo"					<a class=\"navbar-brand\" href=\"purchase.php\">Purchase</a>";
	echo"					<a class=\"navbar-brand\" href=\"return.php\">Return</a>";
	echo"					<a class=\"navbar-brand\" href=\"songs.php\">Song</a>";
	echo"					<a class=\"navbar-brand\" href=\"order.php\">Order</a>";
	echo"					<a class=\"navbar-brand\" href=\"returnItem.php\">Return Item</a>";
	echo"					<a class=\"navbar-brand\" href=\"singers.php\"></a>";
	echo"				</div>";

	echo"				<!-- Collect the nav links, forms, and other content for toggling -->";
	echo"			</nav>";
	echo"	</header>";
	echo"	";
	echo"	<div class=\"container\">";
			
			include '../../src/presentation.php';
			$P = new Presentation();
			switch($funct){
				case "customer":
					$P->customers();
				break;
				case "song":
					$P->songs();
				break;
				case "singer":
					$P->singersd();
				break;
				case "item":
					$P->Itemsd();
				break;
				case "order":
					$P->orders1();
				break;
				case "purchase":
					$P->purchaseitems();
				break;
				case "return":
					$P->returns();
				break;
				case "returnitem":
					$P->returnitems();
				break;
			}
			echo " *** DONE! *** ";

	echo"	</div>";
	echo"	";
	echo"	<script>";
	echo"		function formSubmit(titleId) {";
	echo"			'use strict';";
	echo"			if (confirm('Are you sure you want to delete this title?')) {";
	echo"		    	// Set the value of a hidden HTML element in this form";
	echo"		    	var form = document.getElementById('delete');";
	echo"		    	form.title_id.value = titleId;";
	echo"			      // Post this form";
	echo"			      form.submit();";
	echo"			  }";
	echo"			};";
	echo"	</script>";
	echo"	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->";
	echo"	<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>";
	echo"	<!-- Latest compiled and minified JavaScript -->";
	echo"	<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js\"></script>";
	echo"";
	echo"	</body>";
	echo"	</html>";
}
?>
