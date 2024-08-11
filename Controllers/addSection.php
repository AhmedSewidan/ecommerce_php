<?php

session_start();
include("productsClass.php");

$product = new Product();

if( isset( $_GET['section'] ) && $_GET['section'] != null ){
  $id = $_GET['section'];
}else{
  $id = $product->randomId( 'sections', 'section_id' );
}

$section_name = ucwords( $_POST['section'] );
$photo = file_get_contents('../img/SimpleProfile.jpg');

if( $_FILES['photo']['size'] != null ){
  $photo       = file_get_contents($_FILES['photo']['tmp_name']);
}

echo '<pre>';
print_r($_FILES);
echo '</pre>';
if( isset($_POST['add']) && $section_name )
{
  if( $section_name != '' )
  {
    $product->addSection($section_name, $photo);
    $_SESSION['message'] = "<div class='message' id='messageAdd'>$section_name Added Successfully</div>";
  }else{
    $_SESSION['MName'] = "<small class='red'>Please Enter Section Name</small>";
  }

  header("Location: ../Dashboards/Admin_Dashboards/Dashboards/Forms/AddSection.php?section=$id");
  die();
}

header("Location: ../Dashboards/Admin_Dashboards/Dashboards/sections/Section.php?section=$id");
die();