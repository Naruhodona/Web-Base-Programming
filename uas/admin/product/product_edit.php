<html>
<head>
	<title> Update Data </title>
</head>
<body>
<h2> Form Update Data </h2>

<?php 
  $id_input =$_GET["id"];
  
	include "../../connection.php";
	
	$query = "select products_name, price, image,category FROM products WHERE products_id = '$id_input';";
	$result = mysqli_query($conn, $query);
	if ($result){
		$row = mysqli_fetch_row($result);
	}

	$query = "SELECT DISTINCT category FROM `products`";
	$result = $conn->query($query);

	// Check if any rows are returned
	if ($result->num_rows > 0) {
		// Initialize an array to store the options
		$categories = array();

		// Fetch rows and store them in the options array
		while ($i = $result->fetch_assoc()) {
			array_push($categories,$i['category']);
		}
	}
?>

	<form action="update.php" method = "post">
		<strong> ID: </strong><?php echo $id_input;?><br/>
		<input name="id" type="hidden" size="30" maxlenght="25" value="<?php echo $id_input;?>"> <br/><br/>
		<strong> Nama Produk: </strong><br/>
			<input name="produk" type="text" size="30" maxlenght="25" value="<?php echo $row[0];?>"> <br/><br/>
		<strong> Harga: </strong><br/>
			<input name="harga" type="text" size="30" maxlenght="25" value="<?php echo $row[1];?>"> <br/><br/>
		<strong> Link Gambar: </strong><br/>
			<input name="image" type="text" size="30" maxlenght="25" value="<?php echo $row[2];?>"> <br/><br/>
		<strong> Kategori: </strong><br/>
		<select name="kategori">
    		<?php
				foreach ($categories as $category) {
					echo '<option value="' . $category . '">' . $category . '</option>';
				}
			?> <br/><br/>
		<input type="submit" name="btnSubmit" value ="Save">
	</form>
</body>
</html>   