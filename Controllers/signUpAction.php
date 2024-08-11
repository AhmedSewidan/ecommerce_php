<?php

include("../../Controllers/usersClass.php");
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

  $userObject = $user->getUserById( checkId());

  if(isset($_GET['id']))
  { 
      if( !$userObject )
      {
      header('Location: adminHome.php');
      die();
      }    
  }


  function checkAction()
  {
      global $userObject;
      if( isset($_SESSION['userPhoto']) ){
        $_GET['userPhoto'] = $_SESSION['userPhoto'];
      }else{
        $_GET['userPhoto'] = null;
      }
      if(isset($_GET['id']))
      {
        echo "../../Controllers/postEditUser.php?id=" . $_GET['id'] . "&user_type_id={$userObject['user_type_id']}";
      }else{
        echo "../../Controllers/signUp_request.php";
      }
  }

  function username(){
    global $userObject;
    if(isset($_SESSION['username'])){
        echo $_SESSION['username'];
    }elseif(isset($_GET['id'])){
        echo $userObject['username'];
    }
  }

  function pass(){
    global $userObject;
    if(isset($_SESSION['password'])){
      echo $_SESSION['password'];
    }elseif(isset($_GET['id'])){
        echo $userObject['user_pass'];
    }
  }

  function phone(){
      global $userObject;
      if(isset($_SESSION['phone'])){
        echo $_SESSION['phone'];
      }elseif(isset($_GET['id'])){
        echo $userObject['phone_number'];
      }
  }

?>