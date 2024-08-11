<?php

    session_start();
    include("usersClass.php");


    $user = new User();

    $fetchStat = $user->fethAll();

    $username    = trim( ucwords( $_POST['username'] ), ' ') ;
    $password    = trim( $_POST['password'], ' ');
    $phone       = trim( $_POST['phone'], ' ' );

    if( $_FILES['photo']['error'] == 0 ){
      $photo = file_get_contents($_FILES['photo']['tmp_name']);
    }else{
      $photo = file_get_contents('../public/customer/img/SimpleProfile.jpg');
    }

    function checkNumber(){
      global $fetchStat, $phone, $username, $password;
      for( $i = 0; $i < count( $fetchStat ); $i++  )
      {
        if( $fetchStat[$i]['user_type_id'] == 1 )
        {
            if( $phone == $fetchStat[$i]['phone_number'] )
            {    
                $_SESSION['MPhone']    = '<small class="red">This Phone Has Already Acount</small>';
                $_SESSION['username']  = $username;
                $_SESSION['password']  = $password;
                $_SESSION['phone']     = $phone;
                header('Location: ../Dashboards/Login/signUp.php');
                die();  
            }
        }
      }
      return true;
    }

    if( isset($_POST['signSubmit']) )
    {
        if( strlen($username) > 2 && strlen($username) <= 25 && strlen($password) > 5 &&
            strlen($password) <= 60 && $phone != '' && strlen($phone) == 11 && ctype_digit($phone))
        {
          if( checkNumber() ){
            $user->addUser( $username,  $password ,  $phone, 1 , $photo);
            $lastInsert = $user->getLastInsert();
            $userObj = $user->getUserById($lastInsert);
            
            if ($userObj) {
              $_SESSION['customer'] = $userObj;
            }else{
              header('Location: ../Dashboards/login/signUp.php?add=false');
              die();  
            }

            header("Location: ../Dashboards/Customer_Dashboards/Dashboards/Home/home.php");
            die();
          }

        }else{
          if( $username == '' ){
            $_SESSION['MUsername'] = '<small class="red">Please Enter Username</small>';
          }elseif( strlen($username) <= 2  || strlen($username) > 25){
            $_SESSION['MUsername'] = '<small class="red">Username Must Be Between 3 : 25 Characters</small>';
          }
  
          if( $password == '' ){
            $_SESSION['MPassword'] = '<small class="red">Please Enter Password</small>';
          }elseif( strlen($password) <= 5 || strlen($password) > 60){
            $_SESSION['MPassword'] = '<small class="red">Password Must Be Between 6 : 60 Characters</small>';
          }
          
          if( $phone == '' ){
            $_SESSION['MPhone']    = '<small class="red">Please Enter Phone Number</small>';
          }elseif( strlen($phone) != 11 ){
            $_SESSION['MPhone']    = '<small class="red">Phone Number Should be 11 Number</small>';
          }elseif( !ctype_digit($phone) ){
            $_SESSION['MPhone']    = '<small class="red">Phone Number Should be integer</small>';
          }

          $_SESSION['username']  = $username;
          $_SESSION['password']  = $password;
          $_SESSION['phone']     = $phone;
          $_SESSION['userPhoto'] = $photo;
        }
    }
    // header('Location: ../Dashboards/login/signUp.php');
    // die();  