
<?php 
$checkout = 'active';
include('../../layouts/header.php'); 
include('../../layouts/userProfile.php');

function country(){
    if(isset($_SESSION['country'])){
        $country = $_SESSION['country'];
        echo "<option value=\"$country\">$country</option>";
    }
}

function city(){
    if(isset($_SESSION['city'])){
        $city = $_SESSION['city'];
        echo "<option value=\"$city\">$city</option>";
    }
}

$delivary = 'checked';
$paypal = '';
if(isset($_SESSION['pay'])){
    if( $_SESSION['pay'] === "delivary"){
        $delivary = 'checked';
    }elseif( $_SESSION['pay'] === "paypal"){
        $paypal = 'checked';
    }
}
?>

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <form action="../../../../Controllers/Customers/checkout-request.php" method="post">

                    <div class="row">

                        <div class="col-12 col-lg-8">
                            <div class="checkout_details_area mt-50 clearfix">
                                
                                <div class="cart-title">
                                    <h2>Checkout</h2>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="first_name" class="form-control" id="first_name" 
                                        value="<?php if(isset($_SESSION['first_name'])){echo $_SESSION['first_name'];}?>" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="last_name" class="form-control" id="last_name" 
                                        value="<?php if(isset($_SESSION['last_name'])){echo $_SESSION['last_name'];} ?>" placeholder="Last Name">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="number" name="phone_number" class="form-control" id="phone_number" min="0" placeholder="Another Phone" 
                                        value="<?php if(isset($_SESSION['phone_number'])){echo $_SESSION['phone_number'];}?>">
                                        <?php if(isset($_SESSION['MPhone'])){echo $_SESSION['MPhone'];}?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <select name="country" class="w-100" id="country">
                                            <?php country(); ?>
                                            <option value="Egypt">Egypt</option>
                                            <option value="United States">United States</option>
                                            <option value="Germany">Germany</option>
                                            <option value="France">France</option>
                                            <option value="India">India</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Canada">Canada</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <select name="city" class="w-100" id="city">
                                            <?php city(); ?>
                                            <option value="Cairo">Cairo</option>
                                            <option value="Alex">Alex</option>
                                            <option value="Mansora">Mansora</option>
                                            <option value="Samanoud">Samanoud</option>
                                            <option value="India">India</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" name="address" class="form-control mb-3" id="street_address" placeholder="Address" 
                                        value="<?php if(isset($_SESSION['address'])){echo $_SESSION['address'];}?>">
                                        <?php if(isset($_SESSION['MAddress'])){echo $_SESSION['MAddress'];}?>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10" maxlength="200" placeholder="Leave a comment about your order">
                                            <?php if(isset($_SESSION['comment'])){echo $_SESSION['comment'];}?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="cart-summary">
                                <h5>Cart Total</h5>
                                <ul class="summary-table">
                                    <input type="hidden" name="total" value="<?php echo $total_amount ?>">
                                    <li><span>Total:</span> <span>$<?php echo $total_amount ?></span></li>
                                    <li><span>delivery:</span> <span>Free</span></li>
                                </ul>
                                <div class="payment-method">
                                    <!-- Cash on delivery -->
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="radio" name="pay" value="delivary" class="custom-control-input" id="cod" <?php echo $delivary ?>>
                                        <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                    </div>
                                    <!-- Paypal -->
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="radio" name="pay" value="paypal" class="custom-control-input" id="paypal" <?php echo $paypal ?>>
                                        <label class="custom-control-label" for="paypal">Paypal <img class="ml-15" src="../../../../public/customer/img/core-img/paypal.png" alt=""></label>
                                    </div>
                                </div>
                                <div class="cart-btn mt-100">
                                    <input type="submit" name="order" class="btn amado-btn w-100" value="Checkout">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>    


        
<?php include('../../layouts/footer.php'); unset($_SESSION['first_name'], $_SESSION['last_name'], $_SESSION['city'], $_SESSION['pay'],
$_SESSION['comment'],$_SESSION['MAddress'], $_SESSION['address'], $_SESSION['MPhone'],$_SESSION['phone_number'], $_SESSION['country']) ?>