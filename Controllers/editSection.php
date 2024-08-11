<?php

session_start();
include("productsClass.php");

$product = new Product();

$id = $_GET['section'];
$section_name = ucwords( $_POST['section'] );
$photo = file_get_contents('../img/SimpleProfile.jpg');

if( $_FILES['photo']['size'] != null ){
  $photo       = file_get_contents($_FILES['photo']['tmp_name']);
}

// echo '<pre>';
// print_r($_FILES);
// echo '</pre>';
if( isset($_POST['edit']) && isset($_GET['section']) )
{
  if( $section_name != '' )
  {
    $product->editSection($section_name, $photo, $id);
    $_SESSION['message'] = "<div class='message' id='messageAdd'>$section_name Edited Successfully</div>";
    header("Location: ../Dashboards/Admin_Dashboards/Dashboards/sections/Section.php?section={$_GET['section']}");
    die();
  }else{
    $_SESSION['MName']        = "<small class='red'>Section Name Must Be Fill</small>";
    header("Location: ../Dashboards/Admin_Dashboards/Dashboards/Forms/EditSection.php?section={$_GET['section']}");
    die();
  }
}

header("Location: ../Dashboards/Admin_Dashboards/Dashboards/sections/Section.php?section={$_GET['section']}");
die();