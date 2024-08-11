<?php 
$shop = 'active';

include('../../layouts/header.php');


include('../../layouts/shopMenu.php'); 
$actionForm = "../../../../Controllers/Customers/view-request.php?section=$section";
if( isset($_GET['section']) ){
    $section = $_GET['section'];   
}else{
    $section = $ranSectionId;
}                 

$sort = "Random";
if(isset($_SESSION['sort-by'])){
    $sort = $_SESSION['sort-by'];
}

$view = 6;
if(isset($_SESSION['view'])){
    $view = $_SESSION['view'];
}

if(isset($_SESSION['show'])){
    $show = $_SESSION['show'];
}else{
    $show = "Squars";
}

$table1 = '';
$table2 = '';
$activeLink2 = '';
$activeLink1 = '';
if( $show === "Columns" ){
    $table1 = "<table class=\"tableShop\">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Add</th>
                    </tr>
                </thead>
               <tbody>";
    $table2 = "</tbody></table>";
    $activeLink2 = "activeLink"; 
}else{
    $activeLink1 = "activeLink"; 
}

$products = $product->getShopProducts( $section, $view, $sort, $min, $max , $show);

?>

<?php 
include('../../layouts/userProfile.php');
?>
        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                            <!-- Total Products -->
                            <div class="total-products"><br>
                                <div class="view d-flex">
                                    <a class="<?php echo $activeLink1 ?>" href="<?php echo $actionForm ?>&show=Squars"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                                    <a class="<?php echo $activeLink2 ?>" href="<?php echo $actionForm ?>&show=Columns"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <!-- Sorting -->
                            <div class="product-sorting d-flex">
                                <div class="sort-by-date d-flex align-items-center mr-15">
                                    <p>Sort by</p>
                                    <form id="myForm" action="<?php echo $actionForm ?>" method="post">
                                        <div class="nice-select">
                                            <span class="current" ><?php echo $sort ?></span>
                                            <ul class="list" id="sort">
                                                <input type="submit" class="simple" name="sort-by" value="Random">
                                                <input type="submit" class="simple" name="sort-by" value="Date" id="simple" >
                                                <input type="submit" class="simple" name="sort-by" value="Name" id="simple" >
                                                <input type="submit" class="simple" name="sort-by" value="Price" id="simple" >
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                                <div class="view-product d-flex align-items-center">
                                    <p>View</p>

                                    <form id="myForm" action="<?php echo $actionForm ?>" method="post">
                                        <div class="nice-select">
                                            <span class="current" ><?php echo $view ?></span>
                                            <ul class="list" id="view">
                                                <input type="submit" class="simple" name="view" value="2">
                                                <input type="submit" class="simple" name="view" value="4" id="simple">
                                                <input type="submit" class="simple" name="view" value="6" id="simple">
                                                <input type="submit" class="simple" name="view" value="8" id="simple">
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php echo $table1 . $products . $table2; ?>

                </div>

                <div class="row">
                    <div class="col-12">
                        <!-- Pagination -->
                        <nav aria-label="navigation">
                            <ul class="pagination justify-content-end mt-50">
                                <li class="page-item active"><a class="page-link" href="shop.php?section=<?php echo $section ?>">01.</a></li>
                                <li class="page-item"><a class="page-link" href="shop.php?section=<?php echo $section ?>">02.</a></li>
                                <li class="page-item"><a class="page-link" href="shop.php?section=<?php echo $section ?>">03.</a></li>
                                <li class="page-item"><a class="page-link" href="shop.php?section=<?php echo $section ?>">04.</a></li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>

        
<?php 
include('../../layouts/footer.php'); 
?>