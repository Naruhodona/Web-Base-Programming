<?php
include "../connection.php";
if(isset($_POST['cart_submit'])){
	$user_id = $_POST['user_id'];
	$cart_id = $_POST['cart_id'];
	$total = $_POST['total'];
	$transaction_date = date('Y-m-d');
	$query = "SELECT * FROM transaction WHERE transaction_id like '%{$cart_id}'";
	$result = mysqli_query($conn, $query);
	$rows = mysqli_num_rows($result);
	$trans_id = $rows+1;
	$sql = "INSERT INTO transaction(transaction_id, user_id, cart_paid_id, total_price, transaction_date, status) values('t{$trans_id}{$cart_id}', '$user_id', 'cp{$trans_id}{$cart_id}', '$total', '$transaction_date','ordered')";
	$result = mysqli_query($conn, $sql);

	$sql = "SELECT * FROM cart where cart_id='$cart_id'";
	$result = mysqli_query($conn, $sql);

	while ($data = mysqli_fetch_row($result)){
		$id = $data[1];
		$qty = $data[2];
		$sql1 = "INSERT INTO cart_paid(cart_paid_id, products_id, quantity, paid_date) values('cp{$trans_id}{$cart_id}','$id',$qty, '$transaction_date')";
		$result1 = mysqli_query($conn, $sql1);
	}
	
	$sql = "DELETE FROM cart where cart_id='$cart_id'";
	$result = mysqli_query($conn, $sql);
}
header("Location: cart.php?pesan=trims");

?>