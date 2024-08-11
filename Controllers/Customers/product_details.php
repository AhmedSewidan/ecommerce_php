<?php


if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header("Location: ../Shop/shop.php?section=$ranSectionId");
    exit();
}

$id                     = $_GET['id'];
$object                 = $product->getProductById( $id );
$sectionId              = $object['section_id'];
$section                = $product->getSectionById($sectionId);
$productOfChartById     = $product->getProductChart( $customerId, $id );
$section_name           = $section['section_name']; 
$product_name           = $object['product_name'];
$price                  = $object['price'];
$quantity               = $object['quantity'];

if( $quantity == 0 ){
    $addToChatrid = "notActiveButton";
    $min = 0;
    $message ="<p class=\"red\">This Product Is Currently Unavailable.</p>";
}elseif( $quantity <= 3 ){
    $min = 1;
    $addToChatrid = "";
    $message ="<p class=\"red\">Only $quantity Left In Stock - Order Soon.</p>";
}else{
    $min = 1;
    $addToChatrid = "";
    $message = "";
}

if(isset($_SESSION['ErrorMessage'])){
    $errorM = $_SESSION['ErrorMessage'];
}else{
    $errorM = '';
}

$addToCart = 'Add to cart';

if($productOfChartById){
    $productQuantityOfChart = $productOfChartById[0]['order_quantity'];

    if( ( $quantity - $productQuantityOfChart ) == 0 ){
        $addToChatrid = "notActiveButton";
        $min = 0; 
        $message ="<p class=\"red\">You Had Added All Quantity Of This Product In Your Cart</p>";
        $addToCart = 'Open cart';
    }
    $maxQuantity =  $quantity - $productQuantityOfChart;
}else{
    $maxQuantity = $quantity;
}

?>