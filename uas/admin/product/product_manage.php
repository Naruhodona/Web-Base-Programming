<?php
session_start();
	if (!isset($_SESSION["username"])) {
    header("Location: ../adminlogin.php");
    exit();
}
?>

<html>
<head>
	<title>Manage Inventory</title>
    <link type="text/css" rel="stylesheet" href="">
	<style>
		.img-tiny{
			width:50px;
			height:50px;
		}
	</style>
	
</head>
<h2>Inventory</h2>
<?php


include "../../connection.php";

$query = "select * from products";
$result = mysqli_query($conn, $query);

if ($result){
?>

	<form action="delete.php" method="post">
	<div style="height: 500px; width: 500px; overflow-y: auto;">
    <table border="1">
	<tr>

        <th width="30">ID</th>
		<th width="100">image</th>
		<th width="100">nama produk</th>
		<th width="100">harga</th>
		 <th width="100">stok</th><!--Kasih panah atas bawah untuk nambah atau kurangin stok dengan mudah dan tambah tombol untuk save-->
		<th width="100">kategori</th>
		<th colspan="2" class="center" width="100">Action</th>		
	</tr>
    <?php
    while ($row = mysqli_fetch_row($result)) {
	?>
	<tr>
		<?php

        $id_produk = $row[0];
		$produk = $row[1];
		$harga = $row[2];
		$stok = $row[3];
		$image_link = $row[4];
		$kategori = $row[5];

	    ?>
        <td><?php echo $id_produk;?></td>
		<td><img src="../<?php echo $image_link;?>" class="img-tiny"></td>
		<td><?php echo ucfirst($produk);?></td>
		<td><?php echo $harga;?></td>
		<td><?php echo $stok;?></td>
		<td><?php echo $kategori;?></td>
		<td>
            <a href ="product_edit.php?id=<?php echo $id_produk;?>">Edit</a>
		    <a href ="delete.php?id=<?php echo $id_produk;?>">Delete</a>
			</td>
		</tr>
    <?php 
	
	} 
	 ?>
    </table></div>
	</br>
	<a href ="form_insert.html">Add New Product</a>
	</form>
	<a href="../admin.php">Back</a>
	 <?php
    mysqli_free_result($result);
 }
mysqli_close($conn);
?>
</body>
</html>   