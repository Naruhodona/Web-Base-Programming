<?php
	include "../connection.php";

	$cart_id = $_GET['cart_id'];
	$products_name = $_GET['products_name'];
	$sql = "select products_id from products where products_name='$products_name'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$products_id = $row['products_id'];
	$query = "delete from cart where cart_id='$cart_id' and products_id='$products_id'";
	mysqli_query($conn, $query);


	header("location: cart.php");
	exit();

?>