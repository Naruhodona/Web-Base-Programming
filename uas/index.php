<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FKS_Farma Home</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/index.js"></script>
<body>
    <div class="header">
        <div class="logo">
            <a href="">FKS Farma</a>
        </div>
        <div class="nav">    
            <a href="index.php" class="active">
                <div>HOME</div>
            </a>
            <a href="store/store.php">
                <div>STORE</div>
            </a>
            <a href="about/about.php">
                <div>ABOUT</div>
            </a>
            <?php if (isset($_SESSION["user_id"])) { ?>
                <a href="profile/profile.php"><div>PROFILE</div></a>
            <?php } else { ?>
                <a href="login/login.php"><div>PROFILE</div></a>
            <?php } ?>
        </div>
        <div class="cart-login">
            <div class="cart">
                <a href="cart/cart.php">
                    <img src="images/cart.png">
                </a>
            </div>
            <div class="login">
                <?php if (isset($_SESSION["username"])) { ?>
                    <a href="logout/logout.php"><?php echo $_SESSION['username']; ?> | LOGOUT</a>
                <?php } else { ?>
                    <a href="login/login.php">LOGIN</a>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <header>
            <img src="images/hero_1.jpg" class="background">
            <h1 class="title">Welcome to FKS Pharmacy!</h1>
        </header>
        <section>
        <h1>Paling Populer</h1> 
            <hr>
            <div class="content">
                <div class="products-row">
                    <div class="products-list">
                        <div>
                            <img src="images/product_01.png">
                        </div>
                        <form method="post" action="cart/cart.php">
                            <input type="text" name="products" value="bioderma" hidden>
                            <button type="submit" name="submitproducts">BUY</button>
                        </form>
                    </div>
                    <div class="products-list">
                        <div>
                            <img src="images/product_02.png">
                        </div>
                        <form method="post" action="cart/cart.php">
                            <input type="text" name="products" value="chancapiedra" hidden>
                            <button type="submit" name="submitproducts">BUY</button>
                        </form>
                    </div>
                    <div class="products-list">
                        <div>
                            <img src="images/product_03.png">
                        </div>
                        <form method="post" action="cart/cart.php">
                            <input type="text" name="products" value="umcka cold care" hidden>
                            <button type="submit" name="submitproducts">BUY</button>
                        </form>
                    </div>
                </div>
        </section>

    </div>
    </div>