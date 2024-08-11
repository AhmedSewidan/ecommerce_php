<?php 
$home = 'active';
include('../../layouts/header.php'); 

if( isset($_SESSION['MLogin']) ){
    echo $_SESSION['MLogin'];
}
?>


    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">
            <!-- Single Catagory -->


            <?php 
            echo $product->getProductsAtHome(); 
            ?>

        </div>
    </div>


        
<?php include('../../layouts/footer.php'); ?>

