<?php
session_start();
include "../connection.php";

if (isset($_POST['quantity']) && isset($_POST['products_name'])){
  $quantity = $_POST['quantity'];
  $products_name = $_POST['products_name'];
  $sql = "SELECT products_id FROM products WHERE products_name='$products_name'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $products_id = $row['products_id'];
  $sql = "UPDATE cart SET quantity=$quantity WHERE cart_id='{$_SESSION['user_id']}c' AND products_id='$products_id'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    echo "Error: " . mysqli_error($conn);
  } else {
    echo "Success";
  }
}
?>