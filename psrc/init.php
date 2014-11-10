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
		insertLeadSinger('384932647092','St.Vincent');
		echo "insert comp";
	?>
</body>
</html>
