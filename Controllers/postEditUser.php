<?php

    include("usersClass.php");

    session_start();

    $user = new User();

    
    function checkId()
    {
      if(isset($_GET['id']))
      { 
        return $_GET['id'];
      }else{
        return null;
      }  
    }

    $userObject = $user->getUserById( checkId() );

    $username    = trim( ucwords( $_POST['username'] ), ' ') ;
    $password    = trim( $_POST['password'], ' ');
    $phone       = $_POST['phone'];
    $photo = $user->getPhoto( $userObject['user_id'] );

    // print_r(file_get_contents($_FILES['photo']['tmp_name']));


    if( $_FILES['photo']['size'] != null ){
      $photo       = file_get_contents($_FILES['photo']['tmp_name']);
    }
    // echo '<pre>';
    // print_r($userObject);
    // echo '</pre>';

    echo isset($userObject);

    if( isset($_POST['edit']) && $userObject )
    {
      if( strlen($username) > 2 && strlen($username) <= 25 && strlen($password) > 5 &&
          strlen($password) <= 60 && $phone != '' && strlen($phone) == 11 && ctype_digit($phone))
      {

        $user->editUser( $userObject, $username,  $password ,  $phone, $photo );

        if( isset( $userObject['user_type_id'] ) )
        {
          if( $userObject['user_type_id'] == 1  ){
            header('Location: ../Dashboards/Admin_Dashboards/Dashboards/users/Customers.php');
            die();
          }elseif( $userObject['user_type_id'] == 2 ){
            header('Location: ../Dashboards/Admin_Dashboards/Dashboards/users/Admins.php');
            die();
          }
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

        if( $username == '' && $phone == '' && $password == ''  ){
          $_SESSION['message']   = "<div class='message' id='messageNotAdd'><h4>Can't Edit {$userObject['username']}. Please Fill All Inputs</h4></div>";
        }
        $_SESSION['username']  = $username;
        $_SESSION['password']  = $password;
        $_SESSION['phone']     = $phone;
        $_SESSION['userPhoto'] = $photo;
        header("Location: ../Dashboards/Admin_Dashboards/Dashboards/Forms/EditUser.php?id={$userObject['user_id']}");
        die();
      }
    }

    header("Location: ../Dashboards/Admin_Dashboards/Dashboards/Forms/EditUser.php?id={$userObject['user_id']}");
    die();


?>



