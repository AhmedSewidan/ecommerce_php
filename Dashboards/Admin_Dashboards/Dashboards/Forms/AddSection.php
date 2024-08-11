<?php 
include("../../layouts/header.php");
if(isset($_GET['section'])){
    $link    = "../sections/Section.php?section={$_GET['section']}";
    $section = $_GET['section'];
}else{
    $link    = "../sections/Section.php?section=$randomId";
    $section = null;
}
?>

<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">Add Section</h5>
          <small class="text-muted float-end">Default label</small>
        </div>
        <div class="card-body">
          <!-- Form -->
          <form action="../../../../Controllers/addSection.php?section=<?php echo $section ?>" 
                method="post" enctype="multipart/form-data">        
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Section Name</label>
              <div class="col-sm-10">
                <input
                 type="text"
                 name="section"
                 class="form-control" 
                 placeholder="Enter Section Name"
                 id="basic-default-name" /> 
                 <?php if(isset($_SESSION['MName'])){ echo $_SESSION['MName'];} ?>
              </div>
            </div>
            <div class="col-sm-10" id="col-sm-10">
              <input type="file" name="photo" id="file-upload" class="custom-file-input" accept="image/*" onchange="displaySelectedImage(event)">
              <label for="file-upload" class="custom-file-button">Change Image</label>
              <small id="image-container"></small>
              <a href="<?php echo $link ?>" class="btn btn-primary">Table</a>
              <button type="submit" name="add" class="btn btn-primary">Add</button>
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
unset($_SESSION['MName'], $_SESSION['message']);
include("../../layouts/footer.php");
?>