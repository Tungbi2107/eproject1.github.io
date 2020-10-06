<?php require_once("../../../resources/config.php"); ?>
<?php

session_start();

	if(isset($_SESSION['giohang'])) {
	$cartCount = count($_SESSION['giohang']);
	}
	$product_id = $_GET['product_id'];

	if(isset($_SESSION['giohang'][$product_id])) {
		$_SESSION['giohang'][$product_id] = $_SESSION['giohang'][$product_id] + 1;
	}
	else {
		$_SESSION['giohang'][$product_id] = 1;
	}

	redirect("../../../public/cart.php");
?>