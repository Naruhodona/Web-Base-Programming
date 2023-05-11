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
    <link type="text/css" rel="stylesheet" href="">
	<style>
		.img-tiny{
			width:50px;
			height:50px;
		}
	</style>
	
</head>
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
		<th width="100">password</th>
		<th colspan="2" class="center" width="100">Action</th>		
	</tr>
    <?php
    while ($row = mysqli_fetch_row($result)) {
	?>
	<tr>
		<?php

        $user_id = $row[0];
		$username = $row[1];
		$password = $row[2];

	    ?>
        <td><?php echo $user_id;?></td>
		<td><?php echo $username;?></td>
		<td><?php echo $password;?></td>
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