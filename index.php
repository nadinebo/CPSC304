
<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title>Cals</title>
<!--
    A simple stylesheet is provided so you can modify colours, fonts, etc.
-->
    <link href="src/cals.css" rel="stylesheet" type="text/css">

<script>
function formSubmit(titleId) {
    'use strict';
    if (confirm('Are you sure you want to delete this title?')) {
      // Set the value of a hidden HTML element in this form
      var form = document.getElementById('delete');
      form.title_id.value = titleId;
      // Post this form
      form.submit();
    }
}
</script>

</head>

<body>

<?php
	include 'src/presentation.php';
	$P = new Presentation();
	$P->demo();
	echo " *** DONE! *** ";
?>
</body>
</html>
