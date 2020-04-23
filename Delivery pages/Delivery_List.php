<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
//unset($_SESSION['POFunctions']);
include('../connect.php');
if (isset($_POST['btnSearch'])) {
	$rdoSearchType = $_POST['rdoSearchType'];
  $branch = $_SESSION['StaffBranch'];
	if ($rdoSearchType == 1) {
		$cboPOID = $_POST['cboPOID'];
		if ($cboPOID == "No") {
			echo "<script>window.alert('Please choose the  Order ID.')</script>";
		}
		$query = "SELECT *
              FROM orders o,customer c, staff s, branch b
              where o.customer_Id = c.customer_Id
              and o.branch = '$branch'
              and o.branch = b.Branch
              and s.branch_Id = b.branch_Id
							and o.order_Id = '$cboPOID'

				";
		$ret = mysqli_query($connection, $query);
	} elseif ($rdoSearchType == 2) {
		$From = date('Y-m-d', strtotime($_POST['txtFrom']));
		$To = date('Y-m-d', strtotime($_POST['txtTo']));

		$query = "SELECT *
              FROM orders o,customer c, staff s, branch b
              where o.customer_Id = c.customer_Id
              and o.branch = '$branch'
              and o.branch = b.Branch
              and s.branch_Id = b.branch_Id
							and o.order_Date BETWEEN '$From' AND '$To'
				";
		$ret = mysqli_query($connection, $query);
	} else {
		$Status = $_POST['cboStatus'];
		if ($Status == "No") {
			echo "<script>window.alert('Please choose the status.')</script>";
			echo "<script>window.location='Order_List.php'</script>";
		}
		$query = "SELECT DISTINCT *
              FROM orders o,customer c, branch b
              where o.customer_Id = c.customer_Id
              and o.branch = '$branch'
              and o.branch = b.Branch
							and o.status = '$Status'";
		$ret = mysqli_query($connection, $query);
	}
} elseif (isset($_POST['btnShowAll'])) {
  $branch = $_SESSION['StaffBranch'];
	$query = " SELECT DISTINCT *
            FROM orders o,customer c, branch b
            where o.customer_Id = c.customer_Id
            and o.branch = '$branch'
            and o.branch = b.Branch";
	$ret = mysqli_query($connection, $query);
} else {
/* 	$TodayDate = date('Y-m-d'); */
  $branch = $_SESSION['StaffBranch'];
	$query = " SELECT DISTINCT *
            FROM orders o,customer c, branch b
            where o.customer_Id = c.customer_Id
            and o.branch = '$branch'
            and o.branch = b.Branch";
	$ret = mysqli_query($connection, $query);
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Delivery List</title>

	<link rel="stylesheet" href="../entry.css">
	<link rel="stylesheet" href="../DatePicker/datepicker.css">

	<script src="../DatePicker/datepicker.js"></script>
	<style>
		.popup_box {
			width: 100%;
		}
		.a{
			color:white;
		}
	</style>
</head>

<body>
		<div class="container">
	<form action="Delivery_List.php" method="post" class="white-popup-block" style="padding-top:0%;margin-left:3%;width:100%;">
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="displays.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>
				<h3 style="text-align:center;">Delivery List</h3>
				<fieldset style="padding:25px;color:black">
					<table class="table table-responsive">
						<tr>
							<!-- <td>
								<input type="radio" name="rdoSearchType" value="1" style="height:20px;"checked />Search by ID <br />
								<select name="cboPOID" class="custom-select">
									<option>Choose PO ID</option>
									<?php
									$PO_Query = "SELECT * FROM orders";
									$PO_ret = mysqli_query($connection, $PO_Query);
									$PO_count = mysqli_num_rows($PO_ret);

									for ($i = 0; $i < $PO_count; $i++) {
										$PO_arr = mysqli_fetch_array($PO_ret);
										$PurchaseOrderID = $PO_arr['order_Id'];

										echo "<option value='$PurchaseOrderID'>$PurchaseOrderID</option>";
									}
									?>
								</select>
							</td> -->
							<td>
								<input type="radio" name="rdoSearchType" value="2" style="height:20px;"/>Search by Date <br />
								From : <input type="date" name="txtFrom" value="<?php echo date('Y-m-d') ?>"  />
								To : <input type="date" name="txtTo" value="<?php echo date('Y-m-d') ?>"  />
							</td>
							<td>
								<input type="radio" name="rdoSearchType" value="3" style="height:20px;"/>Search by Status <br />
								<select name="cboStatus" class="custom-select">
									<option value = "No">Choose Status</option>
									<option>Pending</option>
									<option>Confirmed</option>
								</select>
							</td>
							<td>
								<br />
								<input type="submit" name="btnSearch" class="boxed_btn_green a"value="Search" style="color:white;"/>
								<input type="submit" name="btnShowAll"class="boxed_btn_green a " value="Show All" style="color:white;"/>
								<input type="reset" class="boxed_btn_green a" value="Clear" style="color:white;"/>
							</td>
						</tr>
					</table>
					<?php

					$count = mysqli_num_rows($ret);

					if ($count < 1) {
						echo "<p>No PurchaseOrder Record Found.</p>";
						exit();
					}
					?>

					<table class="table table-hover table-responsive">
						<tr class="table-dark">
							<th>Order_ID</th>
							<th>Order_Date</th>
							<th>Delivery Staff ID</th>
							<th>Customer Name</th>
							<th>Total Amount</th>
							<th>Total Quantity</th>
							<th>Order_Time</th>
							<th>Address</th>
							<th>Phone number</th>
							<th>Branch</th>
							<th>Payment</th>
							<th>Status</th>
							<th>Action</th>

						</tr>
						<?php
						for ($i = 0; $i < $count; $i++) {
							$rows = mysqli_fetch_array($ret);
							$PurchaseOrderID = $rows['order_Id'];

							echo "<tr class ='table-info'>";
							echo "<td>" . $rows['order_Id'] . "</td>";
							echo "<td>" . $rows['order_Date'] . "</td>";
							echo "<td>" . $rows['delivery_Id']. "</td>";
							echo "<td>" . $rows['customer_Name'] . "</td>";
							echo "<td>" . $rows['total_Amount'] . "</td>";
							echo "<td>" . $rows['total_Quantity'] . "</td>";
							echo "<td>" . $rows['order_Time'] . "</td>";
							echo "<td>" . $rows['address'] . "</td>";
							echo "<td>" . $rows['phone'] . "</td>";
							echo "<td>" . $rows['branch'] . "</td>";
							echo "<td>" . $rows['payment'] . "</td>";
							echo "<td>" . $rows['status'] . "</td>";
							echo "<td>
			  <a href='Delivery_Detail.php?	OrderID=$PurchaseOrderID' style = 'color:blue;'>Detail...</a>
			  </td>";
							echo "</tr>";
						}

						?>
					</table>

				</fieldset>


			</div>

		</div>
		</div>




	</form>
	</div>
</body>

</html>
