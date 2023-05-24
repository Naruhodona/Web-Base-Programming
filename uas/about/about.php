<?php
session_start();
include "../connection.php";

if (!isset($_SESSION["username"])) {
    header("Location: ../login/login.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog</title>
    <link rel="stylesheet" href="../css/cart.css">
</head>

<!-- script ajax -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/cart.js"></script>
<body>
    <div class="header">
        <div class="logo">
            <a href="../index.php">FKS Farma</a>
        </div>
        <div class="nav">    
            <a href="../index.php">
                <div>HOME</div>
            </a>
            <a href="../store/store.php" class="active">
                <div>STORE</div>
            </a>
            <a href="about.php">
                <div>ABOUT</div>
            </a>
            <a href="../profile/profile.php">
                <div>PROFILE</div>
            </a>
        </div>
        <div class="cart-login">
            <div class="cart">
                <a href="cart.php">
                    <img src="../images/cart.png">
                </a>
            </div>
            <div class="login">
                <?php if (isset($_SESSION["username"])) { ?>
                    <a href="../logout/logout.php"><?php echo $_SESSION['username']; ?> | LOGOUT</a>
                <?php } else { ?>
                    <a href="../login/login.php">LOGIN</a>
                <?php } ?>
            </div>
        </div>
    </div>
    
</body>
</html>