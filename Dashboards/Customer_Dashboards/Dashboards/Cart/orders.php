<?php 
$orders = 'active';
include('../../layouts/header.php'); 
include('../../layouts/userProfile.php');
function MOrderd(){
    if(isset($_SESSION['MOrderd'])) {
        echo "<div class=\"MOrderd\">{$_SESSION['MOrderd']}</div>";
        echo "<script>setTimeout(function(){document.querySelector('.MOrderd').style.opacity = 0; setTimeout(function(){";
        echo "document.querySelector('.MOrderd').style.display = 'none'; ";
        echo "}, 1000); }, 7000);";
        echo "setTimeout(function(){";
        echo "  ".json_encode($_SESSION['MOrderd']);
        echo "}, 5000);</script>";
    }
}
?>
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <!-- <div class="row"> -->
            <div class="col-12 col-lg-8" id="col-12">
                <div class="cart-title mt-50">
                    <h2>Orders</h2>
                </div>
                    <?php 
                        MOrderd(); 
                        echo $product->getOrdersSent($customerId);
                    ?>
            </div>
        <!-- </div> -->
    </div>
</div>    


        
<?php include('../../layouts/footer.php'); unset($_SESSION['MOrderd']); ?>