<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../styles/main.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
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
						<li><a href="managerHome.php">Manager</a></li>
						<li class="active"><a href="developerHome.php">Dev</a></li>
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
						<li><a href="login.php">Logout</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</div>
	</header>
	<div class="container">
		<h4><em>This page contains all of our tests.</em></h3>
		<p>Navigate through the tests via tabs.</p>
		
		
		 <div role="tabpanel">
			<!--Nav tabs-->
		 	<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All</a></li>
				<li role="presentation"><a href="#customers" aria-controls="customers" role="tab" data-toggle="tab">Customers</a></li>
				<li role="presentation"><a href="#items" aria-controls="items" role="tab" data-toggle="tab">Items</a></li>
				<li role="presentation"><a href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Orders</a></li>
				<li role="presentation"><a href="#purchases" aria-controls="purchases" role="tab" data-toggle="tab">Purchases</a></li>
				<li role="presentation"><a href="#returns" aria-controls="returns" role="tab" data-toggle="tab">Returns</a></li>
				<li role="presentation"><a href="#returnedItems" aria-controls="returnedItems" role="tab" data-toggle="tab">Returned Items</a></li>
				<li role="presentation"><a href="#singers" aria-controls="singers" role="tab" data-toggle="tab">Singers</a></li>
				<li role="presentation"><a href="#songs" aria-controls="songs" role="tab" data-toggle="tab">Songs</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<?php
				include '../src/presentation.php';
				$P = new Presentation();
				?>

				<div role="tabpanel" class="tab-pane active" id="all">
					<?php
					$P->customers();
					$P->Itemsd();
					$P->orders1();
					$P->purchaseitems();
					$P->returns();
					$P->returnitems();
					$P->singersd();
					$P->songs();
					echo " *** DONE! *** ";
					?>
				</div>
				<div role="tabpanel" class="tab-pane" id="customers">
					<?php
					$P->customers();
					echo " *** DONE! *** ";
					?>
				</div>
				<div role="tabpanel" class="tab-pane" id="items">
					<?php
					$P->Itemsd();
					echo " *** DONE! *** ";
					?>
				</div>
				<div role="tabpanel" class="tab-pane" id="orders">
					<?php
					$P->orders1();
					echo " *** DONE! *** ";
					?>
				</div>
				<div role="tabpanel" class="tab-pane" id="purchases">
					<?php
					$P->purchaseitems();
					echo " *** DONE! *** ";
					?>
				</div>
				<div role="tabpanel" class="tab-pane" id="returns">
					<?php
					$P->returns();
					echo " *** DONE! *** ";
					?>
				</div>
				<div role="tabpanel" class="tab-pane" id="returnedItems">
					<?php
					$P->returnitems();
					echo " *** DONE! *** ";
					?>
				</div>
				<div role="tabpanel" class="tab-pane" id="singers">
					<?php
					$P->singersd();
					echo " *** DONE! *** ";
					?>
				</div>
				<div role="tabpanel" class="tab-pane" id="songs">
					<?php
					$P->songs();
					echo " *** DONE! *** ";
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
</html>