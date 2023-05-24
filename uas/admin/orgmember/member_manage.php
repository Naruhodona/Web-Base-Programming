<?php
session_start();
	if (!isset($_SESSION["username"])) {
    header("Location: ../adminlogin.php");
    exit();
}
?>

<html>
    <head>
        <title>Pengelolaan Member</title>
        <link type="text/css" rel="stylesheet" href="../../css/index.css">
        <link type="text/css" rel="stylesheet" href="../../css/admin.css">
        <style>
            .img-tiny{
                width:50px;
                height:50px;
            }
        </style>
        
    </head>
    <body>
    <div class="header">
				<div class="logo">
					<a href="../admin.php">Admin FKS Farma</a>
				</div>
				<div class="nav">    
					<a href="../orgmember/member_manage.php" class="active">
						<div>Organize User Accounts</div> 
					</a>
					<a href="../report/reportpages.php">
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
        <h2>Member Manage</h2>
        <?php

        include "../../connection.php";

        $query = "select * from account";
        $result = mysqli_query($conn, $query);

        if ($result){
        ?>

            <form action="delete_member.php" method="post">
            <div>
            <table border="1">
            <tr>

                <th width="30">ID</th>
                <th width="100">username</th>
                <th colspan="2" class="center" width="100">Action</th>		
            </tr>
            <?php
            while ($row = mysqli_fetch_row($result)) {
            ?>
            <tr>
                <?php

                $user_id = $row[0];
                $username = $row[1];

                ?>
                <td><?php echo $user_id;?></td>
                <td><?php echo $username;?></td>
                <td>
                    <a href ="delete_member.php?id=<?php echo $user_id;?>">Delete</a>
                    </td>
                </tr>
            <?php 
            
            } 
            ?>
            </table></div>
            </form>
            <a href="../admin.php">Back</a>
            <?php
            mysqli_free_result($result);
        }
        mysqli_close($conn);
        ?>

    </body>
</html>   