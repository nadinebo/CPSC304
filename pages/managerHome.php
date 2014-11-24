<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../styles/main.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

	<title>Cal's Managers</title>
	
</head>

<body>

	<header class="navbar-inverse">
		<div class="container">
			<nav role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="home.php">Cal's Music Store</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="customerHome.php">Customer<span class="sr-only">(current)</span></a></li>
						<li><a href="clerkHome.php">Clerk</a></li>
						<li class="active"><a href="managerHome.php">Manager</a></li>
						<li><a href="developerHome.php">NewDev</a></li>
						<li><a href="dev/item.php">OldDev</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
								<li class="divider"></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li>	
						<li><a href="shoppingCart.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
						<li><a href="login.php">Logout</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</div>
	</header>

	<div class="container">
		<h4><em>This page will include tabs for the different actions a Manager can do.</em></h3>
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
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</div>
</html>

