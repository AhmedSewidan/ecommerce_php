<?php
  $activeOpenCat = 'active open';
  include("../../layouts/header.php");

  function section_id(){
      if(isset($_GET['section'])){
          return $_GET['section'];
      }else{
          return null;
      }
  }
  $object = $product->getSectionById($_GET['section']);
?>


<h4 class="py-3 mb-4">Section</h4>

<div class="card">

  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0"><?php echo $object["section_name"]; ?> Table</h5>
    <strong class="text-muted float-end">
      <a style="color: red;margin-right:10px;" href="../../../../Controllers/deleteSection.php?section=<?php echo section_id(); ?>"
      onclick="return confirm('Are you sure you want to delete this order?');">
        &#128465; Delete
      </a>
      <a href="../Forms/EditSection.php?section=<?php echo section_id(); ?>" style="color:#27e727;" >
        <li class="bx bx-edit-alt me-1"></li>Edit
      </a>
    </strong>
  </div>
  <div class="table-responsive text-nowrap">
    <form action="../../../../Controllers/deleteProducts.php?section=<?php echo section_id() ?>" method="post">
        <table class="table">
          <thead>
            <tr>
              <th id="select">Select</th>
              <th>Photo</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Status</th>
              <th>Created</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
          
            <?php echo $product->getProducts(section_id()); ?>

          </tbody>
        </table><br>
        <div class="col-sm-10" id="col-sm-10">
          <input type="submit" name="deleteAll" id="deleteAll" class="deleteAll" value="Delete">
          <a href="../Forms/AddProduct.php?section=<?php echo section_id() ?>" id="add" class="btn btn-primary"><strong>+</strong> Add Product</a>
        </div>
      </form>
      <div class="buy-now">
        <a href="../Forms/AddSection.php?section=<?php echo $_GET['section'] ?>" class="btn btn-danger btn-buy-now"><strong>+</strong> Add Section</a>
      </div>
  </div>
</div>
<!--/ Basic Bootstrap Table -->

<?php include("../../layouts/footer.php"); ?>