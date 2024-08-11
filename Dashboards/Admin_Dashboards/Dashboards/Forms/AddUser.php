<?php 
$activeOpenForm = 'active open';
if ( isset($_GET['user_type_id']) ){
  $id = $_GET['user_type_id'];
  if( $id == 1 ){
    $activeCusForm  = 'active';
  }elseif( $id == 2 ){
    $activeAdminForm  = 'active';
  }
}
include("../../layouts/header.php");
if ( isset($_GET['user_type_id']) ){
  $id = $_GET['user_type_id'];
  if( $id == 1 ){
    $page     = 'Customers.php';
    $formName = 'Add Customers';
  }elseif( $id == 2 ){
    $page     = 'Admins.php';
    $formName = 'Add Admins';
  }
}
?>

<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0"><?php echo $formName ?></h5>
          <small class="text-muted float-end">Default label</small>
        </div>
        <div class="card-body">
          <!-- Form -->
          <form action="../../../../Controllers/addUsers.php?user_type_id=<?php echo $id ?>" method="post" enctype="multipart/form-data">        
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
              <div class="col-sm-10">
                <input
                 type="text"
                 name="username"
                 class="form-control" 
                 placeholder="Enter Your Name"
                 id="basic-default-name" 
                 value="<?php if(isset($_SESSION['username'])){ echo $_SESSION['username'];} ?>" /> 
                  <?php if(isset($_SESSION['MUsername'])){ echo $_SESSION['MUsername'];} ?>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-company">Password</label>
              <div class="col-sm-10">
                <input
                  type="password"
                  name="password"
                  id="password"
                  value="<?php if(isset($_SESSION['password'])){ echo $_SESSION['password'];} ?>"
                  placeholder="Enter Your Password"
                  class="form-control"
                  id="basic-default-company" /> 
                  <?php if(isset($_SESSION['MPassword'])){ echo $_SESSION['MPassword'];} ?>
              </div>
              <div class="eye" onclick="togglePasswordVisibility();" style="position: absolute;">
                &#x1F441;
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-phone">phone Number</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  name="phone"
                  value="<?php if(isset($_SESSION['phone'])){ echo $_SESSION['phone'];} ?>"
                  placeholder="Enter Your Number"
                  id="basic-default-phone"
                  class="form-control phone-mask"
                  aria-label="658" 
                  aria-describedby="basic-default-phone" /> 
                  <?php if(isset($_SESSION['MPhone'])){ echo $_SESSION['MPhone'];} ?>
              </div>
            </div>
            <div class="col-sm-10">
              <input type="file" name="photo" id="file-upload" class="custom-file-input" accept="image/*" onchange="displaySelectedImage(event)">
              <label for="file-upload" class="custom-file-button">Choose Image</label>
              <small id="image-container">
                <?php
                  if(isset($_SESSION['userPhoto'])){
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($_SESSION['userPhoto']) . '"
                    style="width: 40px; height: 40px; border-radius: 50%;" />';
                  }else{
                    echo '<img src="../../../../public/customer/img/SimpleProfile.jpg"
                        style="width: 40px; height: 40px; border-radius: 50%;" />';
                  }
                ?>
                <!-- <img src="../../../../public/customer/img/SimpleProfile.jpg"
                        style="width: 40px; height: 40px; border-radius: 50%;" /> -->
              </small>
              <a href="../users/<?php echo $page ?>" class="btn btn-primary">Table</a>
              <button type="submit" name="add" class="btn btn-primary">Send</button>
            </div>
          </form> 
          <?php
            if(isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                echo "<script>setTimeout(function(){document.querySelector('.message').style.opacity = 0; setTimeout(function(){";
                echo "document.querySelector('.message').style.display = 'none'; ";
                echo "}, 1000); }, 5000);";
                echo "setTimeout(function(){";
                echo "  ".json_encode($_SESSION['message']);
                echo "}, 5000);</script>";
            }
          ?>

        </div>
      </div>
    </div>
</div>

<?php
unset($_SESSION['MUsername'], $_SESSION['MPhone'], $_SESSION['MPassword'], $_SESSION['message'], 
      $_SESSION['username'], $_SESSION['phone'], $_SESSION['password'], $_SESSION['userPhoto'] );
include("../../layouts/footer.php");
?>