<?php
session_start();
include "connection.php";
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
            <a href="index.php">FKS Farma</a>
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
            <p>
At FKS Pharmacy, we are dedicated to providing exceptional healthcare services and reliable access to high-quality medications. As a trusted online pharmacy, we prioritize the well-being and convenience of our customers. Our goal is to make healthcare accessible, affordable, and personalized, ensuring that everyone receives the care they deserve.

We offer a comprehensive range of pharmaceutical products, including prescription medications, over-the-counter drugs, and health supplements. Our experienced team of licensed pharmacists is committed to delivering accurate medication information, counseling, and personalized recommendations to support your health needs.

In addition to our wide selection of medications, we provide convenient online ordering and fast, discreet shipping to your doorstep. Our user-friendly website allows you to browse and purchase products with ease, ensuring a seamless and secure shopping experience.
            </p>
            <hr>
            <h1 style="text-align: center;">There are 3 top product seller at FKS Pharmacy</h1>
            <div class="content">
                <div class="products-row">
                    <?php
                $query = "select products.products_name, products.price, products.image, sum(cart_paid.quantity) as sold from cart_paid inner join products on cart_paid.products_id = products.products_id group by products.products_name order by sold desc limit 3";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)){
                    
                ?>
                    <div class="products-list">
                        <h1><?php echo $row['products_name']; ?></h1>
                        <div>
                            <img src="<?php echo substr($row['image'], 3); ?>">
                        </div>
                        <form method="post" action="cart/cart.php">
                            <input type="text" name="products" value="<?php echo $row['products_name']; ?>" hidden>
                            <button type="submit" name="submitproducts">BUY<br><b>Rp. <?php echo $row['price']; ?></b></button>
                        </form>
                    </div>
                    <!-- <div class="products-list">
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
                    </div> -->
                    <?php
                    }
                    ?>
                </div>
        </section>

    </div>
    </div>