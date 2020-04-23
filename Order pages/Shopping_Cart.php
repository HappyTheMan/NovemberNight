<?php
include('../Template/Theader.php');
include('../connect.php');
include('OrderFunction.php');
include('Auto_IdFunction.php');

$bquery = mysqli_query($connection,"SELECT * FROM branch");
$bcount = mysqli_num_rows($bquery);
if (isset($_GET['action'])) {
  $action = $_GET['action'];

  if ($action === "remove") {
    $MenuID = $_GET['MenuID'];
    RemoveProduct($MenuID);
  } else {
    ClearAll();
  }
}
if (!isset($_SESSION['Cart'])) {
  echo "<script>alert('No product has been added')</script>";
  echo "<script>window.location='menu.php'</script>";
}
if (isset($_POST['btnOrder'])) {
  $address = $_POST['txtAddress'];
  $phone = $_POST['txtPhone'];
  $tamount = $_POST['txtTotalAmount'];
  $tquantity = $_POST['txtTotalQuantity'];
  $time = getTime();
  $branch = $_POST['cboBranch'];
  $Payment = $_POST['cboPayment'];
  $date = date("Y-m-d");


  $oid = AutoID('orders', 'order_Id', 'O-', 6);
  $cid = $_POST['txtCustomerID'];

  $BigInsert = "INSERT INTO `orders` (`order_Id`, `customer_Id`, `delivery_Id`, `total_Quantity`, `total_Amount`, `order_Time`, `address`, `phone`,`branch`,`order_Date`,`payment`,`status`)
                VALUES ('$oid', '$cid', '0', '$tquantity', '$tamount', '$time','$address','$phone','$branch','$date','$Payment','pending')";
  $Bigquery = mysqli_query($connection,$BigInsert);

  $count = count($_SESSION['Cart']);

  for ($i = 0; $i < $count; $i++) {
    $MenuID = $_SESSION['Cart'][$i]['MenuID'];
    $quantity = $_SESSION['Cart'][$i]['quantity'];
    $price = $_SESSION['Cart'][$i]['price'];
    $type = $_SESSION['Cart'][$i]['type'];
    $name =  $_SESSION['Cart'][$i]['MenuName'];
    $size= $_SESSION['Cart'][$i]['size'] ;
    $milk =  $_SESSION['Cart'][$i]['milk'] ;
    $sugar = $_SESSION['Cart'][$i]['sugar'] ;
    $topping = $_SESSION['Cart'][$i]['topping'] ;
    $duration = $_SESSION['Cart'][$i]['duration'] ;

    $query2 = "INSERT INTO `order_detail`
      (`order_Id`, `menu_Id`, `quantity`, `price` , `size`, `milk`, `sugar`, `duration`, `topping`)
      VALUES
      ('$oid','$MenuID','$quantity','$price' , '$size', '$milk', '$sugar', '$duration', '$topping')
      ";
    $ret = mysqli_query($connection, $query2);
  }
  if($Bigquery){
    echo "<script>window.alert('Order Sucessfully')</script>";
		echo "<script>window.location='menu.php'</script>";
    unset($_SESSION['Cart']);
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../entry.css">
  	<link rel="stylesheet" href="../DatePicker/datepicker.css">

  	<script src="../DatePicker/datepicker.js"></script>
  </head>
  <body>


    <form id="test-form" class="white-popup-block" action="Shopping_Cart.php" method="post" style="padding-top:12%;margin-top:20%;width:100%;">
      <div class="popup_box">
        <div class="popup_inner">
          <div class="logo text-center">
            <div class="logo-img">
              <a href="displays.php">
                <h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
              </a>
            </div>
          </div>
          <h3 style="text-align:center;">Shopping Cart</h3>
          <fieldset class="form" style="margin-top:10px;color:black">

            <table border="1" class="table table-hover table-responsive">
              <tr class="table-dark">
                <th>Image</th>
                <th>MenuName</th>
                <th>price (USD)</th>
                <th>PurchaseQty (pcs)</th>
                <th>Size</th>
                <th>Milk</th>
                <th>Sugar</th>
                <th>topping</th>
                <th>duration</th>
                <th>Sub-Total (USD)</th>
                <th>Action</th>
              </tr>
              <?php
              $size = count($_SESSION['Cart']);

              for ($i = 0; $i < $size; $i++) {
                $MenuID = $_SESSION['Cart'][$i]['MenuID'];
                $MenuImage = $_SESSION['Cart'][$i]['MenuImage'];
                $type = $_SESSION['Cart'][$i]['type'];

                echo "<tr scope ='row' class = 'table-info'>";
                echo "<td><img src='$MenuImage' width='100px' height='100px'/></td>";
                echo "<td>" . $_SESSION['Cart'][$i]['MenuName'] . "</td>";
                echo "<td>" . $_SESSION['Cart'][$i]['price'] . " USD</td>";
                echo "<td>" . $_SESSION['Cart'][$i]['quantity'] . " " . $type . "</td>";
                echo "<td>" . $_SESSION['Cart'][$i]['size'] . "</td>";
                echo "<td>" . $_SESSION['Cart'][$i]['milk'] . "</td>";
                echo "<td>" . $_SESSION['Cart'][$i]['sugar'] . "</td>";
                echo "<td>" . $_SESSION['Cart'][$i]['topping'] . "</td>";
                echo "<td>" . $_SESSION['Cart'][$i]['duration'] . "</td>";
                echo "<td>" . ($_SESSION['Cart'][$i]['price'] * $_SESSION['Cart'][$i]['quantity']) . "</td>";
                echo "<td>
        <a href='Shopping_Cart.php?action=remove&MenuID=$MenuID'><i class='fas fa-times' style = 'color:red;font-size:30px;'></i></a>
        </td>";
                echo "</tr>";
              }

              ?>
              </table>
              <a href="Shopping_Cart.php?action=clearall" style = "color:red;">Clear All</a>
              <div class="form-row col-xl-12" style="margin-bottom: 5%;">
                <textarea name="txtAddress" rows="5" cols="80"class = "form-control" placeholder="Address to be delivered" required></textarea>
              </div>
              <div class="form-row col-xl-12" style="margin-bottom: 5%;">
                <input type="text" name="txtPhone" placeholder = "Receiver's phone number" class="form-control" required>
              </div>
              <div class="form-row col-xl-12" style="margin-bottom: 5%;">
                <div class="form-group col-xl-6">
                  <label for="a">Total Amount</label>
                  <input type="text" name="txtTotalAmount" id = "a" value = "<?php echo CalculateTotalAmount(); ?>" class="form-control" readonly>
                </div>
                <div class="form-group col-xl-6">
                  <label for="b">Total Quantity</label>
                  <input type="text" name="txtTotalQuantity" id = "b" value = "<?php echo CalculateTotalQuantity(); ?>" class="form-control" readonly>
                </div>
              </div>
              <div class="form-row col-xl-12" style="margin-bottom: 5%;">
                <select class="form-control" name="cboBranch">
                <?php for ($i=0; $i < $bcount; $i++):
                  $branches = mysqli_fetch_array($bquery);
                  ?>
                    <option value="<?php echo $branches['Branch']; ?>"><?php echo $branches['Branch']; ?></option>
                <?php endfor ?>
              </select>
              </div>
              <div class="form-row col-xl-12" style="margin-bottom: 5%;">
                <select class="form-control" name="cboPayment">
                <option>Cash On Delivery</option>
                <option>KBZ Pay</option>
                <option>CB Pay</option>
              </select>
              </div>
                <input type="hidden" name="txtTime" id = "b" value = "<?php
                echo date("Y-m-d H:i:s");
                 ?> + 6:30 " class="form-control" readonly>
                 <input type="hidden" name="txtCustomerID" value="<?php echo $_SESSION['CustomerID']; ?>">
              <input type="submit" name="btnOrder" value="Order" class="boxed_btn_green" style="color:white" >

              </td>


          </fieldset>




            </div>
          </div>

        </div>
      </div>

    </form>
  </body>
</html>
