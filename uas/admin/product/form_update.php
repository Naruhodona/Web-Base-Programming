<html>
<head>
	<link type="text/css" rel="stylesheet" href="../../css/index.css">
	<link type="text/css" rel="stylesheet" href="../../css/admin.css">
	<title> Update Data </title>
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
<h2> Form Update Data </h2>

<?php 
  $id_input =$_GET["id"];
  
	include "../../connection.php";
	
	$query = "select products_name, price, image FROM products WHERE products_id = '$id_input';";
	$result = mysqli_query($conn, $query);
	if ($result){
		$row = mysqli_fetch_row($result);
	}
?>

	<form action="update.php" method = "post">
		<strong> ID: </strong><br/> 
			<input name="id" type "hidden" value="<?php echo $id_input;?>"> <br/><br/>
		<strong> Nama Produk: </strong><br/>
			<input name="produk" type "text" size="30" maxlenght="25" value="<?php echo $row[0];?>"> <br/><br/>
		<strong> Harga: </strong><br/>
			<input name="harga" type "text" size="30" maxlenght="25" value="<?php echo $row[1];?>"> <br/><br/>
		<strong> Image Link: </strong><br/>
			<input name="image" type "text" size="30" maxlenght="25" value="<?php echo $row[2];?>"> <br/><br/>

		<input type="submit" name="btnSubmit" value ="Save">
	</form>
</body>
</html>   