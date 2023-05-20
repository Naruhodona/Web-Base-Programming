<?php
session_start();
include "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    

    $sql = "SELECT * FROM account WHERE username = '$username' AND pass = '$pass'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        header("Location: ../index.php");
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/48638eddb5.js" crossorigin="anonymous"></script>
    <style>
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(5px);
            z-index: -1;
        }
    </style>
</head>
<body style="background-image: url('../images/backdrop.png');background-size: cover; background-repeat: no-repeat; background-position: center center; background-attachment: fixed;">
    <div class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <br>
            <form method="POST" action="">
            <label style="text-align: left;">Username:</label>
            <br>
            <input type="text" name="username" required class="transparent-input fa" placeholder="&#xf007; Enter your username..." style="font-family:'DM Sans', FontAwesome" data-fa-processed>
            <br><br>
            <label style="margin-left: 0px;">Password:</label>
            <br>
            <input type="password" name="pass" required class="transparent-input fa" placeholder="&#xf023; Enter your password..." style="font-family:'DM Sans', FontAwesome" data-fa-processed>
            <br><br>
            <div class="button-container">
                <input type="submit" value="Login">
            </div>
            </form>
            <?php if(isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
            <?php } ?>
        </div>
        <a href="register.php">Don't have any account yet?</a>
    </div>
</body>
</html>