<?php

    include("usersClass.php");

    $user = new User();

    if( isset($_POST['deleteAll']) ){

        if(isset($_POST['checkbox']) & is_array($_POST['checkbox']) ) {

            $user->deleteManyUsers($_POST['checkbox']);

            if( isset( $_GET['user_type_id'] ) )
            {
                if($_GET['user_type_id'] == 1 )
                {
                    header('Location: ../Dashboards/Admin_Dashboards/Dashboards/users/Customers.php');
                    die();
                }if( $_GET['user_type_id'] == 2 )
                {
                    header('Location: ../Dashboards/Admin_Dashboards/Dashboards/users/Admins.php');
                    die();
                }
            }

        } 
    }else {
        header('Location: ../Dashboards/Admin_Dashboards/Dashboards/users/Customers.php?delete=0');
        die();
    }
