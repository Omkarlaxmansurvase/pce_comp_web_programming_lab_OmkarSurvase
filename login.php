<?php
$showError=true;
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['login'])){
        include "connection.php";
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        if(!empty($username) && !empty($pass) && !is_numeric($username)){
            $query = "select * from signin where username ='$username' limit 1";
            $result = mysqli_query($con, $query);
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                if($pass === $user_data['pass']){
                    session_start();
                    header("location: Homepage.html");
                    exit();
                } else {
                    echo "<script type='text/javascript'> alert('Wrong username or password')</script>";
                    $showError = "Incorrect credentials!";
                }
            } else {
                echo "<script type='text/javascript'> alert('User not found')</script>";
                $showError = "User not found!";
            }
        }
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>

    <link rel="stylesheet" href="assets/css/register.css">
    <script defer src="./register.js"></script>
</head>
<body class="body">
<div class="container">
    <form id="register" method="POST" action="" name="register">
        <h1 class="login_text">Login Here</h1>
        
        <div class="input-control">
            <label class="label1" for="username">Username</label>
            <input id="username" name="username"  class="input1" type="text">
            <div class="error"></div>
        </div>

        <div class="input-control">
            <label class="label3" for="password">Password</label>
            <input id="password" name="pass" class="input2" type="password">
            <div class="error"></div>
        </div>
        

        <input class="submit" type="submit" name="login" value="Login">
    </form>
    <p>If dont have a account ? <a href="register.php">Register here</a><p>
</div>
</body>
</html>
