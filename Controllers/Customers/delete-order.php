<?php

    session_start();
    include("../productsClass.php");

    $product = new Product();

    if( isset($_SESSION['customer']) )
    {            

        $userObj       = $_SESSION['customer'];
        $user_id       = $userObj['user_id'];
        $product->deleteOrder( $user_id, $_GET['id']);

    }
    
    header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Cart/orders.php");
    die();