<link rel="stylesheet" href="public/customer/css/core-style.css">
<?php 

include("Controllers/productsClass.php");
include("Controllers/usersClass.php");

$product = new Product();
$user = new User();


$products =  $product->checkQuantityBeforeBuy(2);

// if($products){
//     echo 'found products';
// }else{
//     echo 'no products';
// // }
// foreach($users as $user){

//     foreach($user as $key => $value){
//         if(!in_array($key, ["photo"])){
//             echo $key . ' => ' . $value;
//             echo '<br>';
//         }        
//     }
//     echo '<br><br><br><br>';
// }

function testQuantity(){
    global $products;

    $id = 5;
    foreach( $products as $productId){
        if($id == $productId['product_id']){
            if( $productId['quantity'] != 0 ){
                return 'Available to buy';
            }
        }
    
    }
    return 'Not available to buy';
}


function testQuantity2(){
    global $productDetail;

}

function lastMethod(){
    global $product;
    $productsInCart = $product->productsInCart(2);

    $arrayIds = [];
    foreach( $productsInCart as $oneProduct){
        array_push($arrayIds, $oneProduct['product_id']);
    }

    $productDetail = $product->getAllProductsByIDs($arrayIds);

    foreach( $productDetail as $oneProductDetail){
        if($oneProductDetail['quantity'] == 0){
            return $oneProductDetail['product_id'];
        }
    }
    return 'true';
}

// echo lastMethod();
if(!$products){

    echo 'ready to buy';
}else{

    echo '<pre>';
    print_r($products);
    echo '</pre>';
    
}
?>


