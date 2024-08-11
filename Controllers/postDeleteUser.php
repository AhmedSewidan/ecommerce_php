<?php

    include("usersClass.php");

    $user = new User();

    $userObject = $user->getUserById( $_GET['id']);
    $userType   = $userObject['user_type_id'];

    if($userObject){
      
      $user->deleteUser($userObject);
      
      if( $userType == 1 ){
        header('Location: ../Dashboards/Admin_Dashboards/Dashboards/users/Customers.php');
        die();
      }elseif( $userType == 2 ){
        header('Location: ../Dashboards/Admin_Dashboards/Dashboards/users/Admins.php');
        die();
      }

    }else{
      header('Location: ../Dashboards/Admin_Dashboards/Dashboards/users/Customers.php');
      die();
    }
