<?php
session_start();
include "../connection.php";

if (!isset($_SESSION["username"])) {
    header("Location: ../login/login.php");
    exit();
}

if (isset($_SESSION["username"]) && isset($_POST['submitproducts'])){
    $products = $_POST['products'];
    $sql = "SELECT products_id FROM products WHERE products_name='$products'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $products_id = $row['products_id'];
    $query = "SELECT * FROM cart where cart_id='{$_SESSION['user_id']}c' and products_id='$products_id'";
    $result = mysqli_query($conn, $query);
    $result_products_id = mysqli_num_rows($result);
    if($result_products_id > 0){
        $data = mysqli_fetch_assoc($result);
        $quantity = $data['quantity'];
        $quantity += 1;
        $sql = "UPDATE cart set quantity=$quantity where cart_id='{$_SESSION['user_id']}c' and products_id='$products_id'";
        $result = mysqli_query($conn, $sql);
    } else {
        $sql = "INSERT INTO cart(cart_id, products_id, quantity) values('{$_SESSION['user_id']}c', '$products_id', 1)";
        $result = mysqli_query($conn, $sql);
    }
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
            <div class="cart">
                <a href="cart/cart.php">
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
    <div class="container">
        <?php
        $sql = "SELECT products.image, products.products_name, products.price, cart.quantity FROM cart INNER JOIN products ON cart.products_id = products.products_id WHERE cart_id='{$_SESSION['user_id']}c'";
        $result = mysqli_query($conn, $sql);
        ?>
        <form method="POST" action="transaction.php">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Gambar Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>QTY</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $sum = 0;
                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    
                    while ($row = mysqli_fetch_assoc($result)) {                       
                        $subtotal = $row['quantity'] * $row['price'];
            ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><img src="<?php echo $row['image']; ?>" width="50%"></td>
                    <td><?php echo $row['products_name']; ?></td>
                    <td id="price_<?php echo $no; ?>"><?php echo $row['price']; ?></td>
                    <td><input type="number" min='1' name='quantity' id='quantity' value="<?php echo $row['quantity']; ?>" onchange="updateSubtotal(this.value, '<?php echo $no; ?>')" data-products-name="<?php echo $row['products_name']; ?>"></td>
                    <td><input type="text" name='subtotal' id="subtotal_<?php echo $no; ?>" value='<?php echo $subtotal; ?>' readonly style="border: none; text-align: center; outline: none;"></td>
                    <td><a href="deletecart.php?cart_id=<?php echo $_SESSION['user_id'].'c'; ?>&products_name=<?php echo $row['products_name']; ?>">Delete</a></td>
                </tr>
            <?php
                        $no++;
                        $sum += $subtotal;
                    }
            ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Total</td>
                    <td>
                        <input type="text" name='total' id="total" value='<?php echo $sum; ?>' readonly style="border: none; text-align: center; outline: none;">
                        <input type="text" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" hidden>
                        <input type="text" name="cart_id" value="<?php echo $_SESSION['user_id'].'c'; ?>" hidden>
                    </td>
                    <td><input type="submit" name="cart_submit" value="Pay"></td>
                </tr>
                <tr>
                    <td colspan="7" style="text-align: center;"><a href="clearcart.php?cart_id=<?php echo $_SESSION['user_id'].'c'; ?>">Clear Cart</a></td>
                </tr>
            <?php
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data.</td></tr>";
                }
            ?>
            
                
            </tbody>
        </table>
        </form>
        <?php

        if (isset($_GET['pesan'])){
            echo "<h1>Thank you for your order!!!</h1>";
        }
        ?>
    </div>
</body>
</html>