<?php 
$cart = 'active';
include('../../layouts/header.php'); 
include('../../layouts/userProfile.php');




function MQuantity(){
    if(isset($_SESSION['MQuantity'])) {
        echo "<div class=\"MQuantity\">{$_SESSION['MQuantity']}</div>";
        echo "<script>setTimeout(function(){document.querySelector('.MQuantity').style.opacity = 0; setTimeout(function(){";
        echo "document.querySelector('.MQuantity').style.display = 'none'; ";
        echo "}, 1000); }, 7000);";
        echo "setTimeout(function(){";
        echo "  ".json_encode($_SESSION['MQuantity']);
        echo "}, 5000);</script>";
    }
}
?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8" id="col-12">
                <div class="cart-title mt-50">
                    <h2>Shopping Cart</h2>
                    <?php MQuantity(); ?>
                </div>
                <div class="cart-table clearfix">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $product->getProductsInOrder($customerId); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4" id="col-12">
                <div class="cart-summary">
                    <h5>Cart Total</h5>
                    <ul class="summary-table">
                        <li><span>subtotal:</span> <span>$<?php echo $total_amount; ?></span></li>
                        <li><span>delivery:</span> <span>Free</span></li>
                    </ul>
                    <div class="cart-btn mt-100">
                        <a href="../Checkout/checkout.php" class="btn amado-btn w-100">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    


        
<?php include('../../layouts/footer.php'); unset($_SESSION['MQuantity']); ?>