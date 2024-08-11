
<header class="header-area clearfix">

    <div class="nav-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>

    <div class="logo">
        <a href="home.php"><img src="../../../../public/customer/img/core-img/logo.png" alt=""></a>
    </div>
    <!-- Amado Nav -->
    <nav class="amado-nav">
        <ul>
            <li class="<?php if(isset($home)){ echo $home; } ?>"><a href="../Home/home.php">Home</a></li>
            <li class="<?php if(isset($shop)){ echo $shop; } ?>"><a href="../Shop/shop.php?section=<?php echo $firstSection ?>">Shop</a></li>
            <li class="<?php if(isset($cart)){ echo $cart; } ?>"><a href="../Cart/cart.php">Cart</a></li>
            <li class="<?php if(isset($orders)){ echo $orders; } ?>"><a href="../Cart/orders.php">Orders</a></li>
            <li class="<?php if(isset($checkout)){ echo $checkout; } ?>"><a href="../Checkout/checkout.php">Checkout</a></li>
        </ul>
    </nav>
    <!-- Button Group -->
    <div class="amado-btn-group mt-30 mb-100">
        <a href="#" class="btn amado-btn mb-15">%Discount%</a>
        <a href="#" class="btn amado-btn active">New this week</a>
    </div>
    <!-- Cart Menu -->
    <div class="cart-fav-search mb-100">
        <a href="../Cart/cart.php" class="cart-nav"><img src="../../../../public/customer/img/core-img/cart.png" alt=""> Cart <span>(0)</span></a>
        <a href="#" class="fav-nav"><img src="../../../../public/customer/img/core-img/favorites.png" alt=""> Favourite</a>
        <a href="#" class="search-nav"><img src="../../../../public/customer/img/core-img/search.png" alt=""> Search</a>
    </div>
    <!-- Social Button -->
    <div class="social-info d-flex justify-content-between">
        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
    </div>


</header>