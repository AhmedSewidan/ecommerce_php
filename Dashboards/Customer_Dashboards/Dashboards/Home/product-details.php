<?php 
$active = 'active';
include('../../layouts/header.php'); 
include('../../layouts/userProfile.php');
include('../../../../Controllers/Customers/product_details.php'); 

?>


        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <?php echo $errorM; ?>
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-50">
                                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="../Shop/shop.php?section=<?php echo $sectionId ?>"><?php echo $section_name ?></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $product_name ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="img/product-img/pro-big-1.jpg">
                                            <img class="d-block w-100" src="data:image/jpeg;base64,<?php echo base64_encode($product->getPhoto($object['product_id'])) ?>" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">$<?php echo $price ?></p>
                                <a href="#">
                                    <h6><?php echo $product_name ?></h6>
                                </a>
                                
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="review">
                                        <a href="../Forms/review.php?id=<?php echo $id ?>">Write A Review</a>
                                    </div>
                                </div>
                                
                                <p class="avaibility"><i class="fa fa-circle"></i> In Stock</p>
                            </div>

                            <div class="short_overview my-5">
                                <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quae eveniet culpa officia quidem
                                        mollitia impedit iste asperiores nisi reprehenderit consectetur adipisicing elit consequatur, autem, nostrum pariatur enim?
                                </p>
                            </div>
                            <?php echo $message; ?>

                            
                            <form class="cart clearfix" action="../../../../Controllers/Customers/addToChart.php" method="post">
                                <div class="cart-btn d-flex mb-50">
                                    <p>Qty</p>
                                    <div class="quantity">
                                        <span class="qty-minus-details" onclick="decrement(this, 0)"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" name="quantity" 
                                                value="<?php echo $min; ?>">
                                        <span class="qty-plus-details" onclick="increment_max(this, <?php echo $maxQuantity; ?>)">
                                            <i class="fa fa-caret-up" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" name="submit" value="<?php echo $object['product_id'] ?>" id="<?php echo $addToChatrid ?>" class="btn amado-btn"><?php echo $addToCart ?></button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        
<?php include('../../layouts/footer.php'); ?>