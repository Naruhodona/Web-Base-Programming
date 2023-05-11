<?php
session_start();
$id_input = $_GET["id"];

include "../../connection.php";

$query = "delete from `account` WHERE user_id='$id_input'";
mysqli_query($conn, $query);
$query = "delete from `cart` WHERE cart_id='{$id_input}c'";
mysqli_query($conn, $query);
$query = "delete from `user_cart` WHERE user_id='$id_input'";
mysqli_query($conn, $query);

$num = mysqli_affected_rows($conn);
if ($num > 0) {
   header("location: member_manage.php", true, 301);
   exit();
} else {
   echo "Penghapusan member gagal dilakukan.";
}

?>   
