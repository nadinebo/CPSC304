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
					<a class="navbar-brand" href="home.php" style="color: white">Cal's Music Store</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="customerHome.php">Customer</a></li>
						<li><a href="clerkHome.php">Clerk</a></li>
						<li><a href="managerHome.php">Manager</a></li>
						<li><a href="developerHome.php">Dev</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="login.php">Logout</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</header>

	<div class="container">
		<h2>Welcome, Manager.</h2>

		<div role="tabpanel">
			<!--Nav tabs-->
		 	<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#addItem" aria-controls="addItem" role="tab" data-toggle="tab">Add Item</a></li>
				<li role="presentation"><a href="#processDelivery" aria-controls="processDelivery" role="tab" data-toggle="tab">Process Delivery</a></li>
				<li role="presentation"><a href="#dailySalesReport" aria-controls="dailySalesReport" role="tab" data-toggle="tab">Daily Sales Report</a></li>
				<li role="presentation"><a href="#topSellingReport" aria-controls="topSellingReport" role="tab" data-toggle="tab">Top Selling Items Report</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<?php
				include '../src/presentation.php';
				$P = new Presentation();
				?>
				<div role="tabpanel" class="tab-pane active" id="addItem">
					<h3> Add Item to Store </h3>
					<?php
					$P->Itemsd();
					?>
				</div>
				<div role="tabpanel" class="tab-pane" id="processDelivery">
					<h3> Process Delivery of an Order </h3>
					<?php
					$P->orders1();
					?>
				</div>
				<div role="tabpanel" class="tab-pane" id="dailySalesReport">
					<h3> Daily Sales Report </h3>
					<?php
					$input = array('Date');
					$P->buildAddForm($input,"Get my daily sales");
					?>
				</div>
				<div role="tabpanel" class="tab-pane" id="topSellingReport">
					<h3> Top Selling Report </h3>
					<?php
					$input = array('queryDate','quantity');
					$P->buildAddForm($input,"Get Top Selling");
					?>
				</div>
			</div>
		</div>
		
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</div>
</html>

