<?php
$id_input =$_GET["id"];

include "../connection.php";

if (mysqli_connect_errno()) {
   echo "Koneksi ke server gagal dilakukan.";
   exit();
}
$query = "delete from `cart` WHERE products_id='$id_input'";
mysqli_query($conn, $query);
$query = "delete from `products` WHERE products_id='$id_input'";
mysqli_query($conn, $query);

$num = mysqli_affected_rows($conn);
if ($num > 0) {
   header("location: product_manage.php?pesan=hapus", true, 301);
   exit();
} else {
   echo "Penghapusan data gagal dilakukan.";
}

?>   
