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
						<li class="active"><a href="customerHome.php">Customer<span class="sr-only">(current)</span></a></li>
						<li><a href="clerkHome.php">Clerk</a></li>
						<li><a href="managerHome.php">Manager</a></li>
						<li><a href="developerHome.php">Dev</a></li>
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
		<h4><em>This page will include tabs for the different actions a Customer can do.</em></h3>
		<h1>Welcome outlander, to our glorious hovel.</h1>
		<h2>Take this rare shopping basket for hording.</h2>

		<div role="tabpanel">
			<!--Nav tabs-->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation"><a href="#cart" aria-controls="cart" role="tab" data-toggle="tab">
					<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
				</a></li>
				<li role="presentation" class="active"><a href="#shop" aria-controls="shop" role="tab" data-toggle="tab">Browse Store</a></li>
				<li role="presentation"><a href="#allItems" aria-controls="allItems" role="tab" data-toggle="tab">All Items</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
<?php
include '../src/presentation.php';
$P = new Presentation();
?>

<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--						SHOPPING CART TAB							     -->	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
				<div role="tabpanel" class="tab-pane" id="cart">
					<h3> The Shopping Cart </h3>
<?php
session_start();
if(!isset($_SESSION['shoppingBasket'])){
	//$_SESSION['shoppingBasket'] = null;
	//echo "new basket";
}
$basket = $_SESSION['shoppingBasket'];

		/* If checkout was pressed */
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["submitDelete"]) && $_POST["submitDelete"] == "DELETE"){
		echo "<h1>ITEM DELETED</h1>";
		$deleteUPC = $_POST['upc'];
		echo $deleteUPC;
		for($i=0;$i<count($basket);$i++){
			$item = $basket[$i];
			if($item['upc'] == $deleteUPC){
				$basket[$i]=null;
				break;
			}
		}
	}
	$_SESSION['shoppingBasket'] = $basket;;
}

		/* If checkout was pressed */
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["submitCheckout"]) && $_POST["submitCheckout"]=="CHECKOUT"){
		/* First Create The Order for the purchase */
		$expirydate = $_POST["expirydate"];
		$cardnumber = $_POST["cardnumber"];
		$user = $_SESSION['user'];
		$today = date("Y-m-d");
		$P->submitOrder($today,$user['cid'],$cardnumber,$expirydate);
		//Retrieve the latest order
		$order = $P->newestOrder();
		echo" recipt ID = ".$order['receiptID'];
		for($i=0;$i<sizeof($basket);$i++){
			$row = $basket[$i];
			if($row == null){
				continue;
			}
			purchase($order['receiptID'],$row['upc'],$row['quantity']);
			//create purchase Item
			$basket[$i]=null;
		}
	}
	$_SESSION['shoppingBasket'] = $basket;;
}

echoBasket($basket);
checkoutForm($basket);


function purchase($reciptID, $upc, $quantity){
	echo "ID : ".$reciptID."upc :".$upc."quantity".$quantity."<br>";
	global $P;
	$P->submitPurchaseItem($reciptID,$upc,$quantity);
}

function checkoutForm($basket){
	echo "<form id=\"checkout\" name=\"delete\" action=\"";
	echo htmlspecialchars($_SERVER["PHP_SELF"]);
	echo "\" method=\"POST\">";
	$schema = array('upc','title','type','category','company','year','quantity','price');
	for($i=0;$i<sizeof($basket);$i++){
			$row = $basket[$i];
			for($j=0;$j<count($schema);$j++){
				echo "<input type=\"hidden\" name=\"sbfv".$i.$schema[$j]."\" value=\"-1\"/>";
			}
	}
	echo "<input type=\"hidden\" name=\"submitCheckout\" value=\"CHECKOUT\"/>";
	echo "<input type=\"hidden\" name=\"cardnumber\" value=\"-1\"/>";
	echo "<input type=\"hidden\" name=\"expirydate\" value=\"-1\"/>";
	echo "<input type=\"hidden\" name=\"upc\" value=\"-1\"/>";
	echo "</form>";
}

function echoBasket($basket){
	echo "<form id=\"removeItem\" name=\"delete\" action=\"";
	echo htmlspecialchars($_SERVER["PHP_SELF"]);
	echo "\" method=\"POST\">";
	// Hidden value is used if the delete link is clicked
	echo "<input type=\"hidden\" name=\"upc\" value=\"-1\"/>";
	// We need a submit value to detect if delete was pressed 
	echo "<input type=\"hidden\" name=\"submitDelete\" value=\"DELETE\"/>";
	echo "<h2>Shopping Basket</h2>";
	echo "<table class='table' border=0 cellpadding =0 cellspacing=0>";
	echo "<tr valine=center>";
	$schema = array('upc','title','type','category','company','year','quantity','price');
	for($i=0;$i<count($schema);$i++){
		echo "<td class=rowheader>".$schema[$i]."</td>";
	}
	echo "</tr>";

	for($i=0;$i<sizeof($basket);$i++){
		echo $i;
		$row = $basket[$i];
		if($row == null){
			echo"NULL";
			continue;
		}else{
			for($j=0;$j<count($schema);$j++){
				echo"<td>".$row[$schema[$j]]."</td>";
			}
		}
		echo "<td>";
		echo "<a href=\"javascript:formSubmit('".$row['upc']."');\">remove</a>";
		echo"</td></tr>";
	}
	echo"</table>";
	echo"<br><br>";
	echo "</form>";

	echo"<input type=\"button\" value=\"checkout\" onclick=\"javascript:checkout()\"/>";
}

	?>				










<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--						SHOPPING CART TAB							     -->	
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->


				</div>
				<div role="tabpanel" class="tab-pane active" id="shop">
					<h3> Browsing Store Items </h3>
<?php
//ITEM SELECTION TAB


echo "<form id=\"addItem\" name=\"add\" action=\"";
echo htmlspecialchars($_SERVER["PHP_SELF"]);
echo "\" method=\"POST\">";
// Hidden value is used if the delete link is clicked
echo "<input type=\"hidden\" name=\"upc\" value=\"-1\"/>";
echo "<input type=\"hidden\" name=\"quantity\" value=\"-1\"/>";
// We need a submit value to detect if delete was pressed 
echo "<input type=\"hidden\" name=\"submitAdd\" value=\"ADD\"/>";
echo "<h2>Select Item</h2>";
echo "<table class='table' border=0 cellpadding =0 cellspacing=0>";
echo "<tr valine=center>";

$schema = array('upc','title','type','category','company','year','price','stock','quantity');

//SHOULD BE THE RESULT OF A SEARCH QUERY
$result = $P->getItems();
//NOT UST GETTING ITEMS

for($i=0;$i<count($schema);$i++){
	echo "<td class=rowheader>".$schema[$i]."</td>";
}
echo "</tr>";
while($row = $result->fetch_assoc()){
	for($j=0;$j<count($schema)-1;$j++){
		echo"<td id=\"".$row[$schema[0]].$schema[$j]."\">".$row[$schema[$j]]."</td>";
	}
	echo "<td>";
	echo "<input value=\"1\" size=\"2\"id=\"quantity".$row['upc']."\"></input>";
	echo "<td>";
	echo "<a href=\"javascript:addFormSubmit('".$row['upc']."');\">add</a>";
	echo"</td></tr>";
}
echo"</table>";
echo"<br><br>";

echo "</form>";


/* Add an Item to The shopping basket */
if($_SERVER["REQUEST_METHOD"] == "POST") {
	//echo "<h1>POST</h1>";
	if(isset($_POST["submitAdd"]) && $_POST["submitAdd"] == "ADD"){
		$addUPC = $_POST['upc'];
		$quantity = $_POST['quantity'];
		echo $quantity."<br>";
		//echo $addUPC;
		//echo "<h1>ITEM ADDED</h1>";
		session_start();

		$addBasket = $_SESSION['shoppingBasket'];

		//get the Item based on the UPC
		$result = $P->getItems();
		while($row = $result->fetch_assoc()){
			if($row['upc']==$addUPC){
				$addItem = $row;
				break;
			}
		}
		echo $addItem['upc'];
		/* Check if the Item is already in the basket and update it*/
		for($i=0;$i<count($addBasket);$i++){
			$row = $addBasket[$i];
			if($row['upc'] == $addItem['upc']){
				$row['quantity'] += $quantity;
				$row['price'] += $quantity *$addItem['price'];
				$addBasket[$i] = $row;
				break;
			}
		}
		$schema = array('upc','title','type','category','company','year','quantity','price');
		echo $i."<br>";
		/* This is a new item for the basket so it has to be added */
		if($i == count($addBasket)){
			$basketElement['upc']=$addItem['upc'];
			$basketElement['title']=$addItem['title'];
			$basketElement['type']=$addItem['type'];
			$basketElement['category']=$addItem['category'];
			$basketElement['year']=$addItem['year'];
			$basketElement['quantity']= $quantity;
			echo "inserting price";
			$basketElement['price']= $quantity * $addItem['price'];
			$s = count($addBasket);
			$addBasket[$s] = $basketElement;
		}

		$_SESSION['shoppingBasket'] = $addBasket;
		$_POST["submitAdd"] = null;
	}
}
//Uncomment for ultra basket mode
//echoBasket($addBasket);
?>
				</div>
				<div role="tabpanel" class="tab-pane" id="allItems">
					<h3> All Items </h3>
					<?php

					?>
				</div>
			</div>
		</div>

	</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<script>
function formSubmit(upc) {
	'use strict';
	//document.write(upc);
	if (confirm('Are you sure you want to delete this title?')) {
		// Set the value of a hidden HTML element in this form
		var form = document.getElementById('removeItem');
		form.upc.value = upc;
		// Post this form
		form.submit();
	}
}
</script>

<script>
function addFormSubmit(upc) {
	'use strict';
	var quant = document.getElementById('quantity'+upc).value;
	var title = document.getElementById(upc+'title').textContent;
	var stock = document.getElementById(upc+'stock').textContent;
	if(stock < quant){
		if (confirm('You want '+quant+' but we only got '+stock+' so is '+stock+' ok?')) {
			// Set the value of a hidden HTML element in this form
			var form = document.getElementById('addItem');
			form.upc.value = upc;
			form.quantity.value = stock;
			// Post this form
			form.submit();
		}
		else{
			document.write("YOU SHOULD HAVE ACCEPTED");
		}
	}
	else{
		// Set the value of a hidden HTML element in this form
		var form = document.getElementById('addItem');
		form.upc.value = upc;
		form.quantity.value = quant;
		// Post this form
		form.submit();
	}
}
</script>
<script>
function checkout() {
	var form = document.getElementById('checkout');
	form.cardnumber.value = '55533';
	form.expirydate.value = '2017';
	//form.cardnumber.value = prompt("Credit CardNumber", "#");
	//form.expirydate.value = prompt("Expire Date", "YYYY-MM-DD");
	form.submit();
	
}
</script>
	</body>
	</html>
