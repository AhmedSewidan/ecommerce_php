<?php 

include("../../../../Controllers/usersClass.php");
include("../../../../Controllers/productsClass.php");
session_start();

$user    = new User();
$product = new Product();

$checkIdExist = $user->allUsersIds($_SESSION['customer']['user_id']);

if(!$checkIdExist){
  unset($_SESSION['customer']);
}

if (!isset($_SESSION['customer'])) {
  echo '<script>
          alert("Please log in again to access your account !...");
          window.location.href = "../../../login/customerLogin.php";
        </script>';
  exit;
}

if(isset($_SESSION['customer'])){
  $customer   = $_SESSION['customer'];
  $customerId = $_SESSION['customer']['user_id'];
  $photoData = $user->getPhoto($_SESSION['customer']['user_id']);
  $base_encode = base64_encode($photoData);
}else{ 
  $customerId = null;
  $base_encode = null;
}
$sectionRecords = $product->records('sections');  
$productsOfCart = $product->getProductToOrder($customerId);
$total_amount = 0;
foreach($productsOfCart as $products){
    $total_amount += $products['total_amount'];
}

if(isset($_GET['section'])){
  $section = $_GET['section'];
}

$ranSectionId = $product->randomId( 'sections', 'section_id' );
$ranTypeId    = $product->randomId( 'user_type', 'user_type_id' );
$firstSection = $product->firstRecord('sections', 'section_id');

function getImge($id = ""){
  global $user;
  if(isset($_SESSION['customer'])){
    $photoData = $user->getPhoto($_SESSION['customer']['user_id']);
    echo "<img id=\"$id\" class=\"nav-link dropdown-toggle hide-arrow\" src=\"data:image/jpeg;base64," . base64_encode($photoData) . "\" style=\"width: 40px; height: 40px; border-radius: 50%;\" >";
  }else{ 
    echo "<img id=\"$id\" class=\"nav-link dropdown-toggle hide-arrow\" src=\"../../../../public/customer/img/SimpleProfile.jpg\" alt class=\"w-px-40 h-auto rounded-circle\" />";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>E-Commerce</title>

    <!-- Favicon  -->
    <link rel="icon" href="../../../../public/customer/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="../../../../public/customer/css/core-style.css">
    <link rel="stylesheet" href="../../../../public/customer/css/style.css">

</head>

<body>
  
    <div class="main-content-wrapper d-flex clearfix">
      
        <?php include('../../layouts/menu.php'); ?>





