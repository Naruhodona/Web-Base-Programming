<?php
if (isset($_POST["btnSubmit"])) {
	$id_input = $_POST["id"];
	$produk = $_POST["produk"];
	$harga = $_POST["harga"];
   $image = $_POST["image"];
   $stok = $_POST["stok"];
   $category = $_POST["kategori"];

include "../../connection.php";


$query = "UPDATE `products` SET products_name='$produk', stock='$stok', price='$harga', `image`='$image',`category` = '$category' WHERE products_id='$id_input'";
mysqli_query($conn, $query);
$num = mysqli_affected_rows($conn);
}
?>
<meta content="0; url=product_manage.php" http-equiv="refresh">
