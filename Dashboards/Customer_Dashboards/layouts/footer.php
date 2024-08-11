    </div>
    <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <!-- Newsletter Text -->
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
                    </div>
                </div>
                <!-- Newsletter Form -->
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                        <form action="#" method="post">
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ##### Newsletter Area End ##### -->
    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="home.php"><img src="../../../../public/customer/img/core-img/logo2.png" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                          Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                          All rights reserved | This template is made with 
                          <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            & Re-distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a>
                          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li  class="nav-item <?php if(isset($home)){ echo $home; } ?>">
                                            <a class="nav-link" href="../Home/home.php">Home</a>
                                        </li>
                                        <li  class="nav-item <?php if(isset($shop)){ echo $shop; } ?>">
                                            <a class="nav-link" href="../Shop/shop.php?section=<?php echo $firstSection ?>">Shop</a>
                                        </li>
                                        <li  class="nav-item <?php if(isset($cart)){ echo $cart; } ?>">
                                            <a class="nav-link" href="../Cart/cart.php">Cart</a>
                                        </li>
                                        <li  class="nav-item <?php if(isset($checkout)){ echo $checkout; } ?>">
                                            <a class="nav-link" href="../Checkout/checkout.php">Checkout</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="../../../../public/customer/js/jquery/jquery-2.2.4.min.js"></script>
    <script src="../../../../public/customer/js/popper.min.js"></script>
    <script src="../../../../public/customer/js/bootstrap.min.js"></script>
    <script src="../../../../public/customer/js/plugins.js"></script>
    <script src="../../../../public/customer/js/active.js"></script>
    <script src="../../../../public/customer/js/javascript.js"></script>
    <script>
        if(document.getElementById('viewProduct')){
            view = document.getElementById('viewProduct');

            view.addEventListener('change', function() {

                if(document.getElementById('myForm')){
                    var form = document.getElementById('myForm');
                }
            // Get the form element
            // Update the form action with the selected value
            // Submit the form
            form.submit();
        });

        <?php 
        if(isset($_GET['select'])){ ?>
            view.value = <?php echo $_GET['select'] ?>;
        <?php } ?>
        }

    </script>

  </body>

</html>