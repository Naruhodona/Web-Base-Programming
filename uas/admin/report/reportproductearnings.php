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
    <title>Product Earnings Report</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <div class="content">
        <div>
            <h1>Product Earnings</h1>
            <form method="POST" action="">
                <span>Date from :</span>
                <input required type="date" name="start_date" id="start_date">
                <span>Until :</span>
                <input required type="date" name="end_date" id="end_date">
                <input type="submit" name="submit_date" value="Go">
            </form>
            <?php
            if(isset($_POST['submit_date'])){
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $sql = "SELECT cart_paid.products_id, products.products_name, SUM(cart_paid.quantity * products.price) as total from cart_paid inner join products on products.products_id = cart_paid.products_id where cart_paid.paid_date between '$start_date' and '$end_date' group by cart_paid.products_id order by total desc";
                $result = mysqli_query($conn, $sql); 
                ?>
            <table border="1">
                <tr>
                    <th>Product ID</th>
                    <th>Product</th>
                    <th>Total Earnings</th>
                </tr>
                <?php
                $sum = 0;
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    
                    while ($row = mysqli_fetch_assoc($result)) {                       
                        
                ?>
                <tr>
                    <td><?php echo $row['products_id']; ?></td>
                    <td><?php echo $row['products_name']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                </tr>
                <?php
                    $sum += $row['total'];
                    }
                }
                }else {
                    echo "<tr><td colspan='3'>Tidak ada data.</td></tr>";
                }
                if (isset($_POST['submit_date'])){
                ?>
                
                <tr>
                    <td colspan="2">Total</td>
                    <td><b><?php echo $sum; ?></b></td>
                </tr>
                <?php }?>
            </table>
        </div>
        <a href="../admin.php">Back</a>
    </div>
</body>
</html>