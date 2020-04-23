<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../AdminTemplate/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../AdminTemplate/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../AdminTemplate/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../AdminTemplate/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminTemplate/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../AdminTemplate/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../AdminTemplate/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../AdminTemplate/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .a{
      color:white;
    }
    .ic{
      color: turquoise;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link a" data-widget="pushmenu" href="#" style="color:white;"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../Staff pages/Staff_Login.php" class="nav-link a"style="color:white;">Login</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

      <i class="fas fa-cocktail" style="color:turquoise;font-size:25px;"></i>
      <span class="brand-text font-weight-light" style = "color:white;font-size:20px;"> November</span>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 ">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php if(isset($_SESSION['StaffID'])):?>
          <li class="nav-item has-treeview menu-open">
        <a  class="nav-link">
          <img src="<?php echo $_SESSION['StaffImage'] ?>" style = "height:50px;width:50px;border-radius:100%;" class = "img-fluid ">
            <span class="brand-text font-weight-light"> <?php echo $_SESSION['StaffName'] ?></span>
        </a>

          </li>
          <li class="nav-item has-treeview menu-open">
        <a  class="nav-link">

            <span class="brand-text font-weight-light">Role : <?php echo $_SESSION['StaffType'] ?></span>
        </a>

          </li>
        <?php else:?>
        <li class="nav-item has-treeview menu-open">
      <a  class="nav-link">

          <span class="brand-text font-weight-light">Staff Name</span>
      </a>

        </li>
      <?php endif ?>
        </ul>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
        <a  class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p style="color:white;" >
            Dashboard
          </p>
        </a>

          </li>
          <?php if(isset($_SESSION['StaffType'])): ?>
          <?php if ($_SESSION['StaffType'] == 'Manager' || $_SESSION['StaffType'] == 'Delivery' ) : ?>
            <li class="nav-item">
              <a href="../Delivery pages/Delivery_List.php" class="nav-link">
                <i class="fas fa-truck ic nav-icon"> </i>
                <p>
                  Delivery List
                </p>
              </a>
            </li>

          <?php endif; ?>
          <?php if ($_SESSION['StaffType'] == 'Manager') : ?>

            <li class="nav-item">
              <a href="../Customer pages/Customer_List.php" class="nav-link">
                <i class="fas fa-users ic nav-icon"></i>
                <p>
                  Customers List
                </p>
              </a>
            </li>
          <?php endif; ?>
          <?php if ($_SESSION['StaffType'] == 'Manager' || $_SESSION['StaffType'] == 'Barista' || $_SESSION['StaffType'] == 'Chef'|| $_SESSION['StaffType'] == 'Bartender') : ?>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-glass-martini-alt ic nav-icon"></i>
                <p>
                  Menu
                  <i class="fas fa-angle-left right ic"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../Menu pages/Menu_List.php" class="nav-link">
                    <i class="fas fa-clipboard-list ic nav-icon"></i>
                    <p>Menu List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../Menu pages/Menu_Registration.php" class="nav-link">
                    <i class="far fa-plus-square ic nav-icon"></i>
                    <p>Menu Registration</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="" class="nav-link">
                <i class="fas fa-shopping-basket ic nav-icon"></i>
                <p>
                  Purchase
                  <i class="right fas fa-angle-left ic"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../Purchase pages/Purchase_List.php" class="nav-link">
                    <i class="fas fa-clipboard-list ic nav-icon"></i>
                    <p>Purchase List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../Purchase pages/Purchase_Order.php" class="nav-link">
                    <i class="far fa-plus-square ic nav-icon"></i>
                    <p>Purchase Order</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tree ic nav-icon"></i>
                <p>
                  Raw Material
                  <i class="fas fa-angle-left right ic"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../Raw pages/Raw_List.php" class="nav-link">
                    <i class="nav-icon fas fa-clipboard-list ic nav-icon"></i>
                    <p>Material List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../Raw pages/Raw_Registration.php" class="nav-link">
                    <i class="far fa-plus-square ic nav-icon"></i>
                    <p>Material Registration</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; ?>
          <?php if ($_SESSION['StaffType'] == 'Manager') : ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-user-tie ic nav-icon"></i>
                <p>
                  Staff
                  <i class="fas fa-angle-left right ic"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../Staff pages/Staff_List.php" class="nav-link">
                    <i class="fas fa-clipboard-list ic nav-icon"></i>
                    <p>Staff List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../Staff pages/Staff_Registration.php" class="nav-link">
                    <i class="far fa-plus-square ic nav-icon"></i>
                    <p>Staff Registration</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-truck-loading ic nav-icon"></i>
                <p>
                  Supplier
                  <i class="fas fa-angle-left right ic"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../Supplier pages/Supplier_List.php" class="nav-link">
                    <i class="fas fa-clipboard-list ic nav-icon"></i>
                    <p>Supplier List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../Supplier pages/Supplier_Registration.php" class="nav-link">
                    <i class="far fa-plus-square ic nav-icon"></i>
                    <p>Supplier Registration</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; ?>
          <li class="nav-item has-treeview">
            <a href="../Staff pages/Staff_Logout.php" class="nav-link" style="background-color:rgba(240, 52, 52, 1);">
              <i class="fas fa-sign-out-alt nav-icon " style="color:white;"></i>
              <p  style="color:white;">

                Log Out
              </p>
            </a>

          </li>
        <?php endif ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



<!-- jQuery -->
<script src="../AdminTemplate/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../AdminTemplate/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../AdminTemplate/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../AdminTemplate/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../AdminTemplate/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../AdminTemplate/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../AdminTemplate/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../AdminTemplate/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../AdminTemplate/plugins/moment/moment.min.js"></script>
<script src="../AdminTemplate/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../AdminTemplate/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../AdminTemplate/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../AdminTemplate/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../AdminTemplate/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../AdminTemplate/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../AdminTemplate/dist/js/demo.js"></script>
</body>
</html>
