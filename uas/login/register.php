<?php
session_start();
include "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $confirmPass = $_POST['confirm_pass'];
    

    $sql = "SELECT * FROM account WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $error = "Username already in use.";
    } else if ($confirmPass != $pass){
        $error = "Passwords do not match.";
    } else {
        $first_letter = mb_substr($username,0,1);
        $first_letter = strtolower($first_letter);
        $sql = "select * from account where user_id like '{$first_letter}%'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_num_rows($result);
        
        $max = 0;
        while ($data = mysqli_fetch_assoc($result)){
            $id = $data['user_id'];
            $id = mb_substr($id,1);
            if ($id > $max){
                $max = $id;
            } 
        }

        $new_id = $max + 1;

        $new_user_id = $first_letter.$new_id;

        $query = "INSERT INTO `account`(`user_id`, `username`, `pass`) VALUES ('{$new_user_id}','$username','$pass')";   
        mysqli_query($conn, $query);

        $query = "INSERT INTO `user_cart`(`cart_id`, `user_id`) VALUES ('{$new_user_id}c','$new_user_id')";   
        mysqli_query($conn, $query);
        
        $_SESSION['user_id'] = $new_user_id;
        $_SESSION['username'] = $username;
        header("Location: login.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/register.css">
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
    <div class="register-container">
        <div class="register-form">
            <h2>Register New Account</h2>
            <br>
            <form method="POST" action="">
                <label style="text-align: left;">Username:</label>
                <br>
                <input type="text" name="username" required class="transparent-input fa" placeholder="&#xf007; Enter your username..." style="font-family:'DM Sans', FontAwesome" data-fa-processed>
                    
                <label style="text-align: left;">Password:</label>
                <input type="password" name="pass" required class="transparent-input fa" placeholder="&#xf023; Enter your password..." style="font-family:'DM Sans', FontAwesome" data-fa-processed>

                <label style="text-align: left;">Confirm Password:</label>
                <input type="password" name="confirm_pass" required class="transparent-input fa" placeholder="&#xf023; Enter your password again..." style="font-family:'DM Sans', FontAwesome" data-fa-processed>
                <br><br>
                <div class="button-container">
                    <input type="submit" value="Register">
                </div>
            </form>
            <?php if(isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
        </div>
    </div>
</body>
</html>