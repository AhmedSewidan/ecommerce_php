<head>
    <link rel="stylesheet" href="../../../../public/customer/css/core-style.css">
</head>


<div class="layout-page">

    <ul>
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <div class="avatar avatar-online">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <h6> <?php if(isset($customer)){ echo $customer['username']; }else{echo 'User';} ?></h6>
                    <?php getImge(); ?>
                </a>
            </div>
            <div id="modal-overlay">
                <div id="modal-content">
                    <span id="close-modal">&times;</span>
                    <img id="modal-image" src="data:image/jpeg;base64,<?php echo $base_encode ?>">
                </div>
            </div>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                        <?php getImge("photo"); ?>
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-medium d-block"><?php if(isset($customer)){ echo $customer['username']; }else{echo 'User';} ?></span>
                        <small class="text-muted">Customer</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li class="login">
                    <a class="dropdown-item" href="<?php if(isset($customer)){ echo '../Forms/EditCustomers.php?id=' .$customerId; }else{echo '#';} ?>">
                        <p style="margin-left: 2px; font-size: 15px;">&#9881;</p>
                        <span class="align-middle">Settings</span>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li class="login">
                    <a class="dropdown-item" href="../../../login/customerLogin.php">
                        <p style="margin-left: 2px;">&#127939;</p>
                        <span class="align-middle">Log Out</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<a href="../Forms/message.php" target="_self" class="messages">&#x2709;</a>