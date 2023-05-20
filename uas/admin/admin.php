<?php
	session_start();
	include "../connection.php";
	if (!isset($_SESSION["username"])) {
	    header("Location: adminlogin.php");
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
<body>
	<a href="orgmember/member_manage.php">Organize User Accounts</a>
	<a href="history/report_transaction.php">Report Transaction</a>
	<a href="product/product_manage.php">Manage Products</a>
	<a href="adminlogout.php">Logout</a>
	<div class="content">
        <div>
            All Transaction
            <?php
            $sql = "SELECT transaction.transaction_date, account.username, transaction.total_price  FROM transaction INNER JOIN account ON transaction.user_id = account.user_id";
            $result = mysqli_query($conn, $sql);
            ?>
            <table border="1">
                <tr>
                    <th>Transaction Date</th>
                    <th>Username</th>
                    <th>Spend</th>
                </tr>
                <?php
                $sum = 0;
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    
                    while ($row = mysqli_fetch_assoc($result)) {                       
                        
                ?>
                <tr>
                    <td><?php echo $row['transaction_date']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                </tr>
                <?php
                    $sum += $row['total_price'];
                    }
                }else {
                    echo "<tr><td colspan='3'>Tidak ada data.</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="2">Total</td>
                    <td><b><?php echo $sum; ?></b></td>
                </tr>
            </table>
        </div>
        <a href="../admin.php">Back</a>
    </div>
</body>
</html>
