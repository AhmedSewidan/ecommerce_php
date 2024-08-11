<?php 

    session_start();
    include("../productsClass.php");
    include("../usersClass.php");

    
    $product = new Product();
    $user    = new User();

    if( isset($_SESSION['customer']) )
    {            

        $userObj            = $_SESSION['customer'];
        $user_id            = $userObj['user_id'];

        if( isset($_POST['quantity']) ){

            $quantity    = intval( $_POST['quantity'] );
            if( isset($_GET['id']) ){
                $product_id  = intval( $_GET['id'] );
                $productObj             = $product->getProductById($product_id);
                $productOfChartById     = $product->getProductChart( $user_id, $product_id );
                $productQuantityOfChart = $productOfChartById[0]['order_quantity'];
                $price                  = $productObj['price'];
                $amount_one_product     = $price * $quantity;
                $quantityOfProduct      = $productObj['quantity'];
                $product_name      = $productObj['product_name'];
                // echo '<pre>'; print_r( $productOfChartById ); echo '</pre>' ;


                if(  $quantity <= $quantityOfProduct  ){
                    if($quantity > 0){
                        $product->updateProductToOrder( $product_id, $user_id, $quantity, $amount_one_product );
                    }
                }else{
                    $_SESSION['MQuantity'] = "<small class='red'>Sorry The Quantity Available Of This Product [ <span class='blue'>$product_name</span> ] is : <span class='blue'>$quantityOfProduct</span></small>";
                }
            }
        }

        header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Cart/cart.php");
        die();

    }else{

        $_SESSION['MLogin'] = "<div>Please log in again to access your account. Thank you for your cooperation!</div>";

        header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Home/home.php");
        die();
    }




    


