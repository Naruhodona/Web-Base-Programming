<?php
session_start();
	if (!isset($_SESSION["username"])) {
    header("Location: ../adminlogin.php");
    exit();
}
?>
<html>
<head>
	<title> Form Entry Produk </title>
	<link type="text/css" rel="stylesheet" href="../../css/index.css">
	<link type="text/css" rel="stylesheet" href="../../css/admin.css">
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
	<h2>Form Entry Data</h2>
	<div class="centered">
		<form action="insert.php" method ="post">
			<strong> Nama Produk: </strong>
				<input required type="text" name="product"> <br/><br/>
			<strong> Harga: </strong>
				<input required type="number" name="price"> <br/><br/>
			<strong> Stok: </strong>
				<input required type="number" name="stock" size="30" maxlenght="25"> <br/><br/>
			<strong> Link Gambar: </strong>
				<input required type="text" name="image" size="30" maxlenght="25"> <br/><br/>
			<strong> Kategori: </strong>
				<input required type="text" name="category" size="30" maxlenght="25"> <br/><br/>
			<div class="centered-button">
				<input type="submit" name="btnSubmit" value ="Save">
			</div>
		</form>
		
	</div>
	
	<a href="product_manage.php">Back</a>
</body>
</html>   