<?php

    include("productsClass.php");

    $product = new Product();

    if( isset($_POST['deleteAll']) ){

        if(isset($_POST['checkbox']) & is_array($_POST['checkbox']) ) {

            $product->deleteProducts($_POST['checkbox']);

            if( isset( $_GET['section'] ) )
            {
                header("Location: ../Dashboards/Admin_Dashboards/Dashboards/sections/Section.php?section={$_GET['section']}");
                die();
            }

        } 
    }else {
        header('Location: ../Dashboards/Admin_Dashboards/Dashboards/users/Customers.php?delete=0');
        die();
    }
