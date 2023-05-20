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
	<title></title>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../js/reportsalesproductpermonth.js"></script>
<body>


<h1>Report Sales Product per Month</h1>
<form method="POST" action="">
	<span>Products :</span>
	<select id="products-option" name="products-option">

	</select>
	<span>Month from :</span>
	<input type="month" name="start_date" id="start_date">
	<span>Until :</span>
	<input type="month" name="end_date" id="end_date">

	<input type="submit" name="submit_date_product" value="Go">
</form>
<table>
	<tr>
		<th>Product's Name</th>
		<th>Sold</th>
		<th>Month</th>
		<th>Year</th>
	</tr>

<?php
if(isset($_POST['submit_date_product'])){
	$products_id = $_POST['products-option'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$start_date_parse = date_parse_from_format('Y-m', $start_date);
	$end_date_parse = date_parse_from_format('Y-m', $end_date);
	$start_month = (int)$start_date_parse['month'];
	$end_month = (int)$end_date_parse['month'];
	$start_year = (int)$start_date_parse['year'];
	$end_year = (int)$end_date_parse['year'];
	$query = "select products.products_name, month(paid_date) as month, year(paid_date) as year, sum(cart_paid.quantity) as sold from cart_paid inner join products on cart_paid.products_id = products.products_id where cart_paid.products_id='$products_id' and month(cart_paid.paid_date) between $start_month and $end_month and year(cart_paid.paid_date) between $start_year and $end_year group by month ";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_assoc($result)){
?>
	<tr>
		<td><?php echo $row['products_name']; ?></td>
		<td><?php echo $row['sold']; ?></td>
		<td><?php echo $row['month']; ?></td>
		<td><?php echo $row['year']; ?></td>
	</tr>
<?php

	}
}
?>
</table>

</body>
</html>