<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
//unset($_SESSION['POFunctions']);
include('../connect.php');
include('../Functions/Auto_IdFunction.php');
include('../Functions/Purchase_OrderFunction.php');
if (isset($_POST['btnSearch'])) {
	$rdoSearchType = $_POST['rdoSearchType'];

	if ($rdoSearchType == 1) {
		$cboPOID = $_POST['cboPOID'];
		if ($cboPOID == "No") {
			echo "<script>window.alert('Please choose the Purchase Order ID.')</script>";
		}
		$query = "SELECT po.*, sup.supplier_Id, sup.supplier_Name, s.staff_Name
				FROM purchase po, supplier sup , staff s
				WHERE po.purchase_Id='$cboPOID'
				AND po.supplier_Id=sup.supplier_Id
                AND po.staff_Id = s.staff_Id
				";
		$ret = mysqli_query($connection, $query);
	} elseif ($rdoSearchType == 2) {
		$From = date('Y-m-d', strtotime($_POST['txtFrom']));
		$To = date('Y-m-d', strtotime($_POST['txtTo']));

		$query = "SELECT po.*, sup.supplier_Id, sup.supplier_Name, s.staff_Name
				FROM purchase po, supplier sup , staff s
				WHERE po.order_Date BETWEEN '$From' AND '$To'
				AND po.supplier_Id=sup.supplier_Id
                AND po.staff_Id = s.staff_Id
				";
		$ret = mysqli_query($connection, $query);
	} else {
		$Status = $_POST['cboStatus'];
		if ($Status == "No") {
			echo "<script>window.alert('Please choose the status.')</script>";
		}
		$query = "SELECT po.*, sup.supplier_Id, sup.supplier_Name, s.staff_Name
				FROM purchase po, supplier sup , staff s
				WHERE po.Status='$Status'
				AND po.supplier_Id=sup.supplier_Id
				AND po.staff_Id = s.staff_Id";
		$ret = mysqli_query($connection, $query);
	}
} elseif (isset($_POST['btnShowAll'])) {
	$query = "SELECT po.*, sup.supplier_Id, sup.supplier_Name, s.staff_Name
				FROM purchase po, supplier sup , staff s
				WHERE po.supplier_Id=sup.supplier_Id";
	$ret = mysqli_query($connection, $query);
} else {
/* 	$TodayDate = date('Y-m-d'); */

	$query = "SELECT * from purchase ";
	$ret = mysqli_query($connection, $query);
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Purchase List</title>

	<link rel="stylesheet" href="../entry.css">
	<link rel="stylesheet" href="../DatePicker/datepicker.css">

	<script src="../DatePicker/datepicker.js"></script>
	<style>
		.a{
			color:white;
		}
		.popup_box {
			width: 100%;
		}
	</style>
</head>

<body>

	<form action="Purchase_List.php" method="post" class="white-popup-block"  style="padding-top:0%;margin-left:10%;">
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="displays.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>
				<h3 style="text-align:center;">Purchase List</h3>
				<fieldset style="padding:25px;color:black">
					<table class="table table-responsive">
						<tr>
							<td>
								<input type="radio" name="rdoSearchType" value="1" style="height:20px;"checked />Search by ID <br />
								<select name="cboPOID" class="custom-select">
									<option>Choose PO ID</option>
									<?php
									$PO_Query = "SELECT * FROM purchase";
									$PO_ret = mysqli_query($connection, $PO_Query);
									$PO_count = mysqli_num_rows($PO_ret);

									for ($i = 0; $i < $PO_count; $i++) {
										$PO_arr = mysqli_fetch_array($PO_ret);
										$PurchaseOrderID = $PO_arr['purchase_Id'];

										echo "<option value='$PurchaseOrderID'>$PurchaseOrderID</option>";
									}
									?>
								</select>
							</td>
							<td>
								<input type="radio" name="rdoSearchType" value="2" style="height:20px;"/>Search by Date <br />
								From : <input type="date" name="txtFrom" value="<?php echo date('Y-m-d') ?>"  />
								To : <input type="date" name="txtTo" value="<?php echo date('Y-m-d') ?>"  />
							</td>
							<td>
								<input type="radio" name="rdoSearchType" value="3" style="height:20px;"/>Search by Status <br />
								<select name="cboStatus" class="custom-select">
									<option>Choose Status</option>
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
							<th>PO_ID</th>
							<th>PO_Date</th>
							<th>Supplier Name</th>
							<th>Staff Name</th>
							<th>Total Amount</th>
							<th>Tax</th>
							<th>Total Quantity</th>
							<th>Grand Total</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						<?php
						for ($i = 0; $i < $count; $i++) {
							$rows = mysqli_fetch_array($ret);
							$PurchaseOrderID = $rows['purchase_Id'];
							$supID = $rows['supplier_Id'];
							$staID = $rows['staff_Id'];
							$q = "SELECT * FROM supplier s,staff st where s.supplier_Id = '$supID' and st.staff_Id = '$staID'";
							$newret = mysqli_query($connection,$q);
							$newrow = mysqli_fetch_array($newret);
							echo "<tr class ='table-info'>";
							echo "<td>" . $rows['purchase_Id'] . "</td>";
							echo "<td>" . $rows['order_Date'] . "</td>";
							echo "<td>" . $newrow['supplier_Name'] . "</td>";
							echo "<td>" . $newrow['staff_Name'] . "</td>";
							echo "<td>" . $rows['total_Amount'] . "</td>";
							echo "<td>" . $rows['tax'] . "</td>";
							echo "<td>" . $rows['total_Quantity'] . "</td>";
							echo "<td>" . $rows['total_Cost'] . "</td>";
							echo "<td>" . $rows['status'] . "</td>";
							echo "<td>
			  <a href='purchase_Detail.php?PurchaseOrderID=$PurchaseOrderID' style = 'color:blue;'>Detail...</a>
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
</body>

</html>
