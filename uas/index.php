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
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Et nam tempore ullam culpa accusamus, ipsam aspernatur pariatur natus nisi eveniet temporibus, quisquam corrupti fugit quasi assumenda repellendus! Quas ab deleniti voluptatum delectus distinctio dolore, tempore sint quibusdam ipsum ut blanditiis vero officia nesciunt magni minima facilis quae, consectetur error obcaecati. Ipsam perferendis sit dolores distinctio accusamus vero cumque modi autem aperiam nemo dolore neque unde repellendus repudiandae quisquam eos, suscipit, expedita totam omnis dolorum laborum atque nulla beatae. Illo, tempora expedita! Tenetur iusto nobis magnam incidunt accusamus repudiandae eligendi id, nemo ea ducimus magni exercitationem sapiente. Tempore eaque nemo laboriosam!
            <hr>
            <div class="content">
                <div class="products-row">
                    <div class="products-list">
                        <div>
                            <img src="images/product_01.png">
                        </div>
                        <form method="post" action="cart/cart.php">
                            <input type="text" name="products" value="bioderma" hidden>
                            <button type="submit">BUY</button>
                        </form>
                    </div>
                    <div class="products-list">
                        <div>
                            <img src="images/product_02.png">
                        </div>
                        <form method="post" action="cart/cart.php">
                            <input type="text" name="products" value="chancapiedra" hidden>
                            <button type="submit">BUY</button>
                        </form>
                    </div>
                    <div class="products-list">
                        <div>
                            <img src="images/product_03.png">
                        </div>
                        <form method="post" action="cart/cart.php">
                            <input type="text" name="products" value="bioderma" hidden>
                            <button type="submit">BUY</button>
                        </form>
                    </div>
                </div>
        </section>

    </div>
    </div>