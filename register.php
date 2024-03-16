<?php
$showError = true;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "connection.php";
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $existSql = "SELECT * FROM `signin` WHERE username = '$username'";
        $result = mysqli_query($con, $existSql);
        $numExistRows = mysqli_num_rows($result);

        if (!empty($email) && !empty($pass) && !is_numeric($email)) {
            $query = "INSERT INTO signin (username, email, pass) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $pass);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "<script type='text/javascript'> alert('Successfully Registered')</script>";
            header("location:login.php");
            exit();
        } else {
            echo "<script type='text/javascript'> alert('Please enter some valid information!')</script>";
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
        <h1 class="login_text">Register Here</h1>
        <div class="input-control">
            <label class="label1" for="username">Username</label>
            <input id="username" name="username" class="input1" type="text" style="color:white;">
            <div class="error"></div>
        </div>
        <div class="input-control">
            <label class="label2" for="email">Email</label>
            <input id="email" name="email"  class="input3" type="text">
            <div class="error"></div>
        </div>

        <div class="input-control">
            <label class="label3" for="password">Password</label>
            <input id="password" name="pass" class="input2" type="password">
            <div class="error"></div>
        </div>
        <div class="input-control">
            <label class="label4" for="password2">Password again</label>
            <input id="password2" name="pass2"  class="input4" type="password">
            <div class="error"></div>
        </div>

        <input class="submit" type="submit" name="register" value="Submit">
    </form>
</div>
</body>
</html>
