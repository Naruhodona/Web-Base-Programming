<?php
session_start();
include "../connection.php";
if(isset($_POST['final_order'])){
	$user_id = $_SESSION['user_id'];
	$cart_id = $_SESSION['user_id'].'c';
	$total = $_POST['total'];
	$address = $_POST['address'];
	$phone = $_POST['phone_number'];
	$payment = $_POST['payment'];
	$notes = $_POST['notes'];
	$transaction_date = date('Y-m-d');
	$query = "SELECT * FROM transaction WHERE transaction_id like '%{$cart_id}'";
	$result = mysqli_query($conn, $query);
	$rows = mysqli_num_rows($result);
	$trans_id = $rows+1;
	$sql = "INSERT INTO transaction(transaction_id, user_id, cart_paid_id, total_price, transaction_date, status, address, phone_number, notes) values('t{$trans_id}{$cart_id}', '$user_id', 'cp{$trans_id}{$cart_id}', '$total', '$transaction_date','ordered', '$address','$phone','$notes')";
	$result = mysqli_query($conn, $sql);

	$sql = "SELECT * FROM cart where cart_id='$cart_id'";
	$result = mysqli_query($conn, $sql);

	while ($data = mysqli_fetch_row($result)){
		$id = $data[1];
		$qty = $data[2];
		$sql1 = "INSERT INTO cart_paid(cart_paid_id, products_id, quantity, paid_date, payment) values('cp{$trans_id}{$cart_id}','$id',$qty, '$transaction_date', '$payment')";
		$result1 = mysqli_query($conn, $sql1);
		$query1 = "SELECT stock from products where products_id='$id'";
		$result_query1 = mysqli_query($conn, $query1);
		$new = mysqli_fetch_assoc($result_query1);
		$old_stock = $new['stock'];
		$new_stock = $old_stock - $qty;

		$sql2 = "UPDATE products set stock=$new_stock where products_id='$id'";
		$result2 = mysqli_query($conn, $sql2);
	}
	
	$sql = "DELETE FROM cart where cart_id='$cart_id'";
	$result = mysqli_query($conn, $sql);
}
header("Location: cart.php?pesan=trims");

?>