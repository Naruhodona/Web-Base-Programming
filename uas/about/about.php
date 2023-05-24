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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/about.css">
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
            <a href="../store/store.php">
                <div>STORE</div>
            </a>
            <a href="" class="active">
                <div>ABOUT</div>
            </a>
            <a href="../profile/profile.php">
                <div>PROFILE</div>
            </a>
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
                    <a href="../login/login.php">LOGIN</a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="about-container">
        <h1>Our Vision</h1>
        <div class="about-card top">

            <div class="left-container">
                <div class="text-container" style="margin-left:10px">
                    
                    <br>
                    <h3>
                        Our pharmacy's vision is to become a trusted healthcare partner and a leading provider of pharmaceutical services in our community. We strive to deliver exceptional patient care by offering a wide range of high-quality medications, personalized services, and innovative healthcare solutions. Our vision is to contribute to the well-being of our customers and improve their quality of life through accessible and comprehensive pharmaceutical care.
                    </h3>
                </div>
            </div>
            <div class="right-container">
                <div class="img-container">
                        <img src="../images/about1.jpg"> 
                </div>
            </div>
        </div>
        <div class="bottom">
            <h1>Our Mission</h1>
            <div class="about-card">
                <div class="img-container">
                    <img src="../images/about2.jpg"> <!-- you can change this into a video or anything media related -->
                </div>
                <div class="text-container">
                    <h3>
                        Our mission is to provide reliable and accessible pharmaceutical services that meet the healthcare needs of our community. We are committed to delivering exceptional customer service, ensuring the safety and efficacy of medications, and promoting optimal health outcomes. We aim to foster a compassionate and caring environment where our highly skilled team of pharmacists and healthcare professionals work collaboratively to educate, support, and empower our customers in making informed decisions about their health. Our mission is to be a trusted resource for healthcare information and to continuously innovate and adapt to the evolving needs of our community.
                    </h3>
                </div>
            </div>
        </div>
    <!-- Our People
    blablabla -->
    </div>