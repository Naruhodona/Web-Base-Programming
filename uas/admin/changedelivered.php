<?php
include "../connection.php";
if(isset($_GET['transaction_id'])){
	$transaction_id = $_GET['transaction_id'];
	$query = "update transaction set status='delivered' where transaction_id='$transaction_id'";
	$result = mysqli_query($conn, $query);
	header("Location: admin.php");
}


?>