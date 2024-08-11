<?php 
include("../../layouts/header.php"); 

$userObj     = $user->getUserById($_GET['id']);
$name        = $userObj['username'];
$parts = explode(" ", $name);
$firstName = $parts[0];
?>

<h4 class="py-3 mb-4">Users</h4>
<div class="card">
  <h5 class="card-header"><?php echo $firstName ?> Comments</h5>
  <div class="table-responsive text-nowrap">
    <form action="../../../../Controllers/deleteManyUsers.php?user_type_id=1" method="post">
      <table class="table">
        <thead>
          <tr>
            <th id="select">Select</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Comment</th>
            <th>Date_Add</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

        <?php 
            echo $user->getCustomerComments($_GET['id']) 
        ?>

        </tbody>
      </table><br>
      <div class="col-sm-10" id="col-sm-10">
        <input type="submit" name="deleteAll" id="deleteAll" class="deleteAll" value="Delete">
      </div>
    </form>
    <div class="buy-now">
        <a href="#" class="btn btn-danger btn-buy-now"><strong>+</strong> Add General Comment</a>
      </div>
  </div>
</div>

<?php include("../../layouts/footer.php"); ?>