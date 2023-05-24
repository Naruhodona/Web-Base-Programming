<?php
session_start();
include "../connection.php";

if (!isset($_SESSION["username"])) {
    header("Location: ../login/login.php");
    exit();
}


$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
if(isset($_POST['btn_change_pass'])){
    $new_password = $_POST['change_pass'];
    $query = "update account set pass='$new_password' where user_id='$user_id'";
    $result = mysqli_query($conn, $query);
}
$sql = "SELECT pass FROM account where user_id='$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$pass = $row['pass'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Katalog</title>
    <link type="text/css" rel="stylesheet" href="../css/index.css">
    <link type="text/css" rel="stylesheet" href="../css/admin.css">
<script>
    function changePass(){
        document.getElementById('new_pass').style.display = "block";
        document.getElementById('change_pass').style.display = "block";
        document.getElementById('btn_change_pass').style.display = "block";
    }
</script>
</head>
<body>
	<div class="header">
        <div class="logo">
            <a href="../index.php">FKS Farma</a>
        </div>
        <div class="nav">    
            <a href="../index.php">
                <div>HOME</div>
            </a>
            <a href="../store/store.php">
                <div>STORE</div>
            </a>
            <a href="../about/about.php">
                <div>ABOUT</div>
            </a>
            <?php if (isset($_SESSION["user_id"])) { ?>
                <a href="profile.php" class="active"><div>PROFILE</div></a>
            <?php } else { ?>
                <a href="../login/login.php" class="active"><div>PROFILE</div></a>
            <?php } ?>
        </div>
        <div class="cart-login">
            <div class="cart">
                <a href="../cart/cart.php">
                    <img src="../images/cart.png">
                </a>
            </div>
            <div class="login">
                <?php if (isset($_SESSION["username"])) { ?>
                    <a href="../logout/logout.php"><?php echo $_SESSION['username']; ?> | LOGOUT</a>
                <?php } else { ?>
                    <a href="login/login.php">LOGIN</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="user-password">
            
            <span>Your Password :</span>
            <input type="password" name="user_pass" value="<?php echo $pass; ?>" readonly>
            <button onclick="changePass()">Change Password</button>
            <br>
            <form method="POST" action="">
            <span id="new_pass" style="display:none;">New Password :</span>
            <input type="password" id="change_pass" name="change_pass" style="display: none;">
            <input type="submit" id="btn_change_pass" name="btn_change_pass" style="display: none;" value="Change">
            </form>
        </div>
    	<div class="history">
    		<h1>Your Transaction History</h1>
    		<?php
    		$sql = "SELECT transaction_date, total_price FROM transaction WHERE user_id='$user_id'";
       		$result = mysqli_query($conn, $sql);
    		?>
    		<table>
    			<tr>
    				<th>Transaction Date</th>
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
    				<td><?php echo $row['total_price']; ?></td>
    			</tr>
    			<?php
    				$sum += $row['total_price'];
    				}
    			}else {
                    echo "<tr><td colspan='2'>Tidak ada data.</td></tr>";
                }
    			?>
    			<tr>
    				<td>Total</td>
    				<td><b><?php echo $sum; ?></b></td>
    			</tr>
    		</table>
    	</div>
    </div>
</body>
</html>