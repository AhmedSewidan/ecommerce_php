<?php 

    session_start();
    include("../productsClass.php");
    include("../usersClass.php");

    
    $product = new Product();
    $user    = new User();

    if( isset($_SESSION['customer']) )
    {            

        $userObj       = $_SESSION['customer'];
        $user_id       = $userObj['user_id'];
        $productsInCart = $product->productsInCart($user_id);
        $checkQuantityBeforeBuy = $product->checkQuantityBeforeBuy($user_id);

        if( $productsInCart && isset($_POST['order']) )
        {
            $first_name    = ucwords($_POST['first_name']); 
            $last_name     = ucwords($_POST['last_name']); 
            $country       = ucwords($_POST['country']); 
            $pay           = ucwords($_POST['pay']); 
            $city          = ucwords($_POST['city']); 
            $phone_number  = $_POST['phone_number']; 
            $address       = $_POST['address']; 
            $comment       = $_POST['comment']; 
            $total_amount  = $_POST['total'];
            

            if( !$checkQuantityBeforeBuy ){
                if( strlen( $address ) > 5 && strlen( $comment ) < 200 && ( strlen( $phone_number ) == 11 || strlen( $phone_number ) == 0 ) ){
                    $product->addOrder( $user_id, $total_amount, "Pending", $city, $address, $phone_number, $comment, $first_name, $last_name, 0, $pay, $country );
                    $lastInsert = $product->getLastInsert();
                    $product->editProductByQuantity($user_id);
                    $product->updateProductToBeOrder( $user_id, "Ordered", $lastInsert );
                }else{
                    if( strlen( $address ) == 0 || strlen( $address ) < 5 ){
                        $_SESSION['MAddress'] = '<small class="red">Please Enter Your Real Position</small>';
                    }
        
                    if( strlen( $phone_number ) != 0 && ( strlen( $phone_number ) < 11 || strlen( $phone_number ) > 11 ) ){
                        $_SESSION['MPhone'] = '<small class="red">Phone Must Be 11 Number</small>';
                    }
        
                    $_SESSION['first_name']   = $first_name; 
                    $_SESSION['last_name']    = $last_name; 
                    $_SESSION['country']      = $country; 
                    $_SESSION['pay']          = $pay; 
                    $_SESSION['city']         = $city; 
                    $_SESSION['phone_number'] = $phone_number; 
                    $_SESSION['address']      = $address; 
                    $_SESSION['comment']      = $comment;
        
                    header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Checkout/checkout.php");
                    die();
                }
        
                $_SESSION['MOrderd'] = "<p class=\"MOrderd\">Your order is preparing</p>";
                header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Cart/orders.php");
                die();
            }else{
                $_SESSION['MQuantity'] = "<small class='red'>
                Sorry The Quantity Available Of This Product [ <span class='blue'>" . $checkQuantityBeforeBuy['product_name'] . "</span> ] is : <span class='blue'>" . $checkQuantityBeforeBuy['quantity'] . "</span>
                </small>";

                header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Cart/cart.php");
                die();
            }
    

        }
    }
    header("Location: ../../Dashboards/Customer_Dashboards/Dashboards/Checkout/checkout.php");
    die();


    


