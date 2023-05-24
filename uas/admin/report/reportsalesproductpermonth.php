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
	<title>Report Sales Product per Month</title>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
    var products = 'all';
    $.ajax({
      type: "POST",
      url: "requestproducts.php",
      data: {
        products: products
      },
      dataType: 'json', 
      success: function(data) {
        var productsHtml = '<option value="" selected disabled hidden>-- Select Products --</option>';
        // $.each(data, function(index, product)
        for(let i = 0; i < data.length; i++) {
          productsHtml += '<option value="'+data[i].products_id+'">'+data[i].products_name.toUpperCase()+'</option>';
        };
        $('#products-option').html(productsHtml);
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
});
</script>
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
<h1>Report Sales Product per Month</h1>
<form method="POST" action="">
	<span>Products :</span>
	<select required id="products-option" name="products-option">

	</select>
	<span>Month from :</span>
	<input required type="month" name="start_date" id="start_date">
	<span>Until :</span>
	<input required type="month" name="end_date" id="end_date">

	<input type="submit" name="submit_date_product" value="Go">
</form>
</div>
<?php
if(isset($_POST['submit_date_product'])){


?>
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
	$query = "select products.products_name, month(paid_date) as month, year(paid_date) as year, sum(cart_paid.quantity) as sold from cart_paid inner join products on cart_paid.products_id = products.products_id where cart_paid.products_id='$products_id' and month(cart_paid.paid_date) between $start_month and $end_month and year(cart_paid.paid_date) between $start_year and $end_year group by month";
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
}
?>
</table>

</body>
</html>