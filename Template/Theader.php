<?php
include('../connect.php');
session_start();
     if(isset($_SESSION['CustomerID']))
    {
    $ID = $_SESSION['CustomerID'];



    $SELECT = "SELECT * FROM customer where customer_Id = '$ID'";
    $query = mysqli_query($connection,$SELECT);
    $res = mysqli_fetch_array($query);
    $img = $res['customer_Image'];
    $name = $res['customer_Name'];
    }
    if(isset($_SESSION['SupplierID']))
   {
   $ID = $_SESSION['SupplierID'];



   $SELECT = "SELECT * FROM supplier where supplier_Id = '$ID'";
   $query = mysqli_query($connection,$SELECT);
   $res = mysqli_fetch_array($query);
   $img = $res['supplier_Image'];
   $name = $res['supplier_Name'];
   }





//on session creation

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS here -->
    <link rel="stylesheet" href="../Template/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../Template/css/owl.carousel.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="../Template/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Template/css/themify-icons.css">
    <link rel="stylesheet" href="../Template/css/nice-select.css">
    <link rel="stylesheet" href="../Template/css/flaticon.css">
    <link rel="stylesheet" href="../Template/css/gijgo.css">
    <link rel="stylesheet" href="../Template/css/animate.css">
    <link rel="stylesheet" href="../Template/css/slicknav.css">
    <link rel="stylesheet" href="../Template/css/style.css">
    <link rel="stylesheet" href="../Template/css/all.min.css">
    <link rel="stylesheet" href="../Template/css/pagecrossfade.css">
    <link rel="stylesheet" href="../Template/css/magnific-popup.css">
    <link rel="shortcut icon" type = "image/png" href="../images/logo.png">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo-img">
                                <a href="../Home page/homie.php">
                                    <h2 style="color:white;" ><i class="fas fa-cocktail" style="color:turquoise;font-size:45px;" class="hi"></i> November</h2>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                      <li><a id="home" href="../Home page/homie.php" class="navown">Home</a></li>
                                        <?php if(isset($_SESSION['CustomerID'])): ?>
                                          <li><a id="home" href="../Order pages/menu.php" class="navown">Menu</a></li>
                                        <li><a id="shop" href="../Order pages/Order_List.php" class="navown"> Order List</a></li>
                                      <?php endif ?>
                                      <?php if(isset($_SESSION['SupplierID'])): ?>
                                      <li><a id="shop" href="../Supplier pages/PurchaseOrder_List.php" class="navown"> Purchase Order List</a></li>
                                    <?php endif ?>
                                        <li><a id="faq" href="../Home page/about.php" class="navown">About</a></li>
                                        <li><a id="" href="../Home page/help.php" class="navown">Help</a></li>
                                        <?php
                                        if (isset($_SESSION['CustomerID'])) {
                                            echo "<li><a style = 'cursor:pointer;'>Functions <i class='ti-angle-down'></i></a>
                                                <ul class='submenu'>
                                                    <li><a href='../Customer pages/Customer_Update.php'class = 'navown'> Update account information</a></li>
                                                    <li><a href='../Customer pages/Customer_Logout.php'class = 'navown'>Logout</a></li>";
                                        }
                                        if (isset($_SESSION['SupplierID'])) {
                                            echo "<li><a style = 'cursor:pointer;'>Functions <i class='ti-angle-down'></i></a>
                                                <ul class='submenu'>

                                                    <li><a href='../Customer pages/Customer_Logout.php'class = 'navown'>Logout</a></li>";
                                        }
                                        ?>

                                    </ul>
                                    </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="log_chat_area d-flex align-items-center">
                                <?php
                                 if (isset($_SESSION['CustomerID'])) {
                                    echo "
                                        <div  class=' dropdown-toggle  login' id='dropdownMenuLink' data-toggle='dropdown' style = 'cursor:pointer;'>
                                        <img src='../Customer images/$img' style = 'width:50px;height:50px;border-radius:100%;border:2px solid white;' >
                                        </div>
                                        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                        <a class='dropdown-item' href='../Customer pages/Customer_Update.php'><i class='far fa-address-card'></i> Update account information</a>
                                        <div class='dropdown-divider'></div>
                                        <a class='dropdown-item' href='../Customer pages/Customer_Logout.php'><i class='fas fa-sign-out-alt'></i> Logout</a>
                                        </div> ";

                                } elseif(isset($_SESSION['SupplierID']))
                                {
                                  echo "
                                      <div  class=' dropdown-toggle  login' id='dropdownMenuLink' data-toggle='dropdown' style = 'cursor:pointer;'>
                                      <img src='../Supplier images/$img' style = 'width:50px;height:50px;border-radius:100%;border:2px solid white;' >
                                      </div>
                                      <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>

                                      <div class='dropdown-divider'></div>
                                      <a class='dropdown-item' href='../Customer pages/Customer_Logout.php'><i class='fas fa-sign-out-alt'></i> Logout</a>
                                      </div> ";
                                }
                                 else {
                                    echo '<a href="../Customer pages/Customer_Login.php" class="login ">
                                        <i class="flaticon-user"></i>
                                        <span style = "color:white;">log in</span>
                                    </a>';
                                 }
                                ?>


                                <div class="live_chat_btn">
                                    <a class="boxed_btn_green" href="../Order pages/Shopping_Cart.php">
                                        <i class='fas fa-shopping-cart'></i>
                                        Shopping Cart
                                        <?php if(isset($_SESSION['Cart'])):
                                          $count = count($_SESSION['Cart']);?>
                                          (<?php echo $count; ?>)
                                        <?php endif ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->


</body>

</html>
