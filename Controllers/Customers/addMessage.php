<?php
    session_start();

    include("../productsClass.php");

    $product = new Product();

    $message = trim( $_POST['comment'], " " );
    
    if( isset($_GET['id']) && isset($_SESSION['customer']) && isset($_POST['submit']) ){

        $id      = $_GET['id'];
        $userObj = $_SESSION['customer'];

        if( strlen($message) > 0 ){
            $product->addMessage($message, $userObj['user_id'], $id);
            $_SESSION['reviewMessage'] = "<div class='message' id='message'>Your Review Sent Successfully</div>";
            backHeader();
        }else{
            $_SESSION['emptyError'] = "<small style='color:red;text-align:center;'>Message Can't Be Empty</small>";
            $_SESSION['message']    = $message;
            backHeader();
        }


    }else{
        $_SESSION['message']    = $message;
        $_SESSION['reviewMessage'] = "<div class='message' id='redMessage'>Can't Send This Message Please Try Again Or Log In Again</div>";
        backHeader();
    }
    
    function backHeader(){
        header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Forms/review.php?id={$_GET['id']}");
        die();    
    }


