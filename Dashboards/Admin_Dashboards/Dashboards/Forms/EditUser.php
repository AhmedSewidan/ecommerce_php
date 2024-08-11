<?php 

include("../../layouts/header.php");

$id = $_GET['id'];
$userObject = $user->getUserById( $id );
$userType   = $userObject['user_type_id'];
$name     = $userObject['username'];
$password = $userObject['user_pass'];
$phone    = $userObject['phone_number'];

?>

<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">Basic Layout</h5>
          <small class="text-muted float-end">Default label</small>
        </div>
        <div class="card-body">
          <!-- Form -->
          <form action="../../../../Controllers/postEditUser.php?id=<?php echo $id ?>" 
                method="post" enctype="multipart/form-data">        
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
              <div class="col-sm-10">
                <input type="text" name="username" class="form-control" id="basic-default-name"
                 value="<?php if(isset($_SESSION['username'])){ echo $_SESSION['username'];}else{ echo $name; } ?>" /> 
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
                  class="form-control"
                  id="basic-default-company" 
                  value="<?php if(isset($_SESSION['password'])){ echo $_SESSION['password'];}else{ echo $password; } ?>" /> 
                  <?php if(isset($_SESSION['MPassword'])){ echo $_SESSION['MPassword'];} ?>
              </div>
              <div class="eye" onclick="togglePasswordVisibility();" id="password">
                &#x1F441;
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-phone">phone Number</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  name="phone"
                  id="basic-default-phone"
                  class="form-control phone-mask"
                  aria-label="658 799 8941"
                  aria-describedby="basic-default-phone"
                  value="<?php if(isset($_SESSION['phone'])){ echo $_SESSION['phone'];}else{ echo $phone; } ?>" /> 
                  <?php if(isset($_SESSION['MPhone'])){ echo $_SESSION['MPhone'];} ?>
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-sm-10" id="send">
                <input type="file" name="photo" id="file-upload" class="custom-file-input" accept="image/*" onchange="displaySelectedImage(event)">
                <label for="file-upload" class="custom-file-button">Change Image</label>
                <small id="image-container">
                  <?php
                    if(isset($_SESSION['userPhoto'])){
                      echo '<img src="data:image/jpeg;base64,' . base64_encode($_SESSION['userPhoto']) . '"
                      style="width: 40px; height: 40px; border-radius: 50%;" />';
                    }else{
                      echo '<img src="data:image/jpeg;base64,' . base64_encode($user->getPhoto($userObject['user_id'])) . '"
                      style="width: 40px; height: 40px; border-radius: 50%;" />';
                    }
                  ?>
                </small>
                <button type="submit" name="edit" class="btn btn-primary">Send</button>
                <a href="../../../../Controllers/postDeleteUser.php?id=<?php echo $id ?>" class="delete">Delete</a>
              </div>
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
$_SESSION['username'], $_SESSION['phone'], $_SESSION['password'], $_SESSION['userPhoto']);
include("../../layouts/footer.php"); 
?>