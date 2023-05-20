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
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <h1>Report Total Spent per Member</h1>
    <form method="POST" action="">
    <span>Status Transaction</span>
    <select id="status" name="status">
        <option value="" disabled selected hidden> -- Select Status -- </option>
        <option value="all">All</option>
        <option value="delivered">Delivered</option>
        <option value="ordered">Ordered</option>
    </select>
    <br>
    <span>Date from :</span>
    <input type="date" name="start_date" id="start_date">
    <span>Until :</span>
    <input type="date" name="end_date" id="end_date">

    <input type="submit" name="submit_date_member" value="Go">
    </form>
    <table>
    <tr>
        <th>Username</th>
        <th>Total Spent</th>
    </tr>

    <?php
    if(isset($_POST['submit_date_member'])){
        $status = $_POST['status'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        if($status == 'all'){
            $query = "SELECT account.username, sum(transaction.total_price) as total_spent FROM transaction INNER JOIN account ON transaction.user_id = account.user_id where transaction.transaction_date between '$start_date' and '$end_date' group by account.username";
        } else {
            $query = "SELECT account.username, sum(transaction.total_price) as total_spent FROM transaction INNER JOIN account ON transaction.user_id = account.user_id where transaction.status='$status' and transaction.transaction_date between '$start_date' and '$end_date' group by account.username";
        }
        
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)){
    ?>
    <tr>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['total_spent']; ?></td>
    </tr>
<?php

    }
}
?>
</table>

</body>
</html>