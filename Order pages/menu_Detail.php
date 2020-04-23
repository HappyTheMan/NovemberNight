<?php
include('../Template/Theader.php');
include('../connect.php');
include('OrderFunction.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu Detail</title>
    <link rel="stylesheet" href="../entry.css">
    <style media="screen">
    .zoom{
      transition: transform .5s ease;

    }
    .zoom:hover{
        transform:scale(1.1);
      }
      span{
        color:black;
      }
    </style>
</head>
<body>

    <?php


    // if (!isset($_SESSION['customer_Id']))
    // {
    //     echo "<script>window.alert('Please Login first to order');</script>";
    //         echo "<script>window.location = 'Customer_Login.php';</script>";
    // }
    // if(isset($_SESSION['customer_Id']))
    //                 {
    //                     $ID = $_SESSION['customer_Id'];
    //                     $select = "SELECT * FROM customer WHERE customer_Id = '$ID'";
    //                     $query = mysqli_query($connection,$select);
    //                     $ret = mysqli_fetch_array($query);
    //
    //                 }

        $IDp = $_REQUEST['menuID'];
        $select = "SELECT * FROM menu where menu_Id = '$IDp'";
        $res = mysqli_query($connection,$select);
        $data = mysqli_fetch_array($res);

        $image = "../Menu images/".$data['menu_Image'];
        $name = $data['menu_Name'];
        $ingredient = $data['Ingredient'];
        $type = $data['menu_Type'];
        $price = $data['menu_Price'];
        $duration = $data['menu_Duration'];





        if (isset($_GET['btnAdd'])) {
          if(!isset($_SESSION['CustomerID']))
          {
            echo "<script>window.alert('Please Login First')</script>";
            echo "<script>window.location = '../Customer pages/Customer_Login.php'</script>";
          }
        	$MenuID = $_GET['txtmenuID'];
        	$size = $_GET['cbosize'];
        	$milk = $_GET['nummilk'];
          $sugar = $_GET['numsugar'];
          $topping = $_GET['cbotopping'];
          $price = $_GET['txtprice'];
          $duration = $_GET['txtduration'];
          $quantity = $_GET['numquantity'];
        	$flag = false;
        	if (isset($_SESSION['Cart'])) {


        		$size = count($_SESSION['Cart']);

        		for ($i = 0; $i < $size; $i++) {
        			if ($MenuID === $_SESSION['Cart'][$i]['MenuID'])
        				$flag = true;
        		}
        	}
        	if ($flag == false) {

        			AddProduct($MenuID, $size, $milk , $sugar,$topping,$price,$duration,$quantity);
              echo "<script>window.location = 'Shopping_Cart.php'</script>";

        	} else {
        		if ($quantity == 0) {
        			echo "<script>window.alert('Please enter correct quantity')</script>";
        			$raw = $MenuID;
        		} else {
        			echo "<script>window.alert('The product already exist there will be no change in price and pricing type. Only quantity will increase!.')</script>";
        			AddProduct($MenuID, $size, $milk , $sugar,$topping,$price,$duration,$quantity);
        		}
        	}
        }


?>

        <!-- bicycle start-->
        <div class="package_prsing_area " style = "padding-top:10%;">
        <div class="container" >

            <div class="row">



                <div class="col-xl-4 col-md-12 col-lg-12">
                    <div class="single_prising">
                        <div class="prising_header"style = "background-color:turquoise;">
                            <h3><?php echo $name; ?></h3>
                        </div>

                        <div class="middle_content" style = "background-color:#212529;">
                            <div class="list">
                                <ul>
                                    <img src="<?php echo $image ?>" height="150px"width="200px"class="img-fluid"style="border-radius:100%;margin:0 0 10% 10%;border:3 ,px solid turquoise;">
                                    <li>duration : <?php echo $duration; ?> min</li>
                                    <li>type : <?php echo $type; ?></li>
                                    <li>price : <?php echo $price; ?>$</li>
                                    <li>Ingredients : <?php echo $ingredient; ?></li>
                                    <li>Status: <?php echo $data['status']?></li>
                                    <?php
                                    // if($ret['customer_Status'] == 'new')
                                    // {
                                    //     $discount = 15;
                                    //     $price -= ($price * 0.15);
                                    //
                                    //     echo "<p class='prise'>Discount Available <span>($discount%)</span></p>";
                                    //     echo "<li>Actual price : $price$ </li>";
                                    // }
                                    // else{
                                    //     $discount = 0;
                                    // }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-md-12 col-lg-12" style = "">


                <form id="test-form"  class="white-popup-block mfp-hide " action="menu_Detail.php" method="get" style="margin-top:8%;top:36%;" enctype="multipart/form-data">
                  <div class="popup_box Ty" style="margin-left:3%;">
                    <div class="popup_inner">
                      <div class="logo text-center">
                        <div class="logo-img">
                          <a href="displays.php">
                            <h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
                          </a>
                        </div>
                      </div>
                      <h3 style="text-align:center;">Customization</h3>
                      <div class="row">
                        <?php if($type != 'food'): ?>

                        <div class="form-row col-xl-12">
                          <div class="form-group col-xl-6 col-md-6">
                             <span>Size</span>
                            <select class="form-control" name="cbosize">
                              <option value="small">Small size</option>
                              <option value="medium">Medium size</option>
                              <option value="large">Large size</option>
                            </select>
                          </div>
                          <div class="form-group col-xl-6 col-md-6">
                            <span>Milk(tea-spoons)</span>
                            <input type="number" value = "0" name="nummilk" class="form-control" required max = "10" min = "0">
                          </div>
                        </div>
                        <div class="form-row col-xl-12">
                          <div class="form-group col-xl-6 col-md-6">
                            <span>Sugar(tea-spoons)</span>
                            <input type="number" value = "0" name="numsugar" class="form-control" required max = "10" min = "0">
                          </div>
                          <div class="form-group col-xl-6 col-md-6">
                            <span>Topping</span>
                           <select class="form-control" name="cbotopping">
                             <option value="none">None</option>
                             <option value="jelly">Jelly</option>
                             <option value="bubble">Bubble</option>
                           </select>
                          </div>
                          <div class="form-group col-xl-12 col-md-12">
                            <span>Quantity</span>
                            <input type="number" value = "1" name="numquantity" class="form-control" required max = "20" min = "1">
                          </div>
                        </div>
                      <?php  else: ?>
                        <div class="form-row col-xl-12">
                          <div class="form-group col-xl-4">
                            <span>No Cheese</span> <input type="checkbox" name="custom" value="No Cheese" style="width:20px;height:20px;margin:0px;">
                          </div>
                          <div class="form-group col-xl-4">
                            <span>No Egg</span> <input type="checkbox" name="custom" value="No Egg" style="width:20px;height:20px;margin:0px;">
                          </div>
                          <div class="form-group col-xl-4">
                            <span>No Meat</span> <input type="checkbox" name="custom" value="No Meat" style="width:20px;height:20px;margin:0px;">
                          </div>
                        </div>
                        <div class="form-group col-xl-12 col-md-12">
                          <span>Quantity</span>
                          <input type="number" value = "1" name="numquantity" class="form-control" required max = "20" min = "1">
                        </div>

                      <?php endif ?>
                        <div class="col-xl-12">
                          <input type="hidden" name="txtmenuID" value="<?php echo $_GET['menuID']?>">
                          <input type="hidden" name="txtprice" value="<?php echo $price ?>">
                          <input type="hidden" name="txtduration" value="<?php echo $duration ?>">
                          <button type="submit" class="boxed_btn_green" name="btnAdd" style="color:white">Add to cart <i class="fas fa-plus"></i></button>
                        </div>
                      </div>

                    </div>
                  </div>
                </form>
                </div>
            </div>

        </div>
    </div>

    <!--bicycle end-->
</body>
</html>
