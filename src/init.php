<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
</head>

<body>
	<?php
		error_reporting(E_STRICT);
		include 'presentation.php';
		$P = new Presentation();
		echo "pinit";
		$P->demo();
		echo "initComplete";
		
		//Reference code for everyone else while making the getting and setting classes
		//end reference
	?>
</body>
</html>
