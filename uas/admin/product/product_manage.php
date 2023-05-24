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
    <link type="text/css" rel="stylesheet" href="../../css/index.css">
	<link type="text/css" rel="stylesheet" href="../../css/admin.css">
	<style>
		.img-tiny{
			width:50px;
			height:50px;
		}
	</style>
	<script>
		function confirmDelete(event) {
      	// Display a confirmation dialog
      	var confirmation = confirm("Are you sure you want to DELETE this product?");

		// If the user clicks "Cancel" or selects "Decline"
		if (!confirmation) {
			// Prevent the default link behavior
			event.preventDefault();
		}
    }
	</script>
	
</head>
<body>
<div class="header">
				<div class="logo">
					<a href="../admin.php">Admin FKS Farma</a>
				</div>
				<div class="nav">    
					<a href="../orgmember/member_manage.php">
						<div>Organize User Accounts</div> 
					</a>
					<a href="../report/reportpages.php">
						<div>Reports</div>
					</a>
					<a href="../product/product_manage.php" class="active">
						<div>Manage Products</div>
					</a>
				</div>
				<div class="button-container">
					<a href="../adminlogout.php">
						<div>Logout</div>
					</a>
				</div>
			</div>
		<h2>Inventory</h2>
		<?php


		include "../../connection.php";

		$query = "select * from products";
		$result = mysqli_query($conn, $query);

		if ($result){
		?>

		<form action="delete.php" method="post">
		<div style="height: 500px; width: 500px; overflow-y: auto; margin-left: auto; margin-right:auto">
		<table border="1">
		<tr>

			<th width="30">ID</th>
			<th width="100">image</th>
			<th width="100">nama produk</th>
			<th width="100">harga</th>
			<th width="100">stok</th>
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
				<a href ="delete.php?id=<?php echo $id_produk;?>" onclick="confirmDelete(event)">Delete</a>
				</td>
			</tr>
		<?php 
		
		} 
		?>
		</table></div>
		</br>
		<a href ="product_insert.php">Add New Product</a>
		</form>
		<a href="../admin.php">Back</a>
		<?php
		mysqli_free_result($result);
	}
	mysqli_close($conn);
	?>
</body>
</html>   