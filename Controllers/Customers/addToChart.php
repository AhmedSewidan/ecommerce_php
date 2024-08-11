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

        if( isset($_POST['submit']) ){

            $product_id  = intval( $_POST['submit'] );
            $quantity    = intval( $_POST['quantity'] );

        }elseif( isset($_GET['id']) ){

            $product_id = $_GET['id'];
            $quantity   = 1;

        }

        $productObj             = $product->getProductById($product_id);
        $photo                  = $product->getPhoto( $product_id );
        $productsInChart        = $product->getProductToOrder( $user_id );
        $productOfChartById     = $product->getProductChart( $user_id, $product_id );
        // $productsInCart         
        $productQuantityOfChart = $productOfChartById[0]['quantity'];
        $price                  = $productObj['price'];
        $amount_one_product     = $price * $quantity;

        foreach( $productsInChart as $arrayId ){

            if( $product_id == $arrayId['product_id'] && $arrayId['status'] === 'Not Ordered' ){

                $total_quantity = $quantity + $arrayId['order_quantity'];
                $amount_one_product = $total_quantity * $price;

                if(  $total_quantity <= $productObj['quantity'] && $productObj['quantity'] > 0 ){

                    $product->updateProductToOrder( $product_id, $user_id, $total_quantity, $amount_one_product );

                    header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Cart/cart.php");
                    die();

                }else{
                    header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Home/product-details.php?id=$product_id");
                    die();
                }
                


            }
        }

        if( $productObj['quantity'] > 0 && $quantity > 0 ){

            $product->addProductToOrder($product_id, $user_id, $quantity, $amount_one_product);

            header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Cart/cart.php");
            die();
        }
        
        header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Home/product-details.php?id=$product_id");
        die();

    }else{

        $_SESSION['MLogin'] = "<div>Please log in again to access your account. Thank you for your cooperation!</div>";

        header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Home/home.php");
        die();
    }



    echo '<pre>'; var_dump( $_POST ); echo '</pre>' ;



    


