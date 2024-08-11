<?php

    include("productsClass.php");

    $product = new Product();

    $object = $product->getProductById( $_GET['id']);

    if($object){
      
      $product->deleteProduct($object);

    }

    header("Location: ../Dashboards/Admin_Dashboards/Dashboards/sections/Section.php?section={$_GET['section']}");
    die();
