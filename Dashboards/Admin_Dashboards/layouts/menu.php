<?php 
  if( !isset($activeOpenUser) ){
    $activeOpen = '';
  }
  if( !isset($activeCusForm) ){
    $activeCusForm = '';
  }
  if( !isset($activeAdminForm) ){
    $activeAdminForm = '';
  } 
  if( !isset($activeOpenCat) ){
    $activeOpen = '';
  }
  if( !isset($activeOpenForm) ){
    $activeOpen = '';
  }  
  if( !isset($activeCus) ){
    $activeCus = '';
  }
  if( !isset($activeAdmin) ){
    $activeAdmin = '';
  }

// test unset session
// unset($_SESSION['admin']);
?>

 
  <ul class="menu-inner py-1">
    <!-- Users -->
    <li class="menu-item <?php echo $activeOpenUser ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Dashboards">Users</div>   
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php echo $activeCus ?>">
          <a
            href="../users/Customers.php"
            class="menu-link">
            <div data-i18n="CRM">Customers</div>
          </a>
        </li>
        <li class="menu-item <?php echo $activeAdmin ?>">
          <a
            href="../users/Admins.php"
            class="menu-link">
            <div data-i18n="CRM">Admins</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item <?php echo $activeOpenCat ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-store"></i>
        <div data-i18n="Dashboards">Categories</div>  <!--Title-->
      </a>
      <ul class="menu-sub">
        <?php
        if( isset($_GET['section']) ){
          foreach( $sectionRecords as $record ){
                          
            echo "<li class=\"menu-item ";
            if( $record['section_id'] == $_GET['section'] ){
                echo "active";
            }
            echo "\">";
            echo "<a
                      href=\"../sections/Section.php?section={$record['section_id']}\"
                      target=\"_self\"
                      class=\"menu-link\">
                      <div data-i18n=\"CRM\">{$record['section_name']}</div>
                    </a>
                  </li>";
          }
        }else{
          foreach( $sectionRecords as $record ){
            echo "<li class=\"menu-item\">
              <a
                href=\"../sections/Section.php?section={$record['section_id']}\"
                target=\"_self\"
                class=\"menu-link\">
                <div data-i18n=\"CRM\">{$record['section_name']}</div>
              </a>
            </li>";
          }
        }
        ?>
      </ul>
    </li>
    <li class="menu-item <?php echo $activeOpenForm ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="Form Elements">Add Users</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php echo $activeCusForm ?>">
          <a href="../Forms/AddUser.php?user_type_id=1" class="menu-link">
            <div data-i18n="Basic Inputs">Customers</div>
          </a>
        </li>
        <li class="menu-item <?php echo $activeAdminForm ?>">
          <a href="../Forms/AddUser.php?user_type_id=2" class="menu-link">
            <div data-i18n="Input groups">Admins</div>
          </a>
        </li>
      </ul>
    </li>
  </ul> 