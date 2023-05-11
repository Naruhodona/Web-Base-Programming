<?php
session_start();
include "connection.php";

if (isset($_POST['category'])){
  $category = $_POST['category'];
  $dataCategory = array();
  if ($category != "all"){
    $sql = "SELECT * FROM products where category='$category'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      array_push($dataCategory, $row);
    }
  } else {
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      array_push($dataCategory, $row);
    }
  }
  header('Content-Type: application/json');
  echo json_encode($dataCategory);
}
?>