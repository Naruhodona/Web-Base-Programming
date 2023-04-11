<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN</title>
	<link rel="stylesheet" href="styles/index.css">
</head>
<body>
<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "kosong"){
			echo "<h4 style='color:red'>Maaf, User atau password masih kosong!</h4>";
		}else if($_GET['pesan'] == "input") {
			echo "<h4 style='color:red'>Maaf, User atau password salah!</h4>";
		}
	}
?>

<h1 style="text-align: center;">LOGIN</h1>

<form action="admin_login.php" method="post">
	<table>
		<tr>
			<td>Username</td>
			<td><input type="text" name="nama"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="btnSubmit" value="Login"></td>
		</tr>
	</table>
	<div style="text-align:center;"><a href="user/home.php">I'm an user</a></div>
</form>
</body>
</html>