<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
</head>

<body>
	<?php
		include 'data.php';
		include 'logic.php';
		include 'presentation.php';
		error_reporting(E_STRICT);
		initData();
		initLogic();
		initPresentation();
		echo "initComplete";
		
		//Reference code for everyone else while making the getting and setting classes
		insertLeadSinger('384932647092','St.Vincent');
		$result = selectLeadSinger();
		//a bit of test display for the sake of it
		while($row = $result->fetch_assoc()){
			echo"<td>".$row['upc']."</td>";
			echo"<td>".$row['name']."</td>";
		}
		deleteLeadSinger('384932647092','St.Vincent');
		echo "insert comp";
		//end reference
	?>
</body>
</html>
