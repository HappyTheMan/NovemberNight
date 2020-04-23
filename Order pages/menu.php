<?php

include('../connect.php');
if (isset($_POST['btnSearch'])) {
	$rdoSearchType = $_POST['rdoSearchType'];

	if ($rdoSearchType == 1) {
		$cboPOID = $_POST['cboMenuType'];
		if ($cboPOID == "No") {
			echo "<script>window.alert('Please choose the  Order ID.')</script>";
		}
    $query = "SELECT *
  						FROM menu
              WHERE menu_Type = '$cboPOID'";
		$ret = mysqli_query($connection, $query);
	} elseif ($rdoSearchType == 2) {
		$Name = $_POST['txtName'];

    $query = "SELECT *
  						FROM menu
              WHERE menu_Name LIKE '%$Name%'";
		$ret = mysqli_query($connection, $query);
	}
} elseif (isset($_POST['btnShowAll'])) {
	$query = "SELECT *
						FROM menu";
	$ret = mysqli_query($connection, $query);
} else {
/* 	$TodayDate = date('Y-m-d'); */

$query = "SELECT *
          FROM menu";
	$ret = mysqli_query($connection, $query);
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    	<link rel="stylesheet" href="../entry.css">
    <title>Menu</title>
		<?php include('../Template/Theader.php'); ?>
  </head>
  <body>

    <form action="menu.php" method="post" class="white-popup-block" style="padding-top:1%;width:100%;z-index:0;">
  		<div class="popup_box" style="width:100%;z-index:0;">
  			<div class="popup_inner">
  				<div class="logo text-center">
  					<div class="logo-img">
  						<a href="displays.php">
  							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
  						</a>
  					</div>
  				</div>
  				<h3 style="text-align:center;">Menu</h3>
  				<fieldset style="padding:25px;color:black">
  					<table class="table table-responsive">
  						<tr>
  							<td>
  								<input type="radio" name="rdoSearchType" value="1" style="height:20px;"checked />Search by Menu Type <br />
  								<select name="cboMenuType" class="custom-select">
  									<?php
  									$PO_Query = "SELECT * FROM menu";
  									$PO_ret = mysqli_query($connection, $PO_Query);
  									$PO_count = mysqli_num_rows($PO_ret);

  									for ($i = 0; $i < $PO_count; $i++) {
  										$PO_arr = mysqli_fetch_array($PO_ret);
  										$PurchaseOrderID = $PO_arr['menu_Type'];

  										echo "<option value='$PurchaseOrderID'>$PurchaseOrderID</option>";
  									}
  									?>
  								</select>
  							</td>
  							<td>
  								<input type="radio" name="rdoSearchType" value="2" style="height:20px;"/>Search by Name <br />
  								<input type="text" name="txtName" value="">
  							</td>
  							<td>
  								<br />
  								<input type="submit" name="btnSearch" class="boxed_btn_green a"value="Search" style="color:white;"/>
  								<input type="submit" name="btnShowAll"class="boxed_btn_green a " value="Show All" style="color:white;"/>
  								<input type="reset" class="boxed_btn_green a" value="Clear" style="color:white;"/>
  							</td>
  						</tr>
  					</table>

            <div class="latest_new_area" style = "padding:0px;">
                <div class="container">
                    <div class="row">
                    <?php
                        $subcount = mysqli_num_rows($ret);
                        for ($j=0; $j < $subcount; $j++) {
                            $data = mysqli_fetch_array($ret);
                            $image = "../Menu images/".$data['menu_Image'];
                            $name = $data['menu_Name'];

                            echo "  <div class='col-xl-4 col-md-6 col-lg-4'>
                                        <div class='single_news' style = 'background-color:#212529;padding:10%;border-radius:50px;'>
                                            <div class='thumb'>
                                                <a href='#'>
                                                    <img src='$image' >
                                                </a>
                                            </div>
                                            <div class='news_content'>
                                                <h3 style = 'color:white'>Product Name: $name</h3>
                                            </div>
                                            <div class='live_chat_btn'>
                                            <a class='boxed_btn_green btn-block' href = 'menu_Detail.php?menuID=".$data['menu_Id']."' style = 'text-align:center'>
                                                <i class='fas fa-shopping-cart'></i>
                                                <span>More details or buy</span>
                                            </a>
                                            </div>
                                        </div><br>
                                    </div>";
                        }
                    ?>


                    </div>
                </div>
            </div>


  			</div>

  		</div>
  		</div>




  	</form>
    <?php include('../Template/Tfooter.php'); ?>
  </body>
</html>
