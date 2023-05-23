<?php
session_start();
include "../../connection.php";

if (!isset($_SESSION["username"])) {
	header("Location: ../adminlogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link type="text/css" rel="stylesheet" href="../../css/index.css">
    <link type="text/css" rel="stylesheet" href="../../css/admin.css">
	<title>Report Sales Product per Period</title>
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
                    <a href="reportpages.php" class="active">
                        <div>Reports</div>
                    </a>
                    <a href="../product/product_manage.php">
                        <div>Manage Products</div>
                    </a>
                </div>
                <div class="button-container">
                    <a href="../adminlogout.php">
                        <div>Logout</div>
                    </a>
                </div>
            </div>
<div style="text-align: center; margin-bottom: 20px;">
<h1>Report Sales Product per Period</h1>
<form method="POST" action="">
	<span>Date from :</span>
	<input required type="date" name="start_date" id="start_date">
	<span>Until :</span>
	<input required type="date" name="end_date" id="end_date">
	<input type="submit" name="submit_date" value="Go">
</form>
</div>
<?php
if(isset($_POST['submit_date'])){
?>
<table>
	<tr>
		<th>Product's Name</th>
		<th>Sold</th>
	</tr>

<?php
if(isset($_POST['submit_date'])){
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$query = "select products.products_name, sum(cart_paid.quantity) as sold from cart_paid inner join products on cart_paid.products_id = products.products_id where cart_paid.paid_date between '$start_date' and '$end_date' group by products.products_name ";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_assoc($result)){
?>
	<tr>
		<td><?php echo $row['products_name']; ?></td>
		<td><?php echo $row['sold']; ?></td>
	</tr>
<?php

	}
}
}
?>
</table>
</body>
</html>
