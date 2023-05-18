<?php
$id_input =$_GET["id"];

include "../../connection.php";

if (mysqli_connect_errno()) {
   echo "Koneksi ke server gagal dilakukan.";
   exit();
}
$query = "delete from `cart` WHERE products_id='$id_input'";
mysqli_query($conn, $query);
$query = "delete from `products` WHERE products_id='$id_input'";
mysqli_query($conn, $query);

?>   
