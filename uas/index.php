<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <a href="">
                <div>STORE</div>
            </a>
            <a href="">
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
    <div class="center">
        <h2>Category:</h2>
        <select id="category">
            <option value="" selected disabled hidden>-- Select Category --</option>
            <option value="all">All</option>
            <option value="skincare">Skincare</option>
            <option value="dietary supplement">Dietary Supplement</option>
            <option value="herbal drink">Herbal Drink</option>
            <option value="spray">Spray</option>
            <option value="analgesic">Analgesic</option>
        </select>
    </div>
    <hr>
    <div class="content">
        <div class="products-row">
            <div class="products-list">
                <h2>BIODERMA</h2>
                <div>
                    <img src="images/product_01.png">
                </div>
                <form method="post" action="cart/cart.php">
                    <input type="text" name="products" value="bioderma" hidden>
                    <button type="submit" name="submitproducts">BUY<br><b>Rp. 50000</b></button>
                </form>
            </div>
            <div class="products-list">
                <h2>CHANCAPIEDRA</h2>
                <div>
                    <img src="images/product_02.png">
                </div>
                <form method="post" action="cart/cart.php">
                    <input type="text" name="products" value="chancapiedra" hidden>
                    <button type="submit" name="submitproducts">BUY<br><b>Rp. 40000</b></button>
                </form>
            </div>
            <div class="products-list">
                <h2>UMCKA COLD CARE</h2>
                <div>
                    <img src="images/product_03.png">
                </div>
                <form method="post" action="cart/cart.php">
                    <input type="text" name="products" value="umcka cold care" hidden>
                    <button type="submit" name="submitproducts">BUY<br><b>Rp. 100000</b></button>
                </form>
            </div>
        </div>

    </div>
</body>
</html>