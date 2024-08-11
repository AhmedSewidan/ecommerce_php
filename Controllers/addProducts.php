<?php
    session_start();
    include("productsClass.php");
    
    $product = new Product();

    $product_name   = trim( ucwords( $_POST['product'] ), ' ');
    $price          = $_POST['price'];
    $quantity       = $_POST['quantity'];
    $section        = $_GET['section'];

    if( $_FILES['photo']['error'] == 0 ){
      $photo = file_get_contents($_FILES['photo']['tmp_name']);
    }else{
      $photo = file_get_contents('../public/customer/img/SimpleProfile.jpg');
    }

    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';
    // print_r(file_get_contents($_FILES['photo']['tmp_name']));

    if( isset($_POST['add']) )
    {
      if( strlen($product_name) > 2 && strlen($product_name) <= 25 && strlen($price) <= 9  )
      {
        if( isset($section) )
        {
          $product->addProduct( $product_name,  $price ,  $quantity, $section, $photo );
          $_SESSION['message'] = "<div class='message' id='messageAdd'>
            <h4>Product Added Successfully Click <a href=\"../sections/Section.php?section=$section\">Table</a> To See</h4></div>";
        }
      }else{
        if( $product_name == '' ){
          $_SESSION['MProduct'] = '<small class="red">Please Enter product</small>';
        }elseif( strlen($product_name) <= 2  || strlen($product_name) > 25){
          $_SESSION['MProduct'] = '<small class="red">Product Name Must Be Between 3 : 25 Characters</small>';
        }

        if( $price != '' && strlen($price) <= 2  || strlen($price) > 9 ){
          $_SESSION['MPrice'] = '<small class="red">Price Must Be Between 0 : 999,999,999 Coin</small>';
        }

        $_SESSION['product']      = $product_name;
        $_SESSION['price']        = $price;
        $_SESSION['quantity']     = $quantity;
        $_SESSION['productPhoto'] = $photo;
      }
    }

    header("Location: ../Dashboards/Admin_Dashboards/Dashboards/Forms/AddProduct.php?section=$section");
    die();
