<?php
if (isset($_POST["btnSubmit"])) {
	$product = $_POST["product"];
	$price = $_POST["price"];
	$stock = $_POST["stock"];
	$image = $_POST["image"];
	$category = $_POST["category"];

include "../../connection.php";

$sql = "select * from products";
$result = mysqli_query($conn,$sql);
$row = mysqli_num_rows($result);


$max = 0;
while ($data = mysqli_fetch_assoc($result)){
   $id_num = $data['products_id'];
   $id_num = mb_substr($id_num,1);
   if ($id_num > $max){
         $max = $id_num;
   } 
}

$new_id = $max + 1;
$id = "p".$new_id;


$query = "INSERT INTO `products` (`products_id`,`products_name`,`price`,`stock`,`image`,`category`)
          VALUES ('$id', '$product', '$price', '$stock', '$image', '$category');";

mysqli_query($conn, $query);

header("location: product_manage.php", true, 301);
exit();
}
?>   