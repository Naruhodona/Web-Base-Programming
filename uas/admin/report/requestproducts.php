<?php
include "../../connection.php";
if(isset($_POST['products'])){
	$allproducts = array();
	$query = "SELECT * from products";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_assoc($result)){
       array_push($allproducts, $row);
    }

	header('Content-Type: application/json');
 	echo json_encode($allproducts);
}
?>