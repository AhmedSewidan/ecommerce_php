<?php 

    session_start();
    include("../productsClass.php");
    include("../usersClass.php");

    
    $product = new Product();
    $user    = new User();

    $section = $_GET['section'];

    if( isset($_POST['view']) )
    {            

        $_SESSION['view']    = intval( $_POST['view'] );

    }elseif( isset($_POST['sort-by']) ){

        $_SESSION['sort-by']    = $_POST['sort-by'];

    }elseif( isset($_POST['min']) && isset($_POST['max']) ){
        $_SESSION['min'] = intval($_POST['min']);
        $_SESSION['max'] = intval($_POST['max']);
    }elseif( isset($_POST['auto']) ){
        unset($_SESSION['sort-by'], $_SESSION['view'], $_SESSION['min'], $_SESSION['max'], $_SESSION['show']);
    }elseif( isset($_GET['show']) ){
        $_SESSION['show'] = $_GET['show'];
    }      
    header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Shop/shop.php?section=$section");
    die();

//     echo '<br>POST : <pre>';
// var_dump($_POST);
// echo '</pre>';

// echo 'GET : <pre>';
// var_dump($_GET);
// echo '</pre>';


