<?php

    include("productsClass.php");

    $product = new Product();

    $section = $product->getSectionById($_GET['section']);

    if( isset( $_GET['section'] ) && $_GET['section'] != null ){
      $product->deleteSection($section);
      $id = $product->randomId( 'sections', 'section_id' );
    }
    header("Location: ../Dashboards/Admin_Dashboards/Dashboards/sections/Section.php?section=$id");
    die();


