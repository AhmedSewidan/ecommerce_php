<?php 
$activeOpenUser = 'active open';
$activeCus = 'active';
include("../../layouts/header.php"); 
?>

<h4 class="py-3 mb-4">Users</h4>
<div class="card">
  <h5 class="card-header">Customers Table</h5>
  <div class="table-responsive text-nowrap">
    <form action="../../../../Controllers/deleteManyUsers.php?user_type_id=1" method="post">
      <table class="table">
        <thead>
          <tr>
            <th id="select">Select</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Date_Add</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        
          <?php echo $user->getUsers(1); ?>

        </tbody>
      </table><br>
      <div class="col-sm-10" id="col-sm-10">
        <input type="submit" name="deleteAll" id="deleteAll" class="deleteAll" value="Delete" onclick="return confirm('Are you sure you want to delete these users?');">
        <a href="../Forms/AddUser.php?user_type_id=1" id="add" class="btn btn-primary"><strong>+</strong> Add Customer</a>
      </div>
    </form>
  </div>
</div>
<!--/ Basic Bootstrap Table -->

<?php include("../../layouts/footer.php"); ?>