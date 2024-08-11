<?php
    session_start();
    include("usersClass.php");
    
    $user = new User();

    $fetchStat = $user->fethAll();

    $username    = trim( ucwords( $_POST['username'] ), ' ') ;
    $password    = trim( $_POST['password'], ' ');
    $phone       = $_POST['phone'];
    $user_type   = $_GET['user_type_id'];

    if( $_FILES['photo']['error'] == 0 ){
      $photo = file_get_contents($_FILES['photo']['tmp_name']);
    }else{
      $photo = file_get_contents('../public/customer/img/SimpleProfile.jpg');
    }

    function checkNumber(){
      global $fetchStat, $phone, $username, $password, $user_type;
      for( $i = 0; $i < count( $fetchStat ); $i++  )
      {
        if( $fetchStat[$i]['user_type_id'] == $user_type )
        {
            if( $phone == $fetchStat[$i]['phone_number'] )
            {    
                $_SESSION['MPhone']    = '<small class="red">This Phone Has Already Acount</small>';
                $_SESSION['username']  = $username;
                $_SESSION['password']  = $password;
                $_SESSION['phone']     = $phone;
                header("Location: ../Dashboards/Admin_Dashboards/Dashboards/Forms/AddUser.php?user_type_id=$user_type");
                die();
            }
        }
      }
      return true;
    }
    
    if( $user_type == 1 ){
      $type = 'Customer';
      $table_link = 'Customers.php';
    }elseif( $user_type == 2 ){
      $type = 'Admin';
      $table_link = 'Admins.php';
    }

    if( isset($_POST['add']) )
    {
      if( strlen($username) > 2 && strlen($username) <= 25 && strlen($password) > 5 &&
          strlen($password) <= 60 && $phone != '' && strlen($phone) == 11 && ctype_digit($phone) )
      {
        if( isset($user_type) )
        {
          if( checkNumber() ){
            $user->addUser( $username,  $password ,  $phone, $user_type, $photo );
            $_SESSION['message'] = "<div class='message' id='messageAdd'>
                                      <h4>$type Added Successfully Click <a href=\"../users/$table_link\">Table</a> To See</h4>
                                    </div>";
          }
        }
        // else ________
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
      }
    }
    header("Location: ../Dashboards/Admin_Dashboards/Dashboards/Forms/AddUser.php?user_type_id=$user_type");
    die();

