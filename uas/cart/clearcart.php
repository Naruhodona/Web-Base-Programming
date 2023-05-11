<?php
	include "../connection.php";

	$cart_id = $_GET['cart_id'];
	$query = "delete from cart where cart_id='$cart_id'";
	$result = mysqli_query($conn, $query);


	header("location: cart.php");
	exit();

?>