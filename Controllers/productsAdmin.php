<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Title  -->
    <title>Amado - Furniture Ecommerce Template | Home</title>

    <!-- Favicon  -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="../css/core-style.css">
    <link rel="stylesheet" href="../css/core-style2.css">
    <link rel="stylesheet" href="style.css">

    <style>
        .widget .catagories-menu li input[type ='submit']  {
            font-weight: 400;
            border: none;
            background: none;
            padding: 0;
            margin: 0;
            font-family: inherit;
            cursor: pointer;
            color: #959595; 
            text-decoration: none; /* Underline like a link */
        }

        .widget .catagories-menu li input[type ='submit']:hover, .widget .catagories-menu li input[type ='submit']:focus {
        color: #fbb710; }
        
        .widget .catagories-menu li input[type ='submit']:visited {
        color: #fbb710; }
    </style>

</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="adminHome.php"><img src="../img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="adminHome.php"><img src="../img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li ><a href="adminHome.php">Users</a></li>       
                    <li class="active"><a href="productsAdmin.php">Products</a></li>
                    <li><a href="#">Orders</a></li>
                </ul>
            </nav> <br /><br />

            <!-- Social Button -->
            <div class="social-info d-flex justify-content-between">
                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            </div>
        </header>
        <!-- Header Area End -->

        <div class="shop_sidebar_area">

            <div class="widget catagory mb-50">

                <h6 class="widget-title mb-30">Sections</h6>


                <div class="catagories-menu">
                    <ul>
                        <form action="adminHome.php" method="post">
                            <li class="active"><a><input type="submit" name="customers" value="Customers"></a></li>
                            <li ><a><input type="submit" name="admins" value="Admins"></a></li>
                        </form>

                    </ul>
                </div>
            </div>
        </div>

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">

                <div class="table">
                    <table>
                        <tr>
                            <th id="select">Select</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Password</th>
                            <th>Phone</th>
                            <th>Date_Add</th>
                            <th>Options</th>
                        </tr>

                    <form action="deleteManyUsers.php?user_type_id=<?php echo id(); ?>" method="post">

                        <?php
                            include('usersClass.php');

                            $student = new User();

                            if( isset($_POST['admins']) || isset($_GET['addAdmin']))
                            {
                                echo $student->getUsers(2); 
                                $submitName  = 'addAdmin';
                                $submitValue = 'Add Admin';
                                $id          = 2;
                            }else{
                                echo $student->getUsers(1);   
                                $submitName  = 'addCustomer';
                                $submitValue = 'Add Customer';
                                $id          = 1;
                            }

                        ?>

                    </table>

                </div>  

                        <input type="submit" name="deleteAllSubmit" id="deleteAll" class="deleteAll" value="Delete">

                    </form>
                    <form action="../signUp.php" method="post">
                        <input type="submit" class="add" name="<?php echo $submitName ?>" value="<?php echo $submitValue ?>">
                    </form>
            </div>
        </div>

    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
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
                            <a href="adminHome.php"><img src="../img/core-img/logo2.png" alt=""></a>
                        </div>
                        <!-- Copywrite Text -->
                        <p class="copywrite"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> & Re-distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
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
                                        <li class="nav-item active">
                                            <a class="nav-link" href="adminHome.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="shop.php">Shop</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="product-details.php">Product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="cart.php">Cart</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="checkout.php">Checkout</a>
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
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

    <script>
          $(document).ready(function() {
              $(".myCheckbox").change(function() {
                  if ($(".myCheckbox:checked").length > 0) {
                    $("#deleteAll").show(); 
                  } else {
                    $("#deleteAll").hide();
                  }
              });

              $('#select').click( function(){
                  $('.myCheckbox').prop("checked", function(i, val) {
                    return !val;
              });
              
              if ($(".myCheckbox:checked").length > 0) {
                $("#deleteAll").show(); 
              } else {
                $("#deleteAll").hide();
              }
                } );            
          });
        </script>

</body>

</html>