<?php 
include('../../layouts/header.php');
include('../../layouts/userProfile.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = null;
}

$object       = $product->getProductById( $id );
$quantity     = $object['quantity'];

if( $quantity == 0 ){
    $message ="<p class=\"red\">This Product Is Currently Unavailable.</p>";
}elseif( $quantity <= 3 ){
    $message ="<p class=\"red\">Only $quantity Left In Stock - Order Soon.</p>";
}else{
    $message = "";
}
?>


        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Review</h2>
                            </div>

                            <form action="../../../../Controllers/Customers/addMessage.php?id=<?php echo $id ?>" method="post">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <textarea name="comment" class="form-control w-100" maxlength="249" id="comment" cols="30" rows="10"
                                                  placeholder="Enter your review message"><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];} ?></textarea>
                                        <?php if(isset($_SESSION['emptyError'])){echo $_SESSION['emptyError'];} ?>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="submit" name="submit" id="submitReview" class="btn amado-btn w-100" value="Send">
                                    </div>
                                </div>
                            </form>
                            <?php
                                if(isset($_SESSION['reviewMessage'])) {
                                    echo $_SESSION['reviewMessage'];
                                    echo "<script>setTimeout(function(){document.querySelector('.message').style.opacity = 0; setTimeout(function(){";
                                    echo "document.querySelector('.message').style.display = 'none'; ";
                                    echo "}, 1000); }, 5000);";
                                    echo "setTimeout(function(){";  
                                    echo "  ".json_encode($_SESSION['reviewMessage']);
                                    echo "}, 5000);</script>";
                                } 
                                unset($_SESSION['reviewMessage'], $_SESSION['emptyError'], $_SESSION['message']);
                            ?>
                        </div>
                        

                    </div>
                    <div id="imgReview" class="col-12 col-lg-4">
                        <a href="../Home/product-details.php?id=<?php echo $id ?>">
                            <div class="single-product-wrapper">
                                <div class="product-img">
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($product->getPhoto($object['product_id'])) ?>" />
                                </div>
                                <div class="product-description d-flex align-items-center justify-content-between">
                                    <div class="product-meta-data">
                                        <div class="line"></div>
                                        <p class="product-price">$<?php echo $object['price'] ?></p>
                                            <h6><?php echo $object['product_name'] ?></h6>
                                    </div>
                                    <div class="ratings-cart text-right">
                                        <div class="ratings">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <div class="cart">
                                            <a href="../Cart/cart.php?id=<?php echo $id ?>" data-toggle="tooltip" data-placement="left" title="Add to Cart">
                                                <img src="../../../../public/customer/img/core-img/cart.png" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php echo $message ?>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>    


        
<?php include('../../layouts/footer.php'); ?>