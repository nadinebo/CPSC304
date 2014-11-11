<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
</head>

<body>
	<?php
		error_reporting(E_STRICT);
		include 'data.php';
		include 'logic.php';
		include 'presentation.php';
		$D = new Data();
		echo"check 1  2";
		$L = new Logic();
		$L->initLogic();
		echo "initComplete";
		initPresentation();
		
		//Reference code for everyone else while making the getting and setting classes
		$D->insertLeadSinger('384932647092','St.Vincent');
		echo "insert comp";
		//testing using the layers as classes
		$result = $D->queryAllLeadSingers();
		//a bit of test display for the sake of it
		while($row = $result->fetch_assoc()){
			echo"<td>".$row['upc']."</td>";
			echo"<td>".$row['name']."</td>";
		}
		$D->deleteLeadSinger('384932647092','St.Vincent');
		//end reference
	?>
</body>
</html>
