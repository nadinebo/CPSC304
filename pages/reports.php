
<!DOCTYPE html>
<html lang="en">
<head>
	<header class="navbar-inverse">
		<div class="container">
			<nav role="navigation">
					<a class="navbar-brand" href="customerHome.php">Cal's</a>
					<a class="navbar-brand" href="#">Clerk</a>
					<a class="navbar-brand" href="reports.php">Manager</a>
					<a class="navbar-brand" href="dev/item.php">Dev</a>
					<a class="navbar-brand" href="login.php">Logout</a>
			</nav>
		</div>
	</header>
	
	<link rel="stylesheet" href="styles/main.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

	<title>Cal's Managers</title>
	
</head>
<div class="container">
<body>


	<div class="container">
	<?php
	include '../src/presentation.php';

	$P = new Presentation();

	?>
		
		<table>
			<tr><h2> Reporting Tools </h2></tr>
			<tr>&nbsp;</tr>
			<tr>&nbsp;</tr>
		
		<!-- Daily Sales Report> -->	
		<?php

		echo "<tr><td><h3> Daily Sales Report </h3></td></tr><tr>";
		$input = array('Date');
		$P->buildAddForm($input,"Get my daily sales");
		echo "</tr><tr>&nbsp;</tr>"
		?>
			
		</table>
		
		
		<table>
			
			<tr>&nbsp;</tr>
			<tr>&nbsp;</tr>
		
		<!-- Top Selling Report> -->	
		<?php

		echo "<tr><td><h3> Top Selling Report </h3></td></tr><tr>";
		$input = array('queryDate','quantity');
		$P->buildAddForm($input,"Get Top Selling");
		echo "</tr><tr>&nbsp;</tr>"
		?>
			
		</table>
		</div>
		
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
		
	</body>
	</div>
	</html>

