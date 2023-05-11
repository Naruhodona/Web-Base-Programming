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
	<a href="adminlogout.php">Logout</a>
</body>
</html>