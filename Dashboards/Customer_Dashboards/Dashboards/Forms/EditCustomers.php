<?php 
include('../../layouts/header.php'); 
include('../../layouts/userProfile.php');
?>

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8" id="settings">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Settings</h2>
                            </div>

                            <form action="../../../../Controllers/Customers/editCustomer.php?id=<?php echo $customerId ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label>Username</label>
                                        <input 
                                            type="text" 
                                            name="username" 
                                            class="form-control" 
                                            id="company"
                                            value="<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}else{ echo $customer['username'];} ?>" /> 

                                        <?php if(isset($_SESSION['MUsername'])){ echo $_SESSION['MUsername'];} ?>
                                    </div>
                                    <div class="col-12 mb-3" id="passInput">
                                        <label class="passLabel">Password</label>
                                        <div class="eye-container">
                                            <input
                                            type="password"
                                            name="password"
                                            id="password" 
                                            class="form-control pass"
                                            value="<?php if(isset($_SESSION['password'])){echo $_SESSION['password'];}else{ echo $customer['user_pass'];} ?>"
                                            />
                                        </div>
                                        <span class="eye" onclick="togglePasswordVisibility();">&#x1F441;</span>
                                        <?php if(isset($_SESSION['MPassword'])){ echo $_SESSION['MPassword'];} ?>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label>Phone</label>
                                        <input
                                            type="text"
                                            name="phone"
                                            id="basic-default-phone"
                                            class="form-control phone-mask"
                                            aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone"
                                            value="<?php if(isset($_SESSION['phone'])){echo $_SESSION['phone'];}else{ echo $customer['phone_number'];} ?>" /> 
                                            <?php if(isset($_SESSION['MPhone'])){ echo $_SESSION['MPhone'];} ?>
                                    </div>

                                    <div class="col-2 mb-3">
                                        <label for="file-upload" id="custom-file-button" class="btn amado-btn mb-15">Change Image</label>
                                        <span id="image-container"> <?php getImge(); ?></span>
                                        <input type="file" name="photo" id="file-upload" class="custom-file-input" accept="image/*" onchange="displaySelectedImage(event)">
                                    </div>
                                    <div class="col-3 mb-3">
                                        <button type="submit" name="edit" id="editSubmit" class="btn amado-btn w-100">Send</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>    


        
<?php include('../../layouts/footer.php'); unset($_SESSION['MUsername'], $_SESSION['MPhone'], $_SESSION['MPassword'], 
                        $_SESSION['username'], $_SESSION['phone'], $_SESSION['password'], $_SESSION['userPhoto']); ?>   