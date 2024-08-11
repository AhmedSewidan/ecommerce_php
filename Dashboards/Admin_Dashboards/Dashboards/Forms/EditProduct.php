<?php 

include("../../layouts/header.php");

$id           = $_GET['id'];
$object       = $product->getProductById( $id );
$section      = $object['section_id'];
$product_name = $object['product_name'];
$price        = $object['price'];
$quantity     = $object['quantity'];

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
          <form action="../../../../Controllers/editProduct.php?section=<?php echo $section ?>&id=<?php echo $id ?>" 
                method="post" enctype="multipart/form-data">        
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Product Name</label>
              <div class="col-sm-10">
                <input
                 type="text"
                 name="product"
                 class="form-control" 
                 placeholder="Enter Your Name"
                 id="basic-default-name" 
                 value="<?php if(isset($_SESSION['product'])){ echo $_SESSION['product'];}else{ echo $product_name; } ?>" /> 
                  <?php if(isset($_SESSION['MProduct'])){ echo $_SESSION['MProduct'];} ?>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-company">Price</label>
              <div class="col-sm-10">
                <input
                  type="number"
                  name="price"
                  value="<?php if(isset($_SESSION['price'])){ echo $_SESSION['price'];}else{ echo $price; } ?>"
                  placeholder="Enter Price"
                  class="form-control"
                  id="basic-default-company" /> 
                  <?php if(isset($_SESSION['MPrice'])){ echo $_SESSION['MPrice'];} ?>
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-phone">Quantity</label>
              <div class="col-sm-10">
                <input
                  type="number"
                  name="quantity"
                  value="<?php if(isset($_SESSION['quantity'])){ echo $_SESSION['quantity'];}else{ echo $quantity; } ?>"
                  placeholder="Enter Quantity"
                  id="basic-default-phone"
                  class="form-control phone-mask"
                  aria-label="658" 
                  aria-describedby="basic-default-phone" /> 
                  <?php if(isset($_SESSION['MQuantity'])){ echo $_SESSION['MQuantity'];} ?>
              </div>
            </div>
            <div class="col-sm-10" id="col-sm-10">
              <input type="file" name="photo" id="file-upload" class="custom-file-input" accept="image/*" onchange="displaySelectedImage(event)">
              <label for="file-upload" class="custom-file-button">Change Image</label>
              <small id="image-container">
                <?php 
                  if(isset($_SESSION['productPhoto'])){
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($_SESSION['productPhoto']) . '"
                    style="width: 40px; height: 40px; border-radius: 50%;" />';
                  }else{
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($product->getPhoto($object['product_id'])) . '" 
                    style="width: 50px; height: 50px; border-radius: 50%;" />'; 
                  }
                ?>
              </small>

              <a href="../sections/Section.php?section=<?php echo $section ?>" class="btn btn-primary">Table</a>
              <button type="submit" name="edit" class="btn btn-primary">Send</button>
              <a href="../../../../Controllers/deleteProduct.php?<?php echo "id={$_GET['id']}&&section=$section"; ?>" class="delete">Delete</a>
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
unset($_SESSION['MProduct'], $_SESSION['MPrice'], $_SESSION['MQuantity'], $_SESSION['message'], 
      $_SESSION['product'], $_SESSION['price'], $_SESSION['quantity'], $_SESSION['productPhoto']);
include("../../layouts/footer.php");
?>