<?php

    session_start();
    include("usersClass.php");

    $user = new User();
    $fetchStat = $user->fethAll();

    $phone    = $_POST['loginPhone'];
    $password = $_POST['loginPassword'];

    if(isset($_GET['type'])){
        $type = $_GET['type'];
    }else{
        $type = 0;
    }

    function back(){
        global $type;
        if( $type == 2 ){
            header("Location: ../Dashboards/login/adminLogin.php");
            die();
        }elseif( $type == 1 ){
            header("Location: ../Dashboards/login/customerLogin.php");
            die();
        }
    }

    if( isset($_POST['loginSubmit']) && $type)
    {
        global $fetchStat;

        if( $password != '' && $phone != '' && strlen($phone) == 11 )
        {
                for( $i = 0; $i < count( $fetchStat ); $i++  )
                {
                    if( $fetchStat[$i]['user_type_id'] == $type )
                    {
                        if( $phone == $fetchStat[$i]['phone_number'] && $password == $fetchStat[$i]['user_pass'])
                        {      
                            $userObj = $fetchStat[$i];
                            $id = $fetchStat[$i]['user_id'];



                            if( $type == 2 ){

                                $_SESSION["admin"] = $userObj;

                                header("Location: ../Dashboards/Admin_Dashboards/Dashboards/users/Customers.php");
                                die();
                            }elseif( $type == 1 ){
                                
                                $_SESSION["customer"] = $userObj;
                                header("Location: ../Dashboards/Customer_Dashboards/Dashboards/Home/home.php");
                                die();
                            }
                        }
                    }
                } 
                $_SESSION['MPhone']    = '<small class="red">Password Or Phone Is\'nt Correct</small>';
                $_SESSION['MPassword'] = '<small class="red">Password Or Phone Is\'nt Correct</small>';
                $_SESSION['password']  = $password;
                $_SESSION['phone']     = $phone;
                back();  
        }else{
            if( $password == '' ){
                $_SESSION['MPassword'] = '<small class="red">Please Enter Your Password</small>';
              }
              if( $phone == '' ){
                $_SESSION['MPhone']    = '<small class="red">Please Enter Your Phone Number</small>';
              }elseif( strlen($phone) != 11 ){
                $_SESSION['MPhone']    = '<small class="red">Phone Number Should be 11 Number</small>';
              }
              $_SESSION['password']  = $password;
              $_SESSION['phone']     = $phone;
              back();
        }
    }
    back();
?>