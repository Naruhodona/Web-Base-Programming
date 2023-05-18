<?php
if (isset($_POST["btnSubmit"])) {
	$id_input = $_POST["id"];
	$produk = $_POST["produk"];
	$harga = $_POST["harga"];
   $image = $_POST["image"];
   $category = $_POST["kategori"];

include "../../connection.php";


$query = "UPDATE `products` SET products_name='$produk', price='$harga', `image`='$image',`category` = '$category' WHERE products_id='$id_input'";
mysqli_query($conn, $query);
$num = mysqli_affected_rows($conn);

if ($num > 0) {
   echo "Data yang kamu simpan sudah disimpan."; 
?>
<meta content="0; url=product_manage.php" http-equiv="refresh">
<?php

} else {
   echo "Data gagal disimpan ke dalam database.";
}
}
?>  