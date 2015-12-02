<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../styles/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
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
		<h1>This is Cal's home page.</h1>
		<?php
			// session_start();
			// $user = $_SESSION['user'];
			// 	echo "<h1>Welcome back to Cal's ".$user['name']."</h1><br>";
		?>	
		<p><em>We're a local music shop, where you can shop online for rare and specialized goods.</em></p>
		<p><strong>Select one of the following perspectives above to get started.</strong></p>		
		<!--<button type="button" id="initButton" data-complete-text="Initialized" class="btn btn-success">Initialize Database</button>-->
		
		
	</div>

	<?php
	include '../src/presentation.php';
//	$P = new Presentation();
//	$P->initData();
	?>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>
