<?php
session_start();
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
    <title>Reports</title>
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
    <div class="centered">
        <a href="reportallspentpermember.php">Report Spent per Member</a>
        <a href="reportproductcategoryearnings.php">Report Product Category Earnings</a>
        <a href="reportproductearnings.php">Report Product Earnings</a>
        <a href="reportsalesproductpermonth.php">Report Sales Product per Month</a>
        <a href="reportsalesproductperperiod.php">Report Sales Product per Period</a>
    </div>
</body>
</html>