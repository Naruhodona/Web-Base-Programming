<?php
session_start();
include "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: admin.php");
    } else {
        $error = "Username or password is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body  style="background-image: url('../images/bg_1.jpg');background-size: cover; background-repeat: no-repeat; background-position: center center; background-attachment: fixed;">
    <div class="login-container">
        <div class="login-form">
            <h2>Admin FKS Farma</h2>
            <form method="POST" action="">
                <label style="text-align: left;">Username:</label>
                <br>
                <input type="text" name="username" required class="transparent-input fa" placeholder="Enter your username..." style="font-family:'DM Sans', FontAwesome" data-fa-processed>
                <br><br>
                <label style="margin-left: 0px;">Password:</label>
                <br>
                <input type="password" name="password" required class="transparent-input fa" placeholder="Enter your password..." style="font-family:'DM Sans', FontAwesome" data-fa-processed>
                <br><br>
                <div class="button-container">
                    <input type="submit" value="Login">
                </div>
            </form>
            <?php if(isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
        </div>
    </div>
</body>
</html>