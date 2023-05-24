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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/admin.css">
	<title>Admin FKS Farma</title>
</head>
<body>
    <div class="header">
            <div class="logo">
                <a href="admin.php">Admin FKS Farma</a>
            </div>
            <div class="nav">    
                <a href="orgmember/member_manage.php">
                    <div>Organize User Accounts</div> 
                </a>
                <a href="report/reportpages.php">
                    <div>Reports</div>
                </a>
                <a href="product/product_manage.php">
                    <div>Manage Products</div>
                </a>
            </div>
            <div class="button-container">
                    <a href="adminlogout.php">
                        <div>Logout</div>
                    </a>
            </div>
    </div>
	<div class="content">
        <div>
            <?php
            $sql = "SELECT transaction.transaction_id, transaction.transaction_date, account.username, transaction.total_price, transaction.status  FROM transaction INNER JOIN account ON transaction.user_id = account.user_id";
            $result = mysqli_query($conn, $sql);
            ?>
            <table border="1">
                <tr>
                    <th>Transaction Date</th>
                    <th>Username</th>
                    <th>Spend</th>
                    <th>Status</th>
                    <th>Change to Delivered</th>
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
                    <td><?php echo $row['status']; ?></td>
                <?php
                	if($row['status'] == 'ordered'){
                		echo "<td><a href='changedelivered.php?transaction_id={$row['transaction_id']}'>Change</a></td>";
                	} else {
                		echo "<td></td>";
                	}
                ?>
                </tr>
                <?php
                    $sum += $row['total_price'];
                    }
                }else {
                    echo "<tr><td colspan='4'>Tidak ada data.</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="2">Total</td>
                    <td><b><?php echo $sum; ?></b></td>
                    <td colspan="2" style="background-color: black;"></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
