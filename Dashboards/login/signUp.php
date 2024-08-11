<?php session_start(); include("../../Controllers/signUpAction.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="../../public/login/css/signUp.css">
    <link rel="icon" href="../../public/customer/img/core-img/favicon.ico">
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        <form action="<?php checkAction(); ?>" method="post" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username" value="<?php username(); ?>">
            <?php if(isset($_SESSION['MUsername'])){ echo $_SESSION['MUsername'];} ?>

            <input type="password" name="password" id="password" placeholder="Password" value="<?php pass(); ?>">
            <?php if(isset($_SESSION['MPassword'])){ echo $_SESSION['MPassword'];} ?>

            
            <div class="eye" onclick="togglePasswordVisibility();">
            &#x1F441;
            </div>

            <input type="tel" name="phone" placeholder="Phone Number" value="<?php phone(); ?>">
            <?php if(isset($_SESSION['MPhone'])){ echo $_SESSION['MPhone'];} ?>

            <div class="photo">
                <div class="choose">
                    <input type="file" name="photo" id="file-upload" class="custom-file-input" accept="image/*" onchange="displaySelectedImage(event)">
                    <label for="file-upload" class="custom-file-button">Choose Image</label>
                </div>

                <div class="small">
                    <small id="image-container">
                        <?php
                        if(isset($_SESSION['userPhoto'])){
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($_SESSION['userPhoto']) . '"
                                style="width: 40px; height: 40px; border-radius: 50%;" />';
                        }else{
                            echo '<img src="../../public/customer/img/SimpleProfile.jpg"
                                style="width: 40px; height: 40px; border-radius: 50%;" />';
                        }

                        session_unset(); 
                        
                        ?>
                    </small>
                </div>

                <a href="customerLogin.php"> Log In </a>
            </div>

            <input type="submit" name="signSubmit" value="Sign Up">
        </form>

    </div>

    <script src="../../public/admin/js/signUp.js"></script>
    <script src="../../public/login/js/input.js"></script>
</body>
</html>
