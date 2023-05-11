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
        header("Location: ../index.php");
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
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="container">
        <h2>Register New Account</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="pass" required>
            </div>
            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="confirm_pass" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
        <?php if(isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
    </div>
</body>
</html>