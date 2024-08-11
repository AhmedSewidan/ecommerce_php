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

        if( isset($_GET['id']) ){
            $product_id  = intval( $_GET['id'] );

            $product->deleteProductToOrder( $product_id, $user_id, $quantity, $amount_one_product );
            
        }

        header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Cart/cart.php");
        die();

    }else{

        $_SESSION['MLogin'] = "<div>Please log in again to access your account. Thank you for your cooperation!</div>";

        header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Home/home.php");
        die();
    }

    // echo '<pre>'; var_dump( $id ); echo '</pre>' ;



    


