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
		if(isset($_POST["submit"]) && $_POST["submit"] == "Register"){
		$cid= $_POST["new_cid"];
		$password= $_POST["new_password"];
		$name= $_POST["new_name"];
		$address= $_POST["new_address"];
		$phone= $_POST["new_phone"];
		//$P->
		echo "<h2>Congradulations On registering</h2>";
		}
	}
	else{
		echo "<h2>Please enter your personal information</h2>";
		$P->buildAddForm(array('cid','password','name','address','phone'),"Register");
	}
?>
</body>
</html>
