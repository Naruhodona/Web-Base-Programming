<html>
<head>
	<title> Update Data </title>
</head>
<body>
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