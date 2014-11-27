<?php
	include '../src/presentation.php';
	$P = new Presentation();
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST["submit"]) && $_POST["submit"] == "Login"){
			$cid = $_POST["new_cid"];
			$password = $_POST["new_password"];
			$response = $P->login($cid,$password);
			if($response >= 0){
				//session_name('Private');
				session_start();
				echo $response['cid'];
				$_SESSION['user']=$response;
				$P->buildAddForm(array('cid','password'),"Login");
				header('Location: home.php');
			}
		}
	}

?>

<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
	<title>Cals</title>
	<link href="../styles/main.css" rel="stylesheet" type="text/css">
</head>
<body>


	<h2> Welcome to Cals </h2>
	<?php

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST["submit"]) && $_POST["submit"] == "Login"){
			$cid = $_POST["new_cid"];
			$password = $_POST["new_password"];
			$response = $P->login($cid,$password);
			if($response < 0){
				$P->buildAddForm(array('cid','password'),"Login");
				echo "<b>Invalid User name or Password<b><br>";
				echo "<a href=\"register.php\">Would you like to register?</a>";
			}
			else {
			echo "<a href=\"home.php\">Take me the the home page</a>";
			}
		}
	}
	else{
		$P->buildAddForm(array('cid','password'),"Login");
		echo "<a href=\"register.php\">Would you like to register?</a>";
	}
	?>
</body>
</html>
