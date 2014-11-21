<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">

	<title>Cals</title>
<!--
    A simple stylesheet is provided so you can modify colours, fonts, etc.
-->
<link href="../src/cals.css" rel="stylesheet" type="text/css">

</head>

<body>


	<h2> Welcome to Cals </h2>
	<?php
	include '../src/presentation.php';
	$P = new Presentation();

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
			//echo $name;
			//echo $password;
		}
	}
	else{
		$P->buildAddForm(array('cid','password'),"Login");
	}
	?>
</body>
</html>
