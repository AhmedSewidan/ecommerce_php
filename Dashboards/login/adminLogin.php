<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title  -->
    <title>E-Commerce</title>

    <!-- Favicon  -->
    <link rel="icon" href="../../public/customer/img/core-img/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../../public/login/css/login.css">
</head>
<body>
<div class="container">
    <h1>Login Admins</h1> 
    <form action="../../Controllers/login_request.php?type=2" method="post">
        <input type="tel" name="loginPhone" placeholder="Phone Number"
        value="<?php session_start(); if(isset($_SESSION['phone'])){ echo $_SESSION['phone'];} ?>">
        <!-- Message -->
        <?php if(isset($_SESSION['MPhone'])){ echo $_SESSION['MPhone'];} ?>

        <div class="pass">
            <input type="password" class="password" id="password" name="loginPassword" placeholder="Password"
                value="<?php if(isset($_SESSION['password'])){ echo $_SESSION['password'];} ?>">
        </div>
        <div class="eye" onclick="togglePasswordVisibility();">
          &#x1F441;
        </div>
        <!-- Message -->
        <?php if(isset($_SESSION['MPassword'])){ echo $_SESSION['MPassword'];} unset( $_SESSION['MPassword'], $_SESSION['password'], $_SESSION['MPhone'], $_SESSION['phone']); ?>

        <input type="submit" name="loginSubmit" value="Login">
    </form>
    <div class="signup-link">
        <a href="signUp.php">Sign Up</a>
    </div>
    <div class="signup-link">
        <a href="customerLogin.php">I'm Customer</a>
    </div>
</div>
<script src="../../public/login/js/input.js"></script>
</body>
</html>
