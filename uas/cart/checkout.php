<?php
session_start();
include "../connection.php";

if ((!isset($_SESSION["username"]) && !isset($_POST['cart_submit'])) || (!isset($_SESSION["username"]) && !isset($_GET['message']))){
    header("Location: ../login/login.php");
    exit();
}

if (isset($_SESSION["username"]) && isset($_POST['cart_submit'])){
        $user_id = $_POST['user_id'];
        $cart_id = $_POST['cart_id'];
        $total = $_POST['total'];
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog</title>
    <link rel="stylesheet" href="../css/checkout.css">
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
            <a href="">
                <div>STORE</div>
            </a>
            <a href="">
                <div>ABOUT</div>
            </a>
            <a href="../profile/profile.php">
                <div>PROFILE</div>
            </a>
        </div>
        <div class="cart-login">
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
        <form method="POST" action="transaction.php">
            <div>
                <h1>Billing Details</h1>
                <div class="form-box">
                    <b>Address Delivery :</b>
                    <br>
                    <textarea name="address"></textarea>
                    <br>
                    <b>Phone Number :</b>
                    <br>
                    <input type="text" name="phone_number">
                    <br>
                    <b>Additional Notes :</b>
                    <br>
                    <textarea name="notes"></textarea>
                    <b></b>
                    <br>
                    <b>Payment Options :</b><br>
                    <input type="radio" id="gopay" name="payment" value="gopay">
                    <label for="gopay"><img src="../images/gopay.png"></label><br>
                    <input type="radio" id="ovo" name="payment" value="ovo">
                    <label for="ovo"><img src="../images/ovo.png"></label><br>
                    <input type="radio" id="dana" name="payment" value="dana">
                    <label for="dana"><img src="../images/dana.png"></label>
                </div>
            </div>
            <div>
                <h1>Your Order</h1>
                <div class="form-box">
                    <table>
                        <tr>
                            <th>Product</th>
                            <th>Total</th>
                        </tr>
                        <?php
                            $sql = "SELECT products.products_name, products.price, cart.quantity FROM cart INNER JOIN products ON cart.products_id = products.products_id WHERE cart_id='{$_SESSION['user_id']}c'";
                            $result = mysqli_query($conn, $sql);
                            $sum = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                $subtotal = $row['price']*$row['quantity'];
                        ?>
                        <tr>
                            <td><?php echo $row['products_name']; ?> x <?php echo $row['quantity']; ?></td>
                            <td><?php echo $subtotal; ?></td>
                        </tr>
                        <?php
                            $sum += $subtotal;
                            }
                        ?>
                        <tr>
                            <td><b>Order Total</b></td>
                            <td><b><?php echo $sum; ?><b></td>
                        </tr>
                    </table>
                    <input type="text" name='total' id="total" value='<?php echo $sum; ?>' hidden>
                    <button type="submit" name="final_order">PLACE ORDER</button>
                </div>

            </div>
            
        </form>
    </div>
    <?php

        if (isset($_GET['message'])){
            echo "<h2>Your order on <i>{$_GET['products_name']}</i> surpassed our stock {$_GET['stock']} left.</h2>";
        }
    ?>

</body>